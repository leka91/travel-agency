<?php

namespace App\Jobs;

use App\Services\EmailService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $toEmail;
    public $mail;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($toEmail, $mail)
    {
        $this->toEmail = $toEmail;
        $this->mail    = $mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        EmailService::sendMail($this->toEmail, $this->mail);
    }
}
