<?php

namespace App\Http\Controllers;

use App\Models\Helpdesk;
use App\Models\HelpdeskConversation;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HelpdeskConversationController extends Controller
{
    public function store(Request $request, $first_message = false)
    {
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'helpdesk_id' => 'required|integer',
            'message' => 'required',
        ]);

        $image = null;

        if ($request->file('image')) {
            $image = $request->file('image')->store('helpdesk', 'public');
        }

        HelpdeskConversation::create([
            'helpdesk_id' =>  $request['helpdesk_id'],
            'user_id' =>  Auth::user()->id,
            'message' => $request['message'],
            'image' => $image
        ]);

        if (!$first_message) {
            $desk = Helpdesk::where('id', $request['helpdesk_id'])->first();

            if ($desk->status == 'pending' || !$desk->responder) return redirect()->back();

            if ($desk->responder->user->id == Auth::user()->id) {
                $user_id = $desk->user_id;
                $send_to = $desk->user->email;
                $fullname = $desk->user->name;
            } else {
                $user_id = $desk->responder->user->id;
                $send_to = $desk->responder->user->email;
                $fullname = $desk->responder->user->name;
            }

            Notification::create([
                'user_id' => $user_id,
                'from_id' => Auth::user()->id,
                'url' => route('helpdesk.show', $desk->id),
                'content' => 'sorğuya cavab yazdı.',
                'mail_data' => json_encode([
                    'fullname' =>  $fullname,
                    'line1' => Auth::user()->name . ', H-' . str_pad($desk->id, 6, 0, STR_PAD_LEFT) . '(' . $desk->title . ') nömrəli dəstək sorğusuna mesaj yazdı !',
                    'url' => route('helpdesk.show', $desk->id),
                    'copyright' => '© ' . date('Y') . ' ' . env('APP_NAME') . '. All rights reserved.',
                    'mail_template' => 'emails.helpdesk.change_status',
                    'send_to' => $send_to,
                    'mail_title' => 'Helpdesk sorğu bildirişi. (mesaj)'
                ])
            ]);
        }

        return redirect()->back();
    }
}
