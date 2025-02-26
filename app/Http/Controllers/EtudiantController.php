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

    public function index()
    {
        $etudiants = Etudiant::with('courses')->get();
        return view('etudiants.index', compact('etudiants'));
    }

    public function create()
    {
        $courses = Course::all(); // Récupérer tous les cours pour le formulaire
        return view('etudiants.create', compact('courses'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'codeEtud' => 'required|unique:etudiants,codeEtud',
            'nom' => 'required',
            'prenom' => 'required',
            'courses' => 'nullable|array', // Validation pour les cours sélectionnés
        ]);
    
        $etudiant = Etudiant::create([
            'codeEtud' => $request->codeEtud,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
        ]);
    
        // Si des cours sont sélectionnés, les attacher avec une période par défaut
        if ($request->has('courses')) {
            $etudiant->courses()->attach($request->courses, ['periode' => 'Semestre 1']); // Période par défaut
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

    // EtudiantController.php
    public function courses($codeEtud)
    {
        \Log::info("Accessing courses for student: {$codeEtud}");
        $etudiant = Etudiant::with('courses')->findOrFail($codeEtud);
        $allCourses = Course::all(); // Get all available courses

        \Log::info($etudiant); // Check the retrieved student

        return view('courses.cours', compact('etudiant', 'allCourses'));
    }





    public function affecter(Request $request, $codeEtud)
    {
        $etudiant = Etudiant::findOrFail($codeEtud);
        $etudiant->courses()->attach($request->codeCours, ['periode' => $request->periode]);
    
        // Redirigez vers la route des cours de l'étudiant, pas vers "courses.cours"
        return redirect()->route('etudiants.courses', $codeEtud)->with('success', 'Cours affecté avec succès');
    }
    
    public function deaffecter($codeEtud, $codeCours)
    {
        $etudiant = Etudiant::findOrFail($codeEtud);
        $etudiant->courses()->detach($codeCours);

        // Redirigez vers la route des cours de l'étudiant, pas vers "courses.cours"
        return redirect()->route('etudiants.courses', $codeEtud)->with('success', 'Cours désaffecté avec succès');
    }

}