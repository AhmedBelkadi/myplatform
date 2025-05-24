<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    // Autoriser l'assignation massive pour ces champs
    protected $fillable = [
        'name',
        'email',
        'password',
//        'telephone',
//        'ville',
    ];

    // Optionnel : pour des raisons de sécurité, on peut exclure certains champs comme le mot de passe
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Si tu veux ajouter une logique pour la modification du mot de passe avant l'enregistrement
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}


