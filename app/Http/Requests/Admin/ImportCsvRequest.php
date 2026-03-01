<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ImportCsvRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'csv_file' => 'required|file|mimes:csv',
        ];
    }
    public function messages(): array {
        return [
            'csv_file.required' => 'Le fichier csv est requis',
            'csv_file.file' => 'Le champ doit être un fichier',
            'csv_file.mimes' => 'Le fichier doit être un fichier de type .csv',
            'csv_file.uploaded' => 'Erreur fichier, essayer un fichier .csv',
        ];
    }
}
