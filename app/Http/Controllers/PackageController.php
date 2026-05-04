<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function show($id)
    {
        $package = Package::findOrFail($id);
        return view('package-detail', compact('package'));
    }
}
