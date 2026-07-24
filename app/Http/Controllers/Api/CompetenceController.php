<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompetenceRequest;
use App\Models\Competence;
use Illuminate\Http\JsonResponse;

class CompetenceController extends Controller
{
    /**
     * Afficher toutes les compétences.
     */
    public function index(): JsonResponse
    {
        return response()->json(Competence::all());
    }

    /**
     * Créer une compétence.
     */
    public function store(CompetenceRequest $request): JsonResponse
    {
        $competence = Competence::create($request->validated());

        return response()->json([
            'message' => 'Compétence créée avec succès.',
            'competence' => $competence,
        ], 201);
    }

    /**
     * Afficher une compétence.
     */
    public function show(string $id): JsonResponse
    {
        $competence = Competence::findOrFail($id);

        return response()->json($competence);
    }

    /**
     * Modifier une compétence.
     */
    public function update(CompetenceRequest $request, string $id): JsonResponse
    {
        $competence = Competence::findOrFail($id);

        $competence->update($request->validated());

        return response()->json([
            'message' => 'Compétence mise à jour avec succès.',
            'competence' => $competence,
        ]);
    }

    /**
     * Supprimer une compétence.
     */
    public function destroy(string $id): JsonResponse
    {
        $competence = Competence::findOrFail($id);

        $competence->delete();

        return response()->json([
            'message' => 'Compétence supprimée avec succès.'
        ]);
    }
}