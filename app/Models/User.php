<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Autoriser l'assignation massive pour ces champs
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'  // Add this to allow mass assignment
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

    // Change to single role relationship
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }

    public function hasRole($roleName)
    {
        return $this->role && $this->role->name === $roleName;
    }

    public function hasPermission($permissionName)
    {
        if ($this->role && $this->role->permissions) {
            return $this->role->permissions->contains('name', $permissionName);
        }
        return false;
    }
}


