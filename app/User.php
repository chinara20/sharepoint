<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\UserRequirement;
use Carbon\Carbon;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password', 'department_id', 'role_id', 'role', 'phone', 'internal_number', 'birthday_date', 'img', 'status', 'accept_date', 'permission', 'branch_id', 'guide_user_id'
    ];


    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['accept_date'];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function show_department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function show_branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
    public function userRequirements()
    {
        return $this->hasMany(UserRequirement::class, 'user_id');
    }
   

}