<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    /**
     * Une compétence appartient à plusieurs offres.
     */
    public function offres()
    {
        return $this->belongsToMany(
            Offre::class,
            'competence_offre'
        );
    }

    /**
     * Une compétence appartient à plusieurs candidats.
     */
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'competence_user'
        );
    }
}