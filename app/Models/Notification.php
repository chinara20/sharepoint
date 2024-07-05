<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['user_id', 'from_id', 'url', 'content', 'type', 'status', 'mail_data', 'mail_sent'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function reviewer()
    {
        return $this->belongsTo('App\User', 'from_id');
    }
}
