<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\User;
use App\Listing;

class ContactHost
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * User
     * @var App\User
     */
    public $guest;

    /**
     * Listing
     * @var App\Listing
     */
    public $listing;

    /**
     * Message
     * @var string
     */
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $guest, Listing $listing, $message = '')
    {
        $this->guest = $guest;
        $this->listing = $listing;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
