<?php

namespace App\Listeners;

class MergeGuestTasks
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $tasks = session('tasks', []);

        foreach ($tasks as $task) {
            $event->user->tasks()->create($task);
        }

        session()->forget('tasks');
    }
}
