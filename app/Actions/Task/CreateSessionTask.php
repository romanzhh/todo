<?php

namespace App\Actions\Task;

use App\DTO\TaskDTO;
use Illuminate\Support\Facades\Session;

class CreateSessionTask
{
    public static function handle(TaskDTO $taskDTO): true
    {
        $tasks = Session::get('tasks', []);

        $id = uniqid();

        $tasks[$id] = [
            'id' => $id,
            ...$taskDTO->toArray(),
        ];

        Session::put('tasks', $tasks);

        return true;
    }
}
