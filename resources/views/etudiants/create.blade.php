@extends('layouts.app')

@section('title', 'Ajouter un Étudiant')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-light-text mb-6 flex items-center">
            <i class="fas fa-user-plus mr-2 text-light-blue"></i> Ajouter un étudiant
        </h2>

        @if ($errors->any())
            <div class="bg-light-red border-l-4 border-red-400 text-red-700 p-4 mb-6 rounded-lg shadow-sm transition-all duration-300 hover:scale-105">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-md">
            <form action="{{ route('etudiants.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="relative">
                    <label for="codeEtud" class="block text-light-text font-semibold mb-2">
                        <i class="fas fa-id-badge mr-1 text-light-blue"></i> Code Étudiant
                    </label>
                    <input type="text" name="codeEtud" id="codeEtud" value="{{ old('codeEtud') }}" class="w-full border border-soft-gray p-3 pl-10 rounded-md focus:ring-2 focus:ring-light-blue focus:border-transparent transition bg-gray-50" placeholder="Ex. E001" required>
                    <i class="fas fa-id-badge text-gray-400 absolute left-3 top-12"></i>
                </div>
                <div class="relative">
                    <label for="nom" class="block text-light-text font-semibold mb-2">
                        <i class="fas fa-user mr-1 text-light-blue"></i> Nom
                    </label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom') }}" class="w-full border border-soft-gray p-3 pl-10 rounded-md focus:ring-2 focus:ring-light-blue focus:border-transparent transition bg-gray-50" placeholder="Ex. Dupont" required>
                    <i class="fas fa-user text-gray-400 absolute left-3 top-12"></i>
                </div>
                <div class="relative">
                    <label for="prenom" class="block text-light-text font-semibold mb-2">
                        <i class="fas fa-user mr-1 text-light-blue"></i> Prénom
                    </label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom') }}" class="w-full border border-soft-gray p-3 pl-10 rounded-md focus:ring-2 focus:ring-light-blue focus:border-transparent transition bg-gray-50" placeholder="Ex. Jean" required>
                    <i class="fas fa-user text-gray-400 absolute left-3 top-12"></i>
                </div>
                <div>
                    <label class="block text-light-text font-semibold mb-2">
                        <i class="fas fa-book mr-1 text-light-blue"></i> Cours à étudier
                    </label>
                    @if ($courses->isEmpty())
                        <p class="text-gray-500 italic">Aucun cours disponible. <a href="{{ route('courses.create') }}" class="text-light-blue hover:text-light-blue-dark">Ajouter un cours</a></p>
                    @else
                        <select name="courses[]" multiple class="w-full border border-soft-gray p-3 rounded-md focus:ring-2 focus:ring-light-blue focus:border-transparent transition bg-gray-50" size="5">
                            @foreach ($courses as $course)
                                <option value="{{ $course->codeCours }}">{{ $course->intitule }}</option>
                            @endforeach
                        </select>
                        <p class="text-sm text-gray-500 mt-1">Maintenez Ctrl pour sélectionner plusieurs cours.</p>
                    @endif
                </div>
                <button type="submit" class="w-full bg-light-blue text-white p-3 rounded-full hover:bg-light-blue-dark transition shadow-md flex items-center justify-center">
                    <i class="fas fa-check mr-2"></i> Valider
                </button>
            </form>
        </div>
        <div class="mt-6 text-center">
            <a href="{{ route('etudiants.index') }}" class="text-light-blue hover:text-light-blue-dark flex items-center justify-center">
                <i class="fas fa-arrow-left mr-2"></i> Retour
            </a>
        </div>
    </div>
@endsection