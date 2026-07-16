<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'password',
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Une entreprise appartient à un utilisateur.
     */
    public function entreprise()
    {
        return $this->hasOne(Entreprise::class);
    }

    /**
     * Un candidat possède plusieurs candidatures.
     */
    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }

    /**
     * Un candidat possède plusieurs compétences.
     */
    public function competences()
    {
        return $this->belongsToMany(
            Competence::class,
            'competence_user'
        );
    }
}