<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Service;
use App\Models\FAQ;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $packages = Package::limit(4)->get();
        return view('index', compact('services', 'packages'));
    }

    public function about()
    {
        return view('about');
    }

    public function katalog()
    {
        $packages = Package::all();
        return view('katalog', compact('packages'));
    }

    public function faq()
    {
        $faqs = FAQ::orderBy('order')->get();
        return view('faq', compact('faqs'));
    }
}
