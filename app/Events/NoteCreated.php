<?php

namespace App\Events;

use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NoteCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private int $sessionId;
    private Note $note;

    public function __construct($sessionId, $note)
    {
        $this->sessionId = $sessionId;
        $this->note = $note;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel("retro-session-{$this->sessionId}"),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'note' => new NoteResource($this->note),
        ];
    }

    public function broadcastAs()
    {
        return 'retro-note-created';
    }
}
