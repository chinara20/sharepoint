<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function toggle_status($id)
    {
        $notfication = Notification::find($id);

        if ($notfication->user_id == Auth::user()->id) {
            $notfication->update([
                'status' => 1
            ]);

            if ($notfication && $notfication->url) {
                return redirect($notfication->url);
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function read_all()
    {
        Notification::where('user_id', Auth::user()->id)->where('status', 0)->update(['status' => 1]);
        return redirect()->back();
    }
}
