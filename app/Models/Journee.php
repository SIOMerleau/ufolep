<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Championnat;

class Journee extends Model
{
    /*Model de la table journee, 
    Clé Primaire = idJournee
    Clé étrangère = idChampionnat
    Timestamps désactivés
    */
    protected $table = 'journee';

    protected $primaryKey = 'idJournee';
    public $timestamps = false;

    protected $fillable = [
        'numJournee',
        'datePrev',
        'idChampionnat',
    ];

    //Relation avec la table Championnat
    public function championnat() {
        return $this->belongsTo(Championnat::class, 'idChampionnat');
    }
    public function rencontres()
    {
        return $this->hasMany(Rencontre::class, 'idJournee', 'idJournee');
    }
}
