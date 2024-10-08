<?php

namespace App\Events;

use App\Models\Project\ProjectThread;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProjectThreadCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $projectThread;

    /**
     * Create a new event instance.
     */
    public function __construct(ProjectThread $projectThread)
    {
        $this->projectThread = $projectThread;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('thread.' . $this->projectThread->threadable_type . '.' . $this->projectThread->threadable_id)
        ];
    }

    public function broadcastWith()
    {
        return [
            'message' => $this->projectThread->message,
            'user_id' => $this->projectThread->user_id,
            'threadable_type' => $this->projectThread->threadable_type,
            'threadable_id' => $this->projectThread->threadable_id,
            'created_at' => $this->projectThread->created_at->toDateTimeString(),
        ];
    }
}
