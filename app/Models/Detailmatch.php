<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Rencontre;
use App\Models\Joueur;

class Detailmatch extends Model
{
    /*Model de la table detailmatch, 
    Clé Primaire = idMatch
    Clé étrangère = idRencontre, idJR, idJV
    Timestamps désactivés
    */
    //use hasFactory;
    protected $table = 'detailmatch';

    protected $primaryKey = 'idMatch';

    protected $fillable = [
        'pointsA',
        'pointsB',
        'idJR',
        'lettreR',
        'idJV',
        'lettreV',
        'idRencontre',
        'M1',
        'M2',
        'M3',
        'M4',
        'M5',
        'M1B',
        'M2B',
        'M3B',
        'M4B',
        'M5B',
        'classementJoueurA',
        'classementJoueurB'
    ];

    //Relation avec la table Rencontre
    public function rencontre(): BelongsTo {
        return $this->belongsTo(Rencontre::class, 'idRencontre');
    }
    //Relation avec la table Joueur
    public function joueurA(): BelongsTo {
        return $this->belongsTo(Joueur::class, 'idJR', 'idJoueur');
    }
    //Relation avec la table Joueur
    public function joueurB(): BelongsTo {
        return $this->belongsTo(Joueur::class, 'idJV', 'idJoueur');
    }

    

}

