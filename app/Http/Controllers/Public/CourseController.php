<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Customer;
use App\Models\CourseEnrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CourseController extends Controller
{
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

    public function enroll(Request $request, string $slug): RedirectResponse
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
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
                'phone' => $validated['phone'],
                'whatsapp' => $validated['phone'],
                'status' => 'active',
            ]
        );
        $customer->update([
            'phone' => $validated['phone'],
            'whatsapp' => $validated['phone'],
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
        $whatsappUrl = "https://wa.me/244923000000?text={$whatsappMsg}";

        return redirect()->route('academy.course.show', $course->slug)
            ->with('matricula_sucesso', [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'code' => $matriculaCode,
                'course' => $course->name,
                'whatsappUrl' => $whatsappUrl,
            ]);
    }
}
