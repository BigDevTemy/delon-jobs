<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;
use App\Mail\SendMails;
use Mail;

class SubscribeMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $subscribers;

    /**
     * Create a new job instance.
     *
     * @param array $subscribers
     * @return void
     */
    public function __construct($subscribers)
    {
        $this->subscribers = $subscribers;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendMails();

        foreach ($this->subscribers as $subscriber) {
            try {
                Mail::to($subscriber['email'])
                ->subject($subscriber['title'])
                ->from('sender@example.com', $subscriber['name'])
                ->send($email);
            } catch (\Exception $e) {
                // Handle any exceptions that may occur during the email sending process
                // You can log the error, notify the administrator, or handle it in any other way
                logger()->error('Error sending email to ' . $subscriber['email'] . ': ' . $e->getMessage());
            }
        }
    }
}