<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BusinessUnit;
use App\Models\Product;
use App\Models\Service;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $businessUnits = BusinessUnit::active()->get();
        $featuredServices = Service::where('featured', true)->with('businessUnit')->take(6)->get();
        $featuredProducts = Product::where('featured', true)->with(['businessUnit', 'primaryImage'])->take(4)->get();
        $featuredCourses = Course::where('status', 'published')->take(3)->get();

        return view('public.home', compact('businessUnits', 'featuredServices', 'featuredProducts', 'featuredCourses'));
    }

    public function about(): View
    {
        return view('public.about');
    }

    public function whatWeDo(): View
    {
        return view('public.what-we-do');
    }

    public function partners(): View
    {
        return view('public.partners');
    }

    public function testimonials(): View
    {
        return view('public.testimonials');
    }

    public function ethics(): View
    {
        return view('public.ethics');
    }
}
