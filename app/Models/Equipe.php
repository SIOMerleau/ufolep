<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Club;
use App\Models\Division;
use Illuminate\Support\Str;

class Equipe extends Model
{
    /*Model de la table equipe, 
    Clé Primaire = idEquipe
    Clé étrangère = idClub, idDivision
    Timestamps désactivés
    */
    //use hasFactory;
    protected $table = 'equipe';

    protected $primaryKey = 'idEquipe';

    public $timestamps = false;

    protected $fillable = [
        'nomEquipe',
        'idClub',
        'idDivision',
        'nbPts',
        'idChampionnat',
        'nomPoule',
        'matchesGagnes',
        'matchesPerdus',
        'manchesGagnees',
        'manchesPerdues',
    ];

    //Relation avec la table Club
    public function club()
    {
        return $this->belongsTo(Club::class, 'idClub', 'idClub');
    }

    //Relation avec la table Division
    public function division()
    {
        return $this->belongsTo(Division::class, 'idDivision', 'idDivision');
    }

    public function joueurs()
    {
        return $this->hasMany(Joueur::class, 'idClub');
    }

    public function estEquipeSmash()
{
    return Str::contains(strtolower($this->nomEquipe), 'smash'); // Utilisation de Str::contains pour une recherche insensible à la casse
}



    
}
