<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AideRequest extends FormRequest
{
    //Determine si l'utilisateur est autorisé à effectuer cette demande. -> Vrai
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Récupérer les règles qui applique cette demande
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titre_aide' => 'required|string|max:255',
            'lien' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'titre_aide.required' => 'Le titre de l\'aide est obligatoire',
            'lien.required' => 'Le lien de l\'aide est obligatoire',
            'titre_aide.max' => 'Le titre de l\'aide ne doit pas dépasser 255 caractères',
            'lien.max' => 'Le lien de l\'aide ne doit pas dépasser 255 caractères',
        ];
    }
}
