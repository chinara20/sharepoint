<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Requirement;

class UserRequirement extends Model
{
    protected $fillable = ['user_id', 'requirement_id', 'status', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requirement()
    {
        return $this->belongsTo(Requirement::class, 'requirement_id');
    }
   
    
}
