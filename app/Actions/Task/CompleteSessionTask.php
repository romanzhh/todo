<?php

namespace App\Actions\Task;

use App\Enums\TaskStatus;
use Illuminate\Support\Facades\Session;

class CompleteSessionTask
{
    public static function handle(string $id): bool
    {
        $tasks = Session::get('tasks', []);

        if (array_key_exists($id, $tasks)) {
            $tasks[$id]['status'] = TaskStatus::Completed;

            Session::put('tasks', $tasks);

            return true;
        }

        return false;
    }
}
