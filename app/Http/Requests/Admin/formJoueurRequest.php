<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class formJoueurRequest extends FormRequest
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
            'idPersonne' => 'required|integer',

            'classement' => 'required|integer',
            'classement_fftt' => 'required|integer',
            'visible' => 'required|integer',

            'licenceJoueur' => 'required|string|min:4',

            'idEquipe' => 'required|integer',
            'idClub' => 'required|integer',
        ];
    }

    public function messages(): array{
        return [
            'idPersonne.required' => 'Le champ Personne est requis',
            'idPersonne.integer' => 'Le champ idPersonne doit être un entier',

            'classement.required' => 'Le champ classement est requis',
            'classement.integer' => 'Le champ classement doit être un entier',

            'classement_fftt.required' => 'Le champ classement_fftt est requis',
            'classement_fftt.integer' => 'Le champ classement_fftt doit être un entier',

            'visible.required' => 'Le champ visible est requis',
            'visible.integer' => 'Le champ visible doit être un entier',

            'licenceJoueur.required' => 'Le champ licenceJoueur est requis',
            'licenceJoueur.string' => 'Le champ licenceJoueur doit être une chaine de caractère',
            'licenceJoueur.min' => 'Le champ licenceJoueur doit contenir au moins 4 caractères',

            'idEquipe.required' => 'Le champ Equipe est requis',
            'idEquipe.integer' => 'Le champ idEquipe doit être un entier',

            'idClub.required' => 'Le champ Club est requis',
            'idClub.integer' => 'Le champ idClub doit être un entier',
        ];
    }
}
