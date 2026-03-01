<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    use HasFactory;

    protected $table = 'ville';
    protected $primaryKey = 'idVille'; //id ville

    protected $fillable = [ //colonnes de la table ville
        'nomVille',
        'codePostal',
    ];

    // Ajoutez une relation si nécessaire
    public function clubs()
    {
        return $this->hasMany(Club::class, 'idVille');
    }
}
