<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;

use App\Http\Controllers\CourseController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





Route::middleware('auth')->group(function () {
    // Routes pour Etudiants
    Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');
    Route::get('/etudiants/create', [EtudiantController::class, 'create'])->name('etudiants.create');
    Route::post('/etudiants', [EtudiantController::class, 'store'])->name('etudiants.store');
    Route::get('/etudiants/{codeEtud}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');
    Route::put('/etudiants/{codeEtud}', [EtudiantController::class, 'update'])->name('etudiants.update');
    Route::delete('/etudiants/{codeEtud}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');
    Route::get('/etudiants/{codeEtud}/courses', [EtudiantController::class, 'courses'])->name('etudiants.courses'); // Nouvelle route ajoutée
    Route::post('/etudiants/{codeEtud}/affecter', [EtudiantController::class, 'affecter'])->name('etudiants.affecter');
    Route::delete('/etudiants/{codeEtud}/deaffecter/{codeCours}', [EtudiantController::class, 'deaffecter'])->name('etudiants.deaffecter');

    // Routes pour Cours
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
});
require __DIR__.'/auth.php';
