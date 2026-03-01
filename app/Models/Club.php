<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ville;

class Club extends Model
{
    use HasFactory;

    protected $table = 'club';
    protected $primaryKey = 'idClub'; //id club
    public $incrementing = true;

    protected $fillable = [//colonne table
        'nomClub', 
        'sponsor', 
        'nomSalle', 
        'adresseSalle',
        'idVille'
    ];

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'idVille');
    }

    public function equipes(){
        return $this->hasMany(Equipe::class, 'idClub');
    }
}

