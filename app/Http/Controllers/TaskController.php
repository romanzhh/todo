<?php

namespace App\Http\Controllers;

use App\Actions\Task\CreateUserTask;
use App\Actions\Task\DeleteUserTask;
use App\Actions\Task\CompleteSessionTask;
use App\Actions\Task\CompleteUserTask;
use App\Actions\Task\DeleteSessionTask;
use App\Actions\Task\GetUserTasks;
use App\Actions\Task\GetSessionTasks;
use App\Actions\Task\CreateSessionTask;
use App\Actions\Task\ReopenSessionTask;
use App\Actions\Task\ReopenUserTask;
use App\Actions\Task\UpdateSessionTask;
use App\Actions\Task\UpdateUserTask;
use App\DTO\TaskDTO;
use App\Enums\TaskStatus;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $status = null;

        if ($status = $request->input('status')) {
            $status = TaskStatus::from($status);
        }

        $tasks = $request->user() ?
            GetUserTasks::handle($request->user(), $status) :
            GetSessionTasks::handle($status);

        return Inertia::render('Index', [
            'tasks' => $tasks,
            'status' => $status,
        ]);
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $taskDTO = TaskDTO::from($request->validated());

        if ($user = $request->user()) {
            CreateUserTask::handle($user, $taskDTO);
        } else {
            CreateSessionTask::handle($taskDTO);
        }

        return back();
    }

    public function update(UpdateTaskRequest $request, string|int $id): RedirectResponse
    {
        $taskDTO = TaskDTO::from($request->validated());

        if ($user = $request->user()) {
            UpdateUserTask::handle($user, $id, $taskDTO);
        } else {
            UpdateSessionTask::handle($id, $taskDTO);
        }

        return back();
    }

    public function destroy(Request $request, string|int $id): RedirectResponse
    {
        if ($user = $request->user()) {
            DeleteUserTask::handle($user, $id);
        } else {
            DeleteSessionTask::handle($id);
        }

        return back();
    }

    public function complete(Request $request, string|int $id): RedirectResponse
    {
        if ($user = $request->user()) {
            CompleteUserTask::handle($user, $id);
        } else {
            CompleteSessionTask::handle($id);
        }

        return back();
    }

    public function reopen(Request $request, string|int $id): RedirectResponse
    {
        if ($user = $request->user()) {
            ReopenUserTask::handle($user, $id);
        } else {
            ReopenSessionTask::handle($id);
        }

        return back();
    }
}
