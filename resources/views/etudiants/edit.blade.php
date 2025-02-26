@extends('layouts.app')

@section('title', 'Éditer un Étudiant')

@section('content')
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-extrabold text-light-text mb-6 flex items-center">
            <i class="fas fa-user-edit mr-2 text-light-blue"></i> Éditer {{ $etudiant->nom }} {{ $etudiant->prenom }}
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
            <form action="{{ route('etudiants.update', $etudiant->codeEtud) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div class="relative">
                    <label for="codeEtud" class="block text-light-text font-semibold mb-2">
                        <i class="fas fa-id-badge mr-1 text-light-blue"></i> Code Étudiant
                    </label>
                    <input type="text" name="codeEtud" id="codeEtud" value="{{ old('codeEtud', $etudiant->codeEtud) }}" class="w-full border border-soft-gray p-3 pl-10 rounded-md focus:ring-2 focus:ring-light-blue focus:border-transparent transition bg-gray-50" placeholder="Ex. E001" required>
                    <i class="fas fa-id-badge text-gray-400 absolute left-3 top-12"></i>
                </div>
                <div class="relative">
                    <label for="nom" class="block text-light-text font-semibold mb-2">
                        <i class="fas fa-user mr-1 text-light-blue"></i> Nom
                    </label>
                    <input type="text" name="nom" id="nom" value="{{ old('nom', $etudiant->nom) }}" class="w-full border border-soft-gray p-3 pl-10 rounded-md focus:ring-2 focus:ring-light-blue focus:border-transparent transition bg-gray-50" placeholder="Ex. Dupont" required>
                    <i class="fas fa-user text-gray-400 absolute left-3 top-12"></i>
                </div>
                <div class="relative">
                    <label for="prenom" class="block text-light-text font-semibold mb-2">
                        <i class="fas fa-user mr-1 text-light-blue"></i> Prénom
                    </label>
                    <input type="text" name="prenom" id="prenom" value="{{ old('prenom', $etudiant->prenom) }}" class="w-full border border-soft-gray p-3 pl-10 rounded-md focus:ring-2 focus:ring-light-blue focus:border-transparent transition bg-gray-50" placeholder="Ex. Jean" required>
                    <i class="fas fa-user text-gray-400 absolute left-3 top-12"></i>
                </div>
                <button type="submit" class="w-full bg-light-blue text-white p-3 rounded-full hover:bg-light-blue-dark transition shadow-md flex items-center justify-center">
                    <i class="fas fa-save mr-2"></i> Mettre à jour
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