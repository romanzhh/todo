<?php

namespace App\Actions\Task;

use App\Enums\TaskStatus;
use Illuminate\Support\Facades\Session;

class UpdateSessionTaskStatus
{
    public static function handle(string $id, TaskStatus $status): bool
    {
        $tasks = Session::get('tasks', []);

        if (array_key_exists($id, $tasks)) {
            $tasks[$id]['status'] = $status->value;

            Session::put('tasks', $tasks);

            return true;
        }

        return false;
    }
}
