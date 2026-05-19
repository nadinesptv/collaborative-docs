<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DocumentUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $documentId;
    public $userId;
    public $userName;
    public $content;
    public $changeType;

    public function __construct($documentId, $userId, $userName, $content, $changeType = 'edit')
    {
        $this->documentId = $documentId;
        $this->userId = $userId;
        $this->userName = $userName;
        $this->content = $content;
        $this->changeType = $changeType;
    }

    public function broadcastOn(): Channel
    {
        return new Channel('document.' . $this->documentId);
        }

    public function broadcastAs(): string
    {
        return 'document.updated';
    }
}