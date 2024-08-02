<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpdeskForward extends Model
{
    protected $fillable = ['helpdesk_id', 'user_id', 'forwarded_from', 'forward_to', 'forwarded_at', 'finished_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function desk()
    {
        return $this->belongsTo('App\Models\Helpdesk', 'helpdesk_id');
    }

    public function forwarded_user()
    {
        return $this->belongsTo('App\User', 'forward_to');
    }

    public function forwarded_from_details()
    {
        return $this->belongsTo('App\User', 'forwarded_from');
    }
}
