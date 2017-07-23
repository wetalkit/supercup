<?php

namespace App\Listeners;

use Mail;
use App\Events\ContactHost;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContactHostMessage implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ContactHost  $event
     * @return void
     */
    public function handle(ContactHost $event)
    {
        $guest = $event->guest;
        $listing = $event->listing;
        $messageContent = $event->message;

        Mail::send('emails.contactHost', compact('guest', 'listing', 'messageContent'), function ($message) use ($guest, $listing) 
        {
            $message->to($listing->user->email, $listing->user->name);
            $message->replyTo($guest->email, $guest->name);
            $message->subject('A new request your free listing on '.config('app.name').'!');
        });
    }
}
