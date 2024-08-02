<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talant extends Model
{
   protected $fillable = [
        'user_id', 'title', 'description', 'file'
    ];
   public function user()
     {
       return $this->belongsTo('App\User');
     }
}
