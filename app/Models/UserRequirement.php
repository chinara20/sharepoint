<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Requirement;

class UserRequirement extends Model
{
    protected $fillable = ['user_id', 'requirement_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function requirement()
    {
        return $this->belongsTo(Requirement::class, 'requirement_id');
    }
}



