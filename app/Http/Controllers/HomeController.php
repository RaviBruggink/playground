<?php

namespace App\Http\Controllers;

use App\Models\Project;

class HomeController extends Controller
{
    public function __invoke()
    {
        $projects = Project::latest()->take(3)->get();
        return view('home', compact('projects'));
    }
}

