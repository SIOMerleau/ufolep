<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JoueurUpdateRequest extends FormRequest
{
    /**
     * Determine si l'utilisateur est autorisé à effectuer cette demande. -> Vrai
     */
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
            'visible' => 'required|integer',
            'classement' => 'required|integer|min:500',
            'classement_fftt' => 'required|integer',

            'licenceJoueur' => 'required|string|max:32',

            'idEquipe' => 'required|integer',
            'idClub' => 'required|integer',
        ];
    }
    
    public function messages(): array{
        return [
            'visible.required' => 'Le champ visible est obligatoire.',
            'visible.integer' => 'Le champ visible doit être un entier.',

            'classement.required' => 'Le champ classement est obligatoire.',
            'classement.integer' => 'Le champ classement doit être un entier.',
            'classement.min' => 'Le champ classement doit être supérieur ou égal à 500.',

            'classement_fftt.required' => 'Le champ classement fftt est obligatoire.',
            'classement_fftt.integer' => 'Le champ classement fftt doit être un entier.',

            'licenceJoueur.required' => 'Le champ licenceJoueur est obligatoire.',
            'licenceJoueur.string' => 'Le champ licenceJoueur doit être une chaîne de caractères.',
            'licenceJoueur.max' => 'Le champ licenceJoueur ne doit pas dépasser 32 caractères.',

            'idEquipe.required' => 'Le champ Equipe est obligatoire.',
            'idEquipe.integer' => 'Le champ idEquipe doit être un entier.',

            'idClub.required' => 'Le champ Club est obligatoire.',
            'idClub.integer' => 'Le champ idClub doit être un entier.',
        ];
    }
}
