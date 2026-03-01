<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Championnat;
use App\Models\Joueur;

class Participation extends Model
{
    /*Model de la table participation, 
    Clé Primaire = id
    Clé étrangère = idJoueur, idChampionnat
    */
    //use hasFactory;
    protected $table = 'participation';

    protected $primaryKey = 'id';

    protected $fillable = [
        'idJoueur',
        'idChampionnat',
        'classement',
    ];

    //Relation avec la table Championnat
    public function championnat()
    {
        return $this->belongsTo(Championnat::class, 'idChampionnat');
    }
    //Relation avec la table Joueur
    public function joueur()
    {
        return $this->belongsTo(Joueur::class, 'idJoueur');
    }

    // methode pour gérer la clé primaire composite lors des opérations de sauvegarde
    /*
    protected function setKeysForSaveQuery($query)
    {
        $query
            ->where('idJoueur', '=', $this->getAttribute('idJoueur'))
            ->where('idEquipe', '=', $this->getAttribute('idEquipe'))
            ->where('idRencontre', '=', $this->getAttribute('idRencontre'));

        return $query;
    }
        */
}
