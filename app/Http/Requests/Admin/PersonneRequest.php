<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PersonneRequest extends FormRequest
{

    //Autorisation -> oui
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:64',
            'prenom' => 'required|string|max:64',
            'date_naissance' => 'nullable|date',
            'age' => 'nullable|integer',
            'sexe' => 'required|string|in:M,F|max:1',
            'mail' => 'nullable|email|max:64',
            'adresse' => 'nullable|string|max:128',
        ];
    }

    public function messages(): array {
        return [
            'nom.required' => 'Le nom est obligatoire',
            'nom.string' => 'Le nom doit être une chaine de caractères',
            'nom.max' => 'Le nom ne doit pas dépasser 64 caractères',

            'prenom.required' => 'Le prénom est obligatoire',
            'prenom.string' => 'Le prénom doit être une chaine de caractères',
            'prenom.max' => 'Le prénom ne doit pas dépasser 64 caractères',

            'date_naissance.date' => 'La date de naissance doit être une date',

            'age.integer' => 'L\'âge doit être un entier',

            'sexe.required' => 'Le sexe est obligatoire',
            'sexe.string' => 'Le sexe doit être une chaine de caractères',
            'sexe.in' => 'Le sexe doit être M ou F',
            'sexe.max' => 'Le sexe ne doit pas dépasser 1 caractère',

            'mail.email' => 'Le mail doit être une adresse mail',
            'mail.max' => 'Le mail ne doit pas dépasser 64 caractères',
            
            'adresse.string' => 'L\'adresse doit être une chaine de caractères',
            'adresse.max' => 'L\'adresse ne doit pas dépasser 128 caractères',
        ];
    }
}
