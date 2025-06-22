<?php

namespace App\Actions\Task;

use App\DTO\TaskDTO;
use App\Models\Task;
use App\Models\User;

class CreateUserTask
{
    public static function handle(User $user, TaskDTO $taskDTO): Task
    {
        return $user->tasks()->create($taskDTO->toArray());
    }
}
