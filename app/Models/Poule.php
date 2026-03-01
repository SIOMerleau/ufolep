<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Equipe;
use App\Models\Championnat;

class Poule extends Model
{
    /*Model de la table poule, 
    Clé Primaire = idPoule
    Clé étrangère = idEquipe, idChampionnat
    Timestamps désactivés
    */
    //use HasFactory;
    protected $table = 'poule';
    protected $primaryKey = 'idPoule';
    public $timestamps = false;

    protected $fillable = [
        'idEquipe',
        'idChampionnat',
        'nomPoule',
    ];

    //Relation avec la table Equipe
    public function equipe(){
        return $this->belongsTo(Equipe::class, 'idEquipe', 'idEquipe');
    }
    //Relation avec la table Championnat
    public function championnat(){
        return $this->belongsTo(Championnat::class, 'idChampionnat', 'idChampionnat');
    }
}
