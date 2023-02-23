<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    
    use HasFactory;
    
    protected $fillable = ['text', 'stars'];
    
    protected $table = "comment";
    
    function review() {
        return $this->belongsTo('App\Models\Review', 'idreview');
    }
    
    function user() {
        return $this->belongsTo('App\Models\User', 'iduser');
    }
}
