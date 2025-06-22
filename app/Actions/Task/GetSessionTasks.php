<?php

namespace App\Actions\Task;

use App\Enums\TaskStatus;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

class GetSessionTasks
{
    public static function handle(?TaskStatus $status): Collection
    {
        $tasks = new Collection(Session::get('tasks', []));

        if ($status) {
            $tasks = $tasks->where('status', $status->value);
        }

        return $tasks;
    }
}
