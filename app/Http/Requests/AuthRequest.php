<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'user' => 'required|string',
            'passwd' => 'required|string'
        ];
    }

    public function messages(): array
    {
        return [
            'user.required' => 'Le champ utilisateur est obligatoire',
            'passwd.required' => 'Le champ mot de passe est obligatoire'
        ];
    }
}
