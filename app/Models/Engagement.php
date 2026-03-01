<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Engagement extends Model
{
    use HasFactory;

    protected $table = 'engagement';
    protected $primaryKey = 'idEngagement'; //id engagement 

    protected $fillable = [//colonne table
        'idEquipe',
        'idChampionnat',
        'nbPoints',
        'matchesGagnes',
        'matchesPerdus',
        'differ',
        'oldScore',
        'scoreFinal',
    ];

    public function equipe()
    {
        return $this->belongsTo(Equipe::class, 'idEquipe');
    }

    public function championnat()
    {
        return $this->belongsTo(Championnat::class, 'idChampionnat');
    }
}

