<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BusinessUnit;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::where('status', 'active')->with('businessUnit')->paginate(12);
        return view('public.services.index', compact('services'));
    }

    public function byUnit(string $unit): View
    {
        $businessUnit = BusinessUnit::where('slug', $unit)->firstOrFail();
        $services = Service::where('business_unit_id', $businessUnit->id)->where('status', 'active')->paginate(12);

        return view('public.services.index', compact('services', 'businessUnit'));
    }

    public function show(string $slug): View
    {
        $service = Service::where('slug', $slug)->with(['businessUnit', 'category'])->firstOrFail();
        return view('public.services.show', compact('service'));
    }
}
