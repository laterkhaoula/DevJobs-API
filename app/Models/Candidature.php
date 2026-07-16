<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'offre_id',
        'statut',
    ];

    /**
     * Une candidature appartient à un candidat.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Une candidature appartient à une offre.
     */
    public function offre()
    {
        return $this->belongsTo(Offre::class);
    }
}