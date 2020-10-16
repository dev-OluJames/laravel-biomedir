<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Categorie', 'categorie_id');
    }

    public function child()
    {
        return $this->hasMany('App\Models\Categorie', 'categorie_id');
    }
}
