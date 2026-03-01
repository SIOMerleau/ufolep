<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arbitre extends Model
{
    use HasFactory;

    protected $table = 'arbitre';
    protected $primaryKey = 'idArbitre'; //id arbitre

    protected $fillable = [
        'idCompte',
        'idPersonne'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idCompte');
    }
    
    //Relation avec la table personne
    public function personne()
    {
        return $this->belongsTo(Personne::class, 'idPersonne');
    }
}
