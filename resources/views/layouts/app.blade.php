<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Gestion Cours') }} - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-light-gray font-sans antialiased">
    <!-- Header -->
    <header class="bg-light-blue text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <i class="fas fa-graduation-cap text-2xl"></i>
                <h1 class="text-xl font-bold">
                    <a href="{{ route('etudiants.index') }}">Gestion Cours</a>
                </h1>
            </div>
            <nav class="flex items-center space-x-6">
                <a href="{{ route('etudiants.index') }}" class="hover:text-blue-dark transition flex items-center">
                    <i class="fas fa-users mr-1"></i> Étudiants
                </a>
                <a href="{{ route('courses.create') }}" class="hover:text-blue-dark transition flex items-center">
                    <i class="fas fa-book mr-1"></i> Cours
                </a>
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-blue-dark transition flex items-center">
                            <i class="fas fa-sign-out-alt mr-1"></i> Déconnexion
                        </button>
                    </form>
                @endauth
            </nav>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="min-h-screen py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-soft-gray text-light-text">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row justify-between items-center">
            <p>© {{ date('Y') }} Gestion Cours. Tous droits réservés.</p>
            <div class="flex space-x-6 mt-4 sm:mt-0">
                <a href="#" class="hover:text-light-blue transition"><i class="fab fa-github"></i></a>
                <a href="#" class="hover:text-light-blue transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="hover:text-light-blue transition"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </footer>
</body>
</html>