<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model {
    
    use HasFactory;
    
    protected $fillable = ['name'];
    
    protected $table = "image";
    
    function review() {
        return $this->belongsTo('App\Models\Review', 'idreview');
    }
    
    function storeImg($images, $id) {
        foreach($images as $img) {
            $originalName = $img->getClientOriginalName();
            $image = new Image();
            $image->name = $originalName;
            $image->idreview = $id;
            $image->save();
            $img->storeAs('public/images' , $originalName);
        }
    }
}
