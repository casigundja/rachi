<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Customer;
use App\Models\CourseEnrollment;
use App\Models\CourseProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CourseController extends Controller
{
    public function dashboard(Request $request): View
    {
        $allCourses = Course::where('status', 'published')
            ->with(['category', 'modules.lessons'])
            ->get()
            ->map(function ($c) {
                $modulos = $c->modules->map(function ($m) {
                    return [
                        'id' => $m->id,
                        'nome' => $m->title,
                        'aulas' => $m->lessons->map(function ($l) {
                            return [
                                'id' => $l->id,
                                'titulo' => $l->title,
                                'duracao' => ($l->duration_minutes ?: 30) . ' min',
                                'concluida' => false,
                            ];
                        })->values()->all(),
                    ];
                })->values()->all();

                $totalAulas = 0;
                foreach ($modulos as $mod) {
                    $totalAulas += count($mod['aulas']);
                }

                $gradients = [
                    'bg-gradient-to-br from-[#0050f0] via-[#003eb8] to-[#002575]',
                    'bg-gradient-to-br from-[#071326] via-[#0d2249] to-[#0050f0]',
                    'bg-gradient-to-br from-[#071326] via-[#78350f] to-[#f5a800]',
                    'bg-gradient-to-br from-[#064e3b] via-[#047857] to-[#10b981]',
                    'bg-gradient-to-br from-[#581c87] via-[#7e22ce] to-[#a855f7]',
                ];

                $imagem = $c->thumbnail ?: ('/images/courses/' . $c->slug . '.jpg');

                return [
                    'id' => $c->id,
                    'slug' => $c->slug,
                    'nome' => $c->name,
                    'categoria' => $c->category?->name ?? 'Tecnologia da Informação',
                    'gradientClass' => $gradients[$c->id % count($gradients)],
                    'imagem' => $imagem,
                    'thumbnail' => $imagem,
                    'descricao' => $c->short_description ?: $c->description,
                    'duracao' => ($c->duration_hours ?: 30) . ' Horas',
                    'totalAulas' => $totalAulas ?: 8,
                    'aulasConcluidas' => 0,
                    'progresso' => 0,
                    'modulos' => $modulos,
                ];
            });

        $user = Auth::user();
        $enrolledCourses = collect();

        if ($user) {
            $enrollments = CourseEnrollment::whereHas('customer', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->whereIn('status', ['active', 'completed'])
                ->with(['course.category', 'course.modules.lessons'])
                ->get();

            if ($enrollments->isNotEmpty()) {
                $enrolledCourses = $enrollments->filter(fn ($e) => $e->course)->map(function ($e) {
                    $c = $e->course;
                    $completedLessonIds = CourseProgress::where('enrollment_id', $e->id)
                        ->where('completed', true)
                        ->pluck('lesson_id')
                        ->toArray();

                    $modulos = $c->modules->map(function ($m) use ($completedLessonIds) {
                        return [
                            'id' => $m->id,
                            'nome' => $m->title,
                            'aulas' => $m->lessons->map(function ($l) use ($completedLessonIds) {
                                return [
                                    'id' => $l->id,
                                    'titulo' => $l->title,
                                    'duracao' => ($l->duration_minutes ?: 30) . ' min',
                                    'concluida' => in_array($l->id, $completedLessonIds, true),
                                ];
                            })->values()->all(),
                        ];
                    })->values()->all();

                    $totalAulas = 0;
                    $aulasConcluidas = 0;
                    foreach ($modulos as $mod) {
                        foreach ($mod['aulas'] as $aula) {
                            $totalAulas++;
                            if ($aula['concluida']) $aulasConcluidas++;
                        }
                    }

                    $progresso = $totalAulas > 0 ? (int)round(($aulasConcluidas / $totalAulas) * 100) : 0;
                    if ($e->status === 'completed') $progresso = 100;

                    $gradients = [
                        'bg-gradient-to-br from-[#0050f0] via-[#003eb8] to-[#002575]',
                        'bg-gradient-to-br from-[#071326] via-[#0d2249] to-[#0050f0]',
                        'bg-gradient-to-br from-[#071326] via-[#78350f] to-[#f5a800]',
                    ];

                    $imagem = $c->thumbnail ?: ('/images/courses/' . $c->slug . '.jpg');

                    return [
                        'id' => $c->id,
                        'slug' => $c->slug,
                        'nome' => $c->name,
                        'categoria' => $c->category?->name ?? 'Tecnologia da Informação',
                        'gradientClass' => $gradients[$c->id % count($gradients)],
                        'imagem' => $imagem,
                        'thumbnail' => $imagem,
                        'descricao' => $c->short_description ?: $c->description,
                        'duracao' => ($c->duration_hours ?: 30) . ' Horas',
                        'totalAulas' => $totalAulas ?: 8,
                        'aulasConcluidas' => $aulasConcluidas,
                        'progresso' => $progresso,
                        'modulos' => $modulos,
                    ];
                })->values();
            }
        }

        // Se o usuário não tiver matrículas específicas ativas ainda,
        // sincroniza com os cursos REAIS cadastrados da RACHI Academy (com imagens e módulos oficiais)
        if ($enrolledCourses->isEmpty()) {
            $featuredSlugs = ['ciberseguranca', 'competencias-digitais', 'gestao-empresarial'];
            $featured = $allCourses->whereIn('slug', $featuredSlugs)->values();
            if ($featured->isEmpty()) {
                $featured = $allCourses->take(3)->values();
            }

            $enrolledCourses = $featured->map(function ($item, $idx) {
                $sampleProgress = [91, 75, 100];
                $prog = $sampleProgress[$idx % count($sampleProgress)];
                $item['progresso'] = $prog;
                $tot = $item['totalAulas'] ?: 10;
                $item['aulasConcluidas'] = (int)round(($prog / 100) * $tot);

                $count = 0;
                if (!empty($item['modulos'])) {
                    foreach ($item['modulos'] as &$m) {
                        foreach ($m['aulas'] as &$a) {
                            if ($count < $item['aulasConcluidas']) {
                                $a['concluida'] = true;
                                $count++;
                            }
                        }
                    }
                }
                return $item;
            });
        }

        $currentUser = $user ? [
            'id' => $user->id,
            'aluno_id' => $user->customer?->id ?? $user->id,
            'nome' => $user->name,
            'email' => $user->email,
            'tipo' => $user->role?->slug === 'student' ? 'aluno' : 'cliente',
            'status' => $user->status,
        ] : null;

        return view('public.aluno-dashboard', compact('allCourses', 'enrolledCourses', 'currentUser'));
    }

    public function index(): View
    {
        $courses = Course::where('status', 'published')->with('category')->paginate(9);
        return view('public.courses.index', compact('courses'));
    }

    public function show(string $slug): View
    {
        $course = Course::where('slug', $slug)
            ->with(['modules.lessons', 'category'])
            ->firstOrFail();

        $relatedCourses = Course::where('id', '!=', $course->id)
            ->where('status', 'published')
            ->inRandomOrder()
            ->take(3)
            ->get();

        $totalLessons = $course->modules->sum(function ($mod) {
            return $mod->lessons->count();
        });

        return view('public.courses.show', compact('course', 'relatedCourses', 'totalLessons'));
    }

    public function enroll(Request $request, string $slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        if ($request->user()) {
            $request->merge(['name'=>$request->user()->name,'email'=>$request->user()->email,
                'phone'=>$request->input('phone') ?: $request->user()->phone ?: $request->user()->customer?->phone]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
            'modality' => 'nullable|string|max:50',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Procurar ou criar usuário aluno
        $user = User::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name' => $validated['name'],
                'password' => Hash::make(Str::random(16)),
                'status' => 'active',
            ]
        );

        // Obter ou criar perfil de cliente
        $customer = Customer::firstOrCreate(
            ['user_id' => $user->id],
            [
                'phone' => $validated['phone'] ?? null,
                'whatsapp' => $validated['phone'] ?? null,
                'status' => 'active',
            ]
        );
        $customer->update([
            'phone' => $validated['phone'] ?? $customer->phone,
            'whatsapp' => $validated['phone'] ?? $customer->whatsapp,
        ]);

        // Registrar solicitação de matrícula com status PENDENTE para aprovação no Admin Dashboard
        $enrollment = CourseEnrollment::where('course_id', $course->id)
            ->where('customer_id', $customer->id)
            ->first();

        if ($enrollment) {
            if ($enrollment->status !== 'active') {
                $enrollment->status = 'pending';
                $enrollment->enrolled_at = now();
                $enrollment->save();
            }
        } else {
            $enrollment = CourseEnrollment::create([
                'course_id' => $course->id,
                'customer_id' => $customer->id,
                'status' => 'pending',
                'enrolled_at' => now(),
            ]);
        }

        $matriculaCode = 'RAC-' . str_pad($enrollment->id, 5, '0', STR_PAD_LEFT);

        $whatsappMsg = urlencode("Olá! Fiz minha solicitação de matrícula na RACHI Academy para a formação: {$course->name}.\nNome: {$validated['name']}\nCódigo: {$matriculaCode}\nGostaria de confirmar a vaga.");
        $whatsappUrl = "https://wa.me/244972888585?text={$whatsappMsg}";

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'success' => true,
                'message' => 'Solicitação de matrícula recebida.',
                'enrollment' => $enrollment,
                'code' => $matriculaCode,
                'whatsappUrl' => $whatsappUrl,
            ]);
        }

        return redirect()->route('academy.course.show', $course->slug)
            ->with('matricula_sucesso', [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'code' => $matriculaCode,
                'course' => $course->name,
                'whatsappUrl' => $whatsappUrl,
            ]);
    }
}
