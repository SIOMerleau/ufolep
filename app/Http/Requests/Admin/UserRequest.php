<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'identifiant' => 'required|string',
            'password' => 'required|string|confirmed',
            'typeCompte' => 'required|string|in:ARBITRE,GÉRANT'
        ];
    }

    public function messages(): array {
        return [
            'idPersonne.required' => 'L\'identifiant de la personne est obligatoire.',
            'idPersonne.integer' => 'L\'identifiant de la personne doit être un entier.',

            'identifiant.required' => 'L\'identifiant est obligatoire.',
            'identifiant.string' => 'L\'identifiant doit être une chaîne de caractères.',

            'password.required' => 'Le mot de passe est obligatoire.',
            'password.string' => 'Le mot de passe doit être une chaîne de caractères.',

            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            
            'typeCompte.required' => 'Le type de compte est obligatoire.',
            'typeCompte.string' => 'Le type de compte doit être une chaîne de caractères.',
            'typeCompte.in' => 'Le type de compte doit être ARBITRE ou GÉRANT.'
        ];
    }
}
