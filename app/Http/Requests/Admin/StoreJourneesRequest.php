<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreJourneesRequest extends FormRequest
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
        //Création des rgles de validation
        $rules =  [];
        //Boucle pour la création des règles de validation pour chaque journée
        for ($i = 1; $i <= $this->route('nombre_journees'); $i++) {
            $rules["datePrev-{$i}"] = 'required|date';
            for ($j = 1; $j <= 3; $j++) {
                $rules["lieu_{$i}_{$j}"] = 'required|string';
                $rules["idEquipeA_{$i}_{$j}"] = "required|integer|different:idEquipeB_{$i}_{$j}";
                $rules["idEquipeB_{$i}_{$j}"] = "required|integer|different:idEquipeA_{$i}_{$j}";
            }
        }
        //Retourne les règles de validation
        return $rules;
    }
    
    //Message d'erreurs de validation personnalisés
    public function messages(){
        return [
           'datePrev-*.required' => 'La date de chaque journée est obligatoire.',
            'datePrev-*.date' => 'La date de chaque journée doit être une date valide.',
            'lieu_*.required' => 'Le lieu de chaque rencontre est obligatoire.',
            'idEquipeA_*.required' => 'L\'équipe résidente est obligatoire.',
            'idEquipeB_*.required' => 'L\'équipe visiteuse est obligatoire.',
            'idEquipeA_*.different' => 'L\'équipe résidente doit être différente de l\'équipe visiteuse.',
            'idEquipeB_*.different' => 'L\'équipe visiteuse doit être différente de l\'équipe résidente.',
        ];
    }
}
