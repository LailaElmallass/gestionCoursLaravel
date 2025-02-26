<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codeCours' => 'required|unique:courses,codeCours',
            'intitule' => 'required',
            'nbrH' => 'required|integer',
        ]);

        Course::create($request->all());
        return redirect()->back()->with('success', 'Cours ajouté avec succès');
    }
}