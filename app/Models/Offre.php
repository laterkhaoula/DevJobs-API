<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;

    protected $fillable = [
        'entreprise_id',
        'titre',
        'description',
        'type_contrat',
    ];

    /**
     * Une offre appartient à une entreprise.
     */
    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    /**
     * Une offre possède plusieurs candidatures.
     */
    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }

    /**
     * Une offre possède plusieurs compétences.
     */
    public function competences()
    {
        return $this->belongsToMany(
            Competence::class,
            'competence_offre'
        );
    }
}