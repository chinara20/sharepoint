<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
  protected $fillable = [
    'user_id',
    'time_start',
    'time_end',
    'subject',
    'description',
    'type',
    'to_id'
  ];
  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function confirmed_by()
  {
    return $this->belongsTo('App\User', 'to_id');
  }
  public function get_status()
  {
    if ($this->status == 3) {
      return 'pending';
    }
  }
}
