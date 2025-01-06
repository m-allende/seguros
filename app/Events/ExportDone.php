<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use App\Models\Notification;

use Illuminate\Foundation\Events\Dispatchable;

class ExportDone implements ShouldBroadcast, ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels, Queueable;
    public $filename;
    public $location;
    public $id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $filename, $location)
    {
        $this->id = $id;
        $this->filename = $filename;
        $this->location = $location;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new \Illuminate\Broadcasting\Channel('export-done');
    }

    public function handle()
    {
        //creo la notificacion para cuando se recarga la pagina
        $notification = Notification::whereId($id)->first();
        $notification->ready = true;
        $notification->update();
    }

}
