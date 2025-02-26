@extends('layouts.app')

@section('title', 'Gérer les Cours')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-light-text mb-6 flex items-center">
            <i class="fas fa-book mr-2 text-light-blue"></i> Gérer les cours de {{ $etudiant->nom }} {{ $etudiant->prenom }}
        </h2>
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-400 text-red-700 p-4 mb-6 rounded-lg shadow-sm">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-light-green border-l-4 border-green-400 text-green-700 p-4 mb-6 rounded-lg shadow-sm transition-all duration-300 hover:scale-105">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h3 class="text-xl font-semibold text-light-text mb-4 flex items-center">
                <i class="fas fa-list mr-2 text-light-blue"></i> Cours actuels
            </h3>
            @if ($etudiant->courses->isEmpty())
                <p class="text-gray-500 italic">Aucun cours affecté.</p>
            @else
                <ul class="space-y-3">
                    @foreach ($etudiant->courses as $course)
                        <li class="flex items-center justify-between bg-gray-50 p-3 rounded-md shadow-sm hover:bg-gray-100 transition">
                            <span class="text-light-text">
                                {{ $course->intitule }} 
                                <span class="text-gray-500 text-sm">({{ $course->pivot->periode }})</span>
                            </span>
                            <form action="{{ route('etudiants.deaffecter', [$etudiant->codeEtud, $course->codeCours]) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600 flex items-center" onclick="return confirm('Voulez-vous désaffecter ce cours ?')">
                                    <i class="fas fa-trash mr-1"></i> Désaffecter
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-light-text mb-4 flex items-center">
                <i class="fas fa-plus mr-2 text-light-blue"></i> Affecter un cours
            </h3>
            @if ($allCourses->isEmpty())
                <p class="text-gray-500 italic">Aucun cours disponible. <a href="{{ route('courses.create') }}" class="text-light-blue hover:text-light-blue-dark">Ajouter un cours</a></p>
            @else
                <form action="{{ route('etudiants.affecter', $etudiant->codeEtud) }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="relative">
                        <label for="codeCours" class="block text-light-text font-semibold mb-2">
                            <i class="fas fa-book mr-1 text-light-blue"></i> Cours
                        </label>
                        <select name="codeCours" id="codeCours" class="w-full border border-soft-gray p-3 pl-10 rounded-md focus:ring-2 focus:ring-light-blue focus:border-transparent transition bg-gray-50">
                            @foreach ($allCourses as $course)
                                <option value="{{ $course->codeCours }}">{{ $course->intitule }}</option>
                            @endforeach
                        </select>
                        <i class="fas fa-book text-gray-400 absolute left-3 top-12"></i>
                    </div>
                    <div class="relative">
                        <label for="periode" class="block text-light-text font-semibold mb-2">
                            <i class="fas fa-calendar mr-1 text-light-blue"></i> Période
                        </label>
                        <input type="text" name="periode" id="periode" value="{{ old('periode', 'Semestre 1') }}" class="w-full border border-soft-gray p-3 pl-10 rounded-md focus:ring-2 focus:ring-light-blue focus:border-transparent transition bg-gray-50" placeholder="Ex. Semestre 1">
                        <i class="fas fa-calendar text-gray-400 absolute left-3 top-12"></i>
                    </div>
                    <button type="submit" class="w-full bg-light-blue text-white p-3 rounded-full hover:bg-light-blue-dark transition shadow-md flex items-center justify-center">
                        <i class="fas fa-plus mr-2"></i> Affecter
                    </button>
                </form>
            @endif
        </div>
        <div class="mt-6 text-center">
            <a href="{{ route('etudiants.index') }}" class="text-light-blue hover:text-light-blue-dark flex items-center justify-center">
                <i class="fas fa-arrow-left mr-2"></i> Retour
            </a>
        </div>
    </div>
@endsection