<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CursorMoved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $documentId;
    public $userId;
    public $userName;
    public $position;
    public $color;

    public function __construct($documentId, $userId, $userName, $position, $color)
    {
        $this->documentId = $documentId;
        $this->userId = $userId;
        $this->userName = $userName;
        $this->position = $position;
        $this->color = $color;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('document.' . $this->documentId);
    }
    public function broadcastAs(): string
    {
        return 'cursor.moved';
    }
}