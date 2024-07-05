<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentCirculation extends Model
{
    protected $fillable=[
        'name','user_id','file'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
