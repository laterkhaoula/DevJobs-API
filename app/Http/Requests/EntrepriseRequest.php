<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntrepriseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'secteur' => 'required|string|max:255',
            'description' => 'required|string',
            'logo' => 'nullable|string|max:255',
        ];
    }

    /**
     * Messages d'erreur personnalisés.
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'secteur.required' => 'Le secteur est obligatoire.',
            'description.required' => 'La description est obligatoire.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'secteur.max' => 'Le secteur ne doit pas dépasser 255 caractères.',
            'logo.max' => 'Le logo ne doit pas dépasser 255 caractères.',
        ];
    }
}