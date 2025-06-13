<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'nim',
        'password',
        'role',
        'email_verified_at',
    ];

    // Check If User Is Admin
    public function isAdmin(){
        return $this->role == 'admin';
    }

    // Can Login With Email Polimedia Only
    public function findForLogin($identifier){
        return self::where('email', $identifier)
                    ->where('email', 'like', '%@polimedia.ac.id')
                    ->first();
    }
    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
