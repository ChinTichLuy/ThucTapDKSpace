<?php

namespace App\Services\Mail;

use Illuminate\Support\Facades\Mail;

class WelcomeMailService
{
    public function send(string $email): void
    {
        Mail::raw('Welcome to our blog system!', function ($message) use ($email) {
            $message->to($email)
                ->subject('Welcome!');
        });
    }
}
