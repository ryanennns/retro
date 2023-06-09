<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ColumnDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private int $sessionId;
    private int $columnId;

    public function __construct($sessionId, $columnId)
    {
        $this->sessionId = $sessionId;
        $this->columnId = $columnId;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel("retro-session-$this->sessionId"),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'column' => [
                'id' => $this->columnId,
            ],
        ];
    }

    public function broadcastAs()
    {
        return 'column-deleted';
    }
}
