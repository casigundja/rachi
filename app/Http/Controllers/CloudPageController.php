<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class CloudPageController extends Controller
{
    public function page(string $page)
    {
        abort_unless(in_array($page, ['login', 'register', 'portal', 'cart', 'courses', 'products', 'services', 'academy-login'], true), 404);
        return $this->html(file_get_contents(resource_path("cloud/pages/{$page}.html")));
    }

    public function course(Request $request, string $slug)
    {
        $course = Course::where('slug', $slug)->where('status', 'published')->with('category')->first();
        if (!$course) return redirect('/academy');
        $modules = $course->modules()->where('status', 'active')->orderBy('sort_order')
            ->with(['lessons' => fn ($q) => $q->where('status', 'active')->orderBy('sort_order')])->get();
        $data = $course->toArray();
        $data['category_name'] = $course->category?->name;
        $environment = PHP_OS_FAMILY === 'Windows'
            ? ['SystemRoot' => getenv('SystemRoot') ?: 'C:\\Windows', 'WINDIR' => getenv('WINDIR') ?: 'C:\\Windows']
            : null;
        $process = new Process(['node', base_path('bin/render-cloud-page.mjs')], base_path(), $environment);
        $process->setInput(json_encode([
            'course' => $data,
            'modules' => $modules,
            'related' => Course::where('status', 'published')->where('id', '!=', $course->id)->latest('id')->take(4)->get(),
            'success' => $request->session()->get('matricula_sucesso'),
        ], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR));
        $process->setTimeout(15)->mustRun();
        return $this->html($process->getOutput());
    }

    private function html(string $html)
    {
        $html = preg_replace('/<head>/i', '<head><meta name="csrf-token" content="'.e(csrf_token()).'">', $html, 1);
        $html = preg_replace('/(<form\b[^>]*method=["\']post["\'][^>]*>)/i', '$1<input type="hidden" name="_token" value="'.e(csrf_token()).'">', $html);
        return response($html)->header('Content-Type', 'text/html; charset=utf-8')
            ->header('Cache-Control', 'private, no-store');
    }
}
