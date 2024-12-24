<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotifyUserAboutProject implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $project;
    public $message;
    public $userId;
    public $userType; // Add userType (manager/assignee)

    /**
     * Create a new event instance.
     */
    public function __construct($project, $message, $userId, $userType)
    {
        $this->project = $project;
        $this->message = $message;
        $this->userId = $userId;
        $this->userType = $userType; // Set user type
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            'projects'
        ];
    }

    /**
     * Define the event name dynamically based on user type.
     */
    public function broadcastAs()
    {
        // Concatenate the user ID with the event name
        if ($this->userType === 'manager') {
            return 'manager.project.notification.' . $this->userId;
        }

        // Default to assignee if not manager
        return 'assignee.project.notification.' . $this->userId; 
    }

    /**
     * Data to broadcast with the event.
     */
    public function broadcastWith()
    {
        return [
            'project' => $this->project,
            'message' => $this->message
        ];
    }
}

