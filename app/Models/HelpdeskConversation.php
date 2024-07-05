<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpdeskConversation extends Model
{
    protected $fillable = ['helpdesk_id', 'user_id', 'forwarded_from', 'message', 'image'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function forwarded_user()
    {
        return $this->belongsTo('App\User', 'forwarded_from');
    }
}
