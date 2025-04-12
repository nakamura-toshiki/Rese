<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMail;
use Carbon\Carbon;

class SendReminder extends Command
{
    protected $signature = 'mail:send-reminder';

    protected $description = 'send reminder';

    public function handle()
    {
        $today = Carbon::today();

        $reservations = Reservation::whereDate('date', $today)->get();

        foreach ($reservations as $reservation) {
            $user = $reservation->user;

            Mail::to($user->email)->send(new ReminderMail($reservation));
        }

        $this->info('リマインダーメール送信完了');
    }
}
