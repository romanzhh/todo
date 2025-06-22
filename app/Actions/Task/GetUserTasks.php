<?php

namespace App\Actions\Task;

use App\Enums\TaskStatus;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class GetUserTasks
{
    public static function handle(User $user, ?TaskStatus $status): Collection
    {
        $query = $user->tasks();

        if ($status) {
            $query->where('status', $status);
        }

        return $query->get();
    }
}
