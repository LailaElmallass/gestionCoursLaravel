@extends('layouts.app')

@section('title', 'Ajouter un Cours')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-light-text mb-6 flex items-center">
            <i class="fas fa-book-open mr-2 text-light-blue"></i> Ajouter un cours
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
            <form action="{{ route('courses.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="relative">
                    <label for="codeCours" class="block text-light-text font-semibold mb-2">
                        <i class="fas fa-id-badge mr-1 text-light-blue"></i> Code Cours
                    </label>
                    <input type="text" name="codeCours" id="codeCours" value="{{ old('codeCours') }}" class="w-full border border-soft-gray p-3 pl-10 rounded-md focus:ring-2 focus:ring-light-blue focus:border-transparent transition bg-gray-50" placeholder="Ex. MATH101" required>
                    <i class="fas fa-id-badge text-gray-400 absolute left-3 top-12"></i>
                </div>
                <div class="relative">
                    <label for="intitule" class="block text-light-text font-semibold mb-2">
                        <i class="fas fa-book mr-1 text-light-blue"></i> Intitulé
                    </label>
                    <input type="text" name="intitule" id="intitule" value="{{ old('intitule') }}" class="w-full border border-soft-gray p-3 pl-10 rounded-md focus:ring-2 focus:ring-light-blue focus:border-transparent transition bg-gray-50" placeholder="Ex. Mathématiques" required>
                    <i class="fas fa-book text-gray-400 absolute left-3 top-12"></i>
                </div>
                <div class="relative">
                    <label for="nbrH" class="block text-light-text font-semibold mb-2">
                        <i class="fas fa-clock mr-1 text-light-blue"></i> Nombre d'heures
                    </label>
                    <input type="number" name="nbrH" id="nbrH" value="{{ old('nbrH') }}" class="w-full border border-soft-gray p-3 pl-10 rounded-md focus:ring-2 focus:ring-light-blue focus:border-transparent transition bg-gray-50" placeholder="Ex. 30" required>
                    <i class="fas fa-clock text-gray-400 absolute left-3 top-12"></i>
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