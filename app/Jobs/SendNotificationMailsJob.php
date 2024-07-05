<?php

namespace App\Jobs;

use App\Models\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendNotificationMailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notifications = Notification::whereNotNull('mail_data')->where('mail_sent', 0)->get();

        foreach ($notifications as $notification) {
            $mail_content = json_decode($notification->mail_data, true);

            if ($mail_content['mail_template'] && $mail_content['send_to']) {
                Mail::send($mail_content['mail_template'], $mail_content, function ($message) use ($mail_content) {
                    $message->subject($mail_content['mail_title'] ? $mail_content['mail_title'] : 'Bildiriş');
                    $message->to($mail_content['send_to']);
                });

                Notification::where('id', $notification->id)->update([
                    'mail_sent' => 1
                ]);
            }
        }
    }
}
