<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model {
    
    use HasFactory;
    
    protected $fillable = ['nombre', 'tipo', 'review', 'thumbnail', 'iduser', 'ncomments', 'stars'];
    
    protected $table = "review";
    
    function comments() {
        return $this->hasMany('App\Models\Comment', 'idreview');
    }
    
    function images() {
        return $this->hasMany('App\Models\Image', 'idreview');
    }
    
    function user() {
        return $this->belongsTo('App\Models\User', 'iduser');
    }
}
