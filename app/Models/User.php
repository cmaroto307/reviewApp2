<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail {
    
    use HasApiTokens, HasFactory, Notifiable;

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    function comments() {
        return $this->hasMany('App\Models\Comment', 'iduser');
    }

    function isAdmin() {
        return $this->type == 'admin';
    }

    function isAdvanced() {
        return $this->type == 'advanced' || $this->type == 'admin';
    }

    function isUser() {
        return $this->type == 'user' || $this->type == 'advanced' || $this->type == 'admin';
    }

    function isVerified() {
        return $this->email_verified_at != null;
    }
    
    function reviews() {
        return $this->hasMany('App\Models\Review', 'iduser');
    }
}
