<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classement extends Model
{
    /*Model de la table classement, 
    Clé Primaire = idClassement
    Timestamps désactivés
    clé étrangère idChampionnat référence la table championnat
    clé étrangère idEquipe référence la table equipe
    */
    //use HasFactory;
    protected $table = 'classement';

    protected $primaryKey = 'idClassement';
    public $timestamps = false;

    protected $fillable = [
        'idChampionnat',
        'idEquipe',
        'nbPoints',
        'matchesGagnes',
        'matchesPerdus',
    ];

    //Relation avec la table championnat
    public function championnat()
    {
        return $this->belongsTo(Championnat::class, 'idChampionnat');
    }
    //Relation avec la table equipe
    public function equipe()
    {
        return $this->belongsTo(Equipe::class, 'idEquipe');
    }
}
