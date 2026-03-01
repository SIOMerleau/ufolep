<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Rencontre;

class UpdateRencontreRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ou une logique d'autorisation plus précise si nécessaire
    }

    public function rules()
    {
        return [
            'date' => 'required|date', // Validation pour la date
            'heure' => 'required|date_format:H:i', // Validation pour l'heure (format H:i pour 24h)
            'lieu' => 'required|string|max:255', // Validation pour le lieu
            'ptsDbA' => 'required|integer|min:0',
            'ptsDbB' => 'required|integer|min:0',
            'scoreFinalA' => 'required|integer|min:0',
            'scoreFinalB' => 'required|integer|min:0',
            'D1' => 'nullable|integer|min:0',
            'D2' => 'nullable|integer|min:0',
            'D3' => 'nullable|integer|min:0',
            'D4' => 'nullable|integer|min:0',
            'D5' => 'nullable|integer|min:0',
            'D1B' => 'nullable|integer|min:0',
            'D2B' => 'nullable|integer|min:0',
            'D3B' => 'nullable|integer|min:0',
            'D4B' => 'nullable|integer|min:0',
            'D5B' => 'nullable|integer|min:0',
            // Ajoutez d'autres règles de validation si nécessaire
        ];
    }

    public function messages() {
        return [
            'date.required' => 'La date de la rencontre est requise.',
            'date.date' => 'Le format de la date est invalide.',

            'heure.required' => 'L\'heure de la rencontre est requise.',
            'heure.date_format' => 'Le format de l\'heure est invalide (HH:MM).',

            'ptsDbA.required' => 'Le nombre de points de l\'équipe A est requis.',
            'ptsDbB.required' => 'Le nombre de points de l\'équipe B est requis.',
            
            'scoreFinalA.required' => 'Le score final de l\'équipe A est requis.',
            'scoreFinalB.required' => 'Le score final de l\'équipe B est requis.',

            'ptsDbA.integer' => 'Le nombre de points de l\'équipe A doit être un entier.',
            'ptsDbB.integer' => 'Le nombre de points de l\'équipe B doit être un entier.',

            'scoreFinalA.integer' => 'Le score final de l\'équipe A doit être un entier.',
            'scoreFinalB.integer' => 'Le score final de l\'équipe B doit être un entier.',

            'ptsDbA.min' => 'Le nombre de points de l\'équipe A doit être au minimum 0.',
            'ptsDbB.min' => 'Le nombre de points de l\'équipe B doit être au minimum 0.',
            
            'scoreFinalA.min' => 'Le score final de l\'équipe A doit être au minimum 0.',
            'scoreFinalB.min' => 'Le score final de l\'équipe B doit être au minimum 0.',
        ];
    }
}