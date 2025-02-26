@extends('layouts.app')

@section('title', 'Liste des Étudiants')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-extrabold text-light-text">
                <i class="fas fa-users mr-2 text-light-blue"></i> Liste des Étudiants
            </h2>
            <a href="{{ route('etudiants.create') }}" class="bg-light-blue text-white px-4 py-2 rounded-full hover:bg-light-blue-dark shadow-md transition flex items-center">
                <i class="fas fa-plus mr-2"></i> Ajouter
            </a>
        </div>

        @if (session('success'))
            <div class="bg-light-green border-l-4 border-green-400 text-green-700 p-4 mb-6 rounded-lg shadow-sm transition-all duration-300 hover:scale-105">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            @if ($etudiants->isEmpty())
                <p class="text-gray-500 italic text-center p-6">Aucun étudiant enregistré.</p>
            @else
                <table class="w-full text-left">
                    <thead class="bg-light-blue text-white">
                        <tr>
                            <th class="p-4 font-semibold">Code</th>
                            <th class="p-4 font-semibold">Nom</th>
                            <th class="p-4 font-semibold">Prénom</th>
                            <th class="p-4 font-semibold">Cours</th>
                            <th class="p-4 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($etudiants as $etudiant)
                            <tr class="border-b hover:bg-gray-50 transition duration-200">
                                <td class="p-4">{{ $etudiant->codeEtud }}</td>
                                <td class="p-4">{{ $etudiant->nom }}</td>
                                <td class="p-4">{{ $etudiant->prenom }}</td>
                                <td class="p-4">
                                    @if ($etudiant->courses->isEmpty())
                                        <span class="text-gray-400 italic">Aucun cours</span>
                                    @else
                                        <span class="text-light-text">{{ $etudiant->courses->pluck('intitule')->join(', ') }}</span>
                                    @endif
                                </td>
                                <td class="p-4 flex space-x-3">
                                    <a href="{{ route('etudiants.courses', $etudiant->codeEtud) }}" class="text-light-blue hover:text-light-blue-dark flex items-center">
                                        <i class="fas fa-book mr-1"></i> Gérer
                                    </a>
                                    <a href="{{ route('etudiants.edit', $etudiant->codeEtud) }}" class="text-yellow-500 hover:text-yellow-600 flex items-center">
                                        <i class="fas fa-edit mr-1"></i> 
                                    </a>
                                    <form action="{{ route('etudiants.destroy', $etudiant->codeEtud) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-600 flex items-center" onclick="return confirm('Voulez-vous vraiment supprimer cet étudiant ?')">
                                            <i class="fas fa-trash mr-1"></i> 
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection