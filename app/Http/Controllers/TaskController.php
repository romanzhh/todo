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
use App\DTO\TaskDTO;
use App\Enums\TaskStatus;
use App\Http\Requests\Task\StoreTaskRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->has('status') ? TaskStatus::from($request->input('status')) : null;

        $tasks = $request->user() ?
            GetUserTasks::handle($request->user(), $status) :
            GetSessionTasks::handle($status);

        return Inertia::render('Index', [
            'tasks' => $tasks,
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

    public function destroy(Request $request, string|int $id): RedirectResponse
    {
        if ($user = $request->user()) {
            DeleteUserTask::handle($user, $id);
        } else {
            DeleteSessionTask::handle($id);
        }

        return back();
    }

    public function complete(Request $request, string $id): RedirectResponse
    {
        if ($user = $request->user()) {
            CompleteUserTask::handle($user, $id);
        } else {
            CompleteSessionTask::handle($id);
        }

        return back();
    }
}
