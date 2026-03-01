<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Joueur extends Model
{
    use HasFactory;

    protected $table = 'joueur';
    protected $primaryKey = 'idJoueur'; // id joeur

    protected $fillable = [//colonne table
        'licenceJoueur',
        'idClub',
        'visible',
        'idEquipe',
        'classement',
        'classement_fftt',
        'idPersonne',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class, 'idClub');
    }

    public function equipe()
    {
        return $this->belongsTo(Equipe::class, 'idEquipe');
    }

    //Relation avec la table personne
    public function personne()
    {
        return $this->belongsTo(Personne::class, 'idPersonne');
    }
}
