<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  \Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Personne extends Model
{
    //use HasFactory;
     /*Model de la table personne, 
    Clé Primaire idPersonne
    Clé étrangères idCompte vers la table user 
    & idJoueur vers la table joueur
    */
    //use HasFactory, Notifiable;

    protected $table = 'personne';
    protected $primaryKey = 'idPersonne'; //id personne

    protected $fillable = [//colonne table
        'nom',
        'prenom',
        'age',
        'date_naissance',
        'sexe',
        'mail',
        'adresse',
        'idCompte',
        'idJoueur'
    ];

    //Relation avec la table user
    public function user():BelongsTo {
        return $this->belongsTo(User::class, 'idCompte');
    }
    //Relation avec la table joueur
    public function joueur():BelongsTo {
        return $this->belongsTo(Joueur::class, 'idJoueur');
    }
     
}

