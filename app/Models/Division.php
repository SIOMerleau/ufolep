<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $table = 'division';
    protected $primaryKey = 'idDivision'; //id division

    protected $fillable = [//colonne table
        'nomDivision',
    ];

    public function championnats()
    {
        return $this->hasMany(Championnat::class, 'idDivision');
    }
}
