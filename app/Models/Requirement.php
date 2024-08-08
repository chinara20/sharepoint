<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Requirement extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name'];

    // public function userRequirements()
    // {
    //     return $this->hasMany(UserRequirement::class, 'requirement_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
