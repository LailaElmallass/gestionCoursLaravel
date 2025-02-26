<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Course;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $courses = Course::all();
        if ($request->has('course') && $request->input('course') !== '') {
            $etudiants = Etudiant::whereHas('courses', function ($query) use ($request) {
                $query->where('course_id', $request->input('course')); // Utilise la colonne du pivot
            })->with('courses')->get();
        } else {
            $etudiants = Etudiant::with('courses')->get();
        }
        return view('etudiants.index', compact('etudiants', 'courses'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('etudiants.create', compact('courses'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'codeEtud' => 'required|unique:etudiants,codeEtud',
            'nom' => 'required',
            'prenom' => 'required',
            'courses' => 'nullable|array',
        ]);
    
        $etudiant = Etudiant::create([
            'codeEtud' => $request->codeEtud,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
        ]);
    
        if ($request->has('courses')) {
            $etudiant->courses()->attach($request->courses, ['periode' => 'Semestre 1']);
        }
    
        return redirect()->route('etudiants.index')->with('success', 'Étudiant ajouté avec succès');
    }

    public function edit($codeEtud)
    {
        $etudiant = Etudiant::findOrFail($codeEtud);
        return view('etudiants.edit', compact('etudiant'));
    }

    public function update(Request $request, $codeEtud)
    {
        $request->validate([
            'codeEtud' => 'required|unique:etudiants,codeEtud,' . $codeEtud . ',codeEtud',
            'nom' => 'required',
            'prenom' => 'required',
        ]);

        $etudiant = Etudiant::findOrFail($codeEtud);
        $etudiant->update($request->all());
        return redirect()->route('etudiants.index')->with('success', 'Étudiant mis à jour avec succès');
    }

    public function destroy($codeEtud)
    {
        $etudiant = Etudiant::findOrFail($codeEtud);
        $etudiant->delete();
        return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé avec succès');
    }

    public function courses($codeEtud)
    {
        $etudiant = Etudiant::with('courses')->findOrFail($codeEtud);
        $allCourses = Course::all();
        return view('courses.cours', compact('etudiant', 'allCourses'));
    }

    public function affecter(Request $request, $codeEtud)
    {
        $etudiant = Etudiant::findOrFail($codeEtud);
        $etudiant->courses()->attach($request->codeCours, ['periode' => $request->periode]);
        return redirect()->route('etudiants.courses', $codeEtud)->with('success', 'Cours affecté avec succès');
    }
    
    public function deaffecter($codeEtud, $codeCours)
    {
        $etudiant = Etudiant::findOrFail($codeEtud);
        $etudiant->courses()->detach($codeCours);
        return redirect()->route('etudiants.courses', $codeEtud)->with('success', 'Cours désaffecté avec succès');
    }
}