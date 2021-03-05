<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\Categorie');
    }
    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function favoriesUsers()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
