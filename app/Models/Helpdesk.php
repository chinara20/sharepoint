<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Helpdesk extends Model
{
    protected $fillable = ['user_id', 'title', 'category_id', 'status'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\HelpdeskCategory', 'category_id');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\HelpdeskConversation', 'helpdesk_id');
    }

    public function responder()
    {
        return $this->hasOne('App\Models\HelpdeskForward')->latest();
    }

    public function forwards()
    {
        return $this->hasMany('App\Models\HelpdeskForward', 'helpdesk_id');
    }

    public function get_status()
    {

        switch ($this->status) {
            case 'pending':
                return ['text' => 'Gözləmədə  <i class="fa fa-clock-o" aria-hidden="true"></i>', 'class' => 'warning'];
                break;
            case 'activ':
                return ['text' => 'Aktiv', 'class' => 'primary'];
                break;
            case 'success':
                return ['text' => 'Həll olundu <i class="fa fa-check" aria-hidden="true"></i>', 'class' => 'success'];
                break;
            case 'unsuccess':
                return ['text' => 'Uğursuz <i class="fa fa-times" aria-hidden="true"></i>', 'class' => 'danger'];
                break;
            case 'forwarded':
                return ['text' => 'Yönləndirildi <i class="fa-solid fa-share"></i>', 'class' => 'warning'];
                break;
        }
    }
}
