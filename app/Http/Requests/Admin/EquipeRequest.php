<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EquipeRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nomEquipe' => 'required|string|max:255',
            'idClub' => 'required|exists:club,idClub',
            'idDivision' => 'required|exists:division,idDivision',
        ];
    }

    public function messages(): array{
        return [
            'nomEquipe.required' => 'Le nom de l\'équipe est obligatoire',
            'nomEquipe.string' => 'Le nom de l\'équipe doit être une chaine de caractères',
            'nomEquipe.max' => 'Le nom de l\'équipe ne doit pas dépasser 255 caractères',

            'idClub.required' => 'Le club est obligatoire',
            'idClub.exists' => 'Le club n\'existe pas',

            'idDivision.required' => 'La division est obligatoire',
            'idDivision.exists' => 'La division n\'existe pas',
        ];
    }
}
