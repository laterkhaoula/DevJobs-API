<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EntrepriseController;
use App\Http\Controllers\Api\OffreController;
use App\Http\Controllers\Api\CompetenceController;
use App\Http\Controllers\Api\CandidatureController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// ==========================
// Routes publiques
// ==========================

// Authentification
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Consultation des entreprises
Route::get('/entreprises', [EntrepriseController::class, 'index']);
Route::get('/entreprises/{id}', [EntrepriseController::class, 'show']);

// Consultation des offres
Route::get('/offres', [OffreController::class, 'index']);
Route::get('/offres/{id}', [OffreController::class, 'show']);

// Consultation des compétences
Route::get('/competences', [CompetenceController::class, 'index']);
Route::get('/competences/{id}', [CompetenceController::class, 'show']);

// Consultation des candidatures
Route::get('/candidatures', [CandidatureController::class, 'index']);
Route::get('/candidatures/{id}', [CandidatureController::class, 'show']);


// ==========================
// Routes protégées
// ==========================

Route::middleware('auth:sanctum')->group(function () {

    // Authentification
    Route::post('/logout', [AuthController::class, 'logout']);

    // ==========================
    // Gestion des entreprises
    // ==========================
    Route::post('/entreprises', [EntrepriseController::class, 'store']);
    Route::put('/entreprises/{id}', [EntrepriseController::class, 'update']);
    Route::delete('/entreprises/{id}', [EntrepriseController::class, 'destroy']);

    // ==========================
    // Gestion des offres
    // ==========================
    Route::post('/offres', [OffreController::class, 'store']);
    Route::put('/offres/{id}', [OffreController::class, 'update']);
    Route::delete('/offres/{id}', [OffreController::class, 'destroy']);

    // ==========================
    // Gestion des compétences
    // ==========================
    Route::post('/competences', [CompetenceController::class, 'store']);
    Route::put('/competences/{id}', [CompetenceController::class, 'update']);
    Route::delete('/competences/{id}', [CompetenceController::class, 'destroy']);

    // ==========================
    // Gestion des candidatures
    // ==========================
    Route::post('/candidatures', [CandidatureController::class, 'store']);
    Route::put('/candidatures/{id}', [CandidatureController::class, 'update']);
    Route::delete('/candidatures/{id}', [CandidatureController::class, 'destroy']);
});