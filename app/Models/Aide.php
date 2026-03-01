<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aide extends Model
{
    /*Model de la table aide, 
    Clé Primaire = id
    Timestamps désactivés
    */
    //use HasFactory;
    protected $table = 'aide';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'titre_aide',
        'lien',
    ];
}
