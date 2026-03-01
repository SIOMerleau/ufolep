<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Championnat extends Model
{
    use HasFactory;

    protected $table = 'championnat';
    protected $primaryKey = 'idChampionnat'; //id championnat
    
    protected $fillable = [ //colonne table
        'nomChampionnat',
        'typeChampionnat',
        'idDivision',
        'nomPoule',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class, 'idDivision');
    }

    public function engagement()
    {
        return $this->hasMany(Engagement::class, 'idChampionnat');
    }

    public function journees()
    {
        return $this->hasMany(Journee::class, 'idChampionnat', 'idChampionnat');
    }
    public function rencontres()
    {
        return $this->hasManyThrough(Rencontre::class, Journee::class, 'idChampionnat', 'idJournee', 'id', 'idJournee');
    }
}
