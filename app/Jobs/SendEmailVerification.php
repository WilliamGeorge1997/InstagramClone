<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class SendEmailVerification implements ShouldQueue
{
    protected $user;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle(): void
    {
        $currentEmail = $this->user->email;

        $this->user->refresh(); 

        if ($this->user instanceof MustVerifyEmail && !$this->user->hasVerifiedEmail()) {
            if ($this->user->email !== $currentEmail) { 
                $this->user->sendEmailVerificationQueuedNotification();
            }
        }
    }
}
