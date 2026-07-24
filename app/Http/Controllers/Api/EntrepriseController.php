<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EntrepriseRequest;
use App\Models\Entreprise;
use Illuminate\Http\JsonResponse;

class EntrepriseController extends Controller
{
    /**
     * Afficher toutes les entreprises.
     */
    public function index(): JsonResponse
    {
        return response()->json(Entreprise::all());
    }

    /**
     * Créer une entreprise.
     */
    public function store(EntrepriseRequest $request): JsonResponse
    {
        $entreprise = Entreprise::create([
            'user_id' => auth()->id(),
            'nom' => $request->nom,
            'secteur' => $request->secteur,
            'description' => $request->description,
            'logo' => $request->logo,
        ]);

        return response()->json([
            'message' => 'Entreprise créée avec succès.',
            'entreprise' => $entreprise,
        ], 201);
    }

    /**
     * Afficher une entreprise.
     */
    public function show(string $id): JsonResponse
    {
        $entreprise = Entreprise::findOrFail($id);

        return response()->json($entreprise);
    }

    /**
     * Modifier une entreprise.
     */
    public function update(EntrepriseRequest $request, string $id): JsonResponse
    {
        $entreprise = Entreprise::findOrFail($id);

        $entreprise->update($request->validated());

        return response()->json([
            'message' => 'Entreprise mise à jour avec succès.',
            'entreprise' => $entreprise,
        ]);
    }

    /**
     * Supprimer une entreprise.
     */
    public function destroy(string $id): JsonResponse
    {
        $entreprise = Entreprise::findOrFail($id);

        $entreprise->delete();

        return response()->json([
            'message' => 'Entreprise supprimée avec succès.'
        ]);
    }
}