<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function apellido()
    {
        return $this->hasOne(Apellido::class);
    }

    public function getImageUserAttribute()
    {
        return $this->profile_photo_path ?? 'img/tecnico.png';
    }

    public function getRolAttribute(): string
    {
        if($this->role == 'admin') {
            return 'Administrador';
        }

        return $this->role === 'seller' ? 'Vendedor' : 'Cliente';
    }

    public function scopeTermino($query, $termino)
    {
        if($termino === '') {
            return;
        }

        return $query->where('name', 'like',"%{$termino}%")
        ->orWhere('email', 'like',"%{$termino}%")
        ->orWhereHas('apellido', function($query2) use ($termino){
            $query2->where('lastname', 'like', "%{$termino}%");
        });
    }

    public function scopeRole($query, $role)
    {
        if($role === '') {
            return;
        }

        return $query->whereRole($role);
    }
}
