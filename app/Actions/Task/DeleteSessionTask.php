<?php

namespace App\Actions\Task;

use Illuminate\Support\Facades\Session;

class DeleteSessionTask
{
    public static function handle(string $id): true
    {
        $tasks = Session::get('tasks', []);

        $tasks = array_filter(
            $tasks,
            fn($task) => $task['id'] !== $id
        );

        Session::put('tasks', $tasks);

        return true;
    }
}
