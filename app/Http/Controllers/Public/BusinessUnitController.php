<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BusinessUnit;
use App\Models\Service;
use App\Models\Product;
use App\Models\Course;
use Illuminate\View\View;

class BusinessUnitController extends Controller
{
    public function tec(): View
    {
        $unit = BusinessUnit::where('slug', 'tec')->firstOrFail();
        $services = Service::where('business_unit_id', $unit->id)->where('status', 'active')->get();
        $products = Product::where('business_unit_id', $unit->id)->where('status', 'active')->get();

        return view('public.units.tec', compact('unit', 'services', 'products'));
    }

    public function print(): View
    {
        $unit = BusinessUnit::where('slug', 'print')->firstOrFail();
        $services = Service::where('business_unit_id', $unit->id)->where('status', 'active')->get();
        $products = Product::where('business_unit_id', $unit->id)->where('status', 'active')->get();

        return view('public.units.print', compact('unit', 'services', 'products'));
    }

    public function academy(): View
    {
        $unit = BusinessUnit::where('slug', 'academy')->firstOrFail();
        $courses = Course::where('business_unit_id', $unit->id)->where('status', 'published')->with('modules.lessons')->get();

        return view('public.units.academy', compact('unit', 'courses'));
    }

    public function capital(): View
    {
        $unit = BusinessUnit::where('slug', 'capital')->firstOrFail();
        $services = Service::where('business_unit_id', $unit->id)->where('status', 'active')->get();

        return view('public.units.capital', compact('unit', 'services'));
    }

    public function show(string $unit): View
    {
        return match ($unit) {
            'tec' => $this->tec(),
            'print' => $this->print(),
            'academy' => $this->academy(),
            'capital' => $this->capital(),
            default => abort(404),
        };
    }
}
