<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CandidatureRequest;
use App\Models\Candidature;
use Illuminate\Http\JsonResponse;

class CandidatureController extends Controller
{
    /**
     * Afficher toutes les candidatures.
     */
    public function index(): JsonResponse
    {
        return response()->json(
            Candidature::with(['user', 'offre'])->get()
        );
    }

    /**
     * Créer une candidature.
     */
    public function store(CandidatureRequest $request): JsonResponse
    {
        $candidature = Candidature::create($request->validated());

        return response()->json([
            'message' => 'Candidature créée avec succès.',
            'candidature' => $candidature,
        ], 201);
    }

    /**
     * Afficher une candidature.
     */
    public function show(string $id): JsonResponse
    {
        $candidature = Candidature::with(['user', 'offre'])->findOrFail($id);

        return response()->json($candidature);
    }

    /**
     * Modifier une candidature.
     */
    public function update(CandidatureRequest $request, string $id): JsonResponse
    {
        $candidature = Candidature::findOrFail($id);

        $candidature->update($request->validated());

        return response()->json([
            'message' => 'Candidature mise à jour avec succès.',
            'candidature' => $candidature,
        ]);
    }

    /**
     * Supprimer une candidature.
     */
    public function destroy(string $id): JsonResponse
    {
        $candidature = Candidature::findOrFail($id);

        $candidature->delete();

        return response()->json([
            'message' => 'Candidature supprimée avec succès.'
        ]);
    }
}