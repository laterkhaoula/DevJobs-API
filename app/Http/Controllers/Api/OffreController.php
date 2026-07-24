<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OffreRequest;
use App\Models\Offre;
use Illuminate\Http\JsonResponse;

class OffreController extends Controller
{
    /**
     * Afficher toutes les offres.
     */
    public function index(): JsonResponse
    {
        return response()->json(
            Offre::with('entreprise')->get()
        );
    }

    /**
     * Créer une offre.
     */
    public function store(OffreRequest $request): JsonResponse
    {
        $user = auth()->user();

        // Seules les entreprises peuvent créer une offre
        if ($user->role !== 'company') {
            return response()->json([
                'message' => 'Accès refusé.'
            ], 403);
        }

        $entreprise = $user->entreprise;

        if (!$entreprise) {
            return response()->json([
                'message' => 'Aucune entreprise associée à cet utilisateur.'
            ], 404);
        }

        $offre = Offre::create([
            'entreprise_id' => $entreprise->id,
            'titre' => $request->titre,
            'description' => $request->description,
            'type_contrat' => $request->type_contrat,
        ]);

        return response()->json([
            'message' => 'Offre créée avec succès.',
            'offre' => $offre,
        ], 201);
    }

    /**
     * Afficher une offre.
     */
    public function show(string $id): JsonResponse
    {
        $offre = Offre::with('entreprise')->findOrFail($id);

        return response()->json($offre);
    }

    /**
     * Modifier une offre.
     */
    public function update(OffreRequest $request, string $id): JsonResponse
    {
        $offre = Offre::with('entreprise')->findOrFail($id);

        // Seul le propriétaire ou l'admin peut modifier
        if (
            auth()->user()->role !== 'admin' &&
            $offre->entreprise->user_id !== auth()->id()
        ) {
            return response()->json([
                'message' => 'Accès refusé.'
            ], 403);
        }

        $offre->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'type_contrat' => $request->type_contrat,
        ]);

        return response()->json([
            'message' => 'Offre mise à jour avec succès.',
            'offre' => $offre,
        ]);
    }

    /**
     * Supprimer une offre.
     */
    public function destroy(string $id): JsonResponse
    {
        $offre = Offre::with('entreprise')->findOrFail($id);

        // Seul le propriétaire ou l'admin peut supprimer
        if (
            auth()->user()->role !== 'admin' &&
            $offre->entreprise->user_id !== auth()->id()
        ) {
            return response()->json([
                'message' => 'Accès refusé.'
            ], 403);
        }

        $offre->delete();

        return response()->json([
            'message' => 'Offre supprimée avec succès.'
        ]);
    }
}