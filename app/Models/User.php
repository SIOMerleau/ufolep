<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Personne;
use  \Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    /*Model de la table users, 
    Clé Primaire idCompte
    Clé étrangères idPersonne vers la table personne
    */
    //use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'idCompte';
    protected $fillable = [
        'identifiant',
        'password',
        'typeCompte',
        'idPersonne',
    ];

    //Attributs cachés/sensibles
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
     //Relation avec la table personne
    public function personne():BelongsTo {
        return $this->belongsTo(Personne::class, 'idPersonne');
    }
}
