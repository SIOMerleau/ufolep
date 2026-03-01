<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Joueur;
use App\Models\Equipe;
use App\Models\Rencontre;

class Remplacement extends Model
{
    /*Model de la table remplacement, 
    Clé Primaire = id
    Clé étrangère = idJournee, idEquipe, idRencontre
    */
    //use HasFactory;
    protected $table = 'remplacement';
    protected $primaryKey = 'id';

    protected $fillable = [
        'idJoueur',
        'idEquipe',
        'idRencontre',
    ];

    //Relation avec la table Joueur
    public function joueur()
    {
        return $this->belongsTo(Joueur::class, 'idJoueur');
    }
    //Relation avec la table Equipe
    public function equipe()
    {
        return $this->belongsTo(Equipe::class, 'idEquipe');
    }
    //Relation avec la table Rencontre
    public function rencontre()
    {
        return $this->belongsTo(Rencontre::class, 'idRencontre');
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
