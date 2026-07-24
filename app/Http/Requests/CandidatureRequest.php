<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidatureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'offre_id' => 'required|exists:offres,id',
            'statut' => 'required|in:en_attente,acceptee,refusee',
        ];
    }
}