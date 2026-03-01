<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rencontre extends Model
{
    /*Model de la table rencontre, 
    Clé Primaire = idRencontre
    Clé étrangère = idJournee, idEquipeA, idEquipeB
    Timestamps désactivés
    */

    //use HasFactory;
    protected $table = 'rencontre';
    protected $primaryKey = 'idRencontre';
    public $timestamps = false;

    protected $fillable = [
        'heure',
        'date',
        'lieu',
        'scoreFinalA',
        'scoreFinalB',
        'ptsDbA',
        'ptsDbB',
        'idJournee',
        'idArbitre',
        'idEquipeA',
        'idEquipeB',
        'victoire',
        'WO',
        'D1',
        'D2',
        'D3',
        'D4',
        'D5',
        'D1B',
        'D2B',
        'D3B',
        'D4B',
        'D5B',
        'statut',
        'verrou',
    ];

    //Relation avec la table Journee
    public function journee()
    {
        return $this->belongsTo(Journee::class, 'idJournee', 'idJournee');
    }
    //Relation avec la table Equipe pour idEquipeA
    public function equipeA()
    {
        return $this->belongsTo(Equipe::class, 'idEquipeA', 'idEquipe');
    }
    //Relation avec la table Equipe pour idEquipeB
    public function equipeB()
    {
        return $this->belongsTo(Equipe::class, 'idEquipeB', 'idEquipe');
    }


    public function detailsMatch()
{
    return $this->hasMany(Detailmatch::class, 'idRencontre'); // 'idRencontre' doit être la clé étrangère dans la table details_match
}

public function arbitre()
{
    return $this->belongsTo(Joueur::class, 'idArbitre'); // 'idArbitre' est la clé étrangère dans la table 'rencontre'
}
}
