<?php

namespace App\Actions\Task;

use App\DTO\TaskDTO;
use Illuminate\Support\Facades\Session;

class UpdateSessionTask
{
    public static function handle(string $id, TaskDTO $taskDTO): bool
    {
        $tasks = Session::get('tasks', []);

        if (array_key_exists($id, $tasks)) {
            $tasks[$id] = ['id' => $id, ...$taskDTO->toArray()];

            Session::put('tasks', $tasks);

            return true;
        }

        return false;
    }
}
