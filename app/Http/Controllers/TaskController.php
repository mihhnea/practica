<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

/**
 * Class BoardController
 *
 * @package App\Http\Controllers
 */
class TaskController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function tasks()
    {
        /** @var User $user */
        $user = Auth::user();

        // $tasks = Task::with(['user', 'boardUsers']);
        $tasks = Task::query();


        // if ($user->role === User::ROLE_USER) {
        //     $tasks = $tasks->where(function ($query) use ($user) {
        //         //Suntem in tabele de boards in continuare
        //         $query->where('board_id', $user->id)
        //             ->orWhereHas('boardUsers', function ($query) use ($user) {
        //                 //Suntem in tabela de board_users
        //                 $query->where('board_id', $user->id);
        //             });
        //     });
        // }

        $tasks = $tasks->paginate(10);

        return view(
            'tasks.index',
            [
                'tasks' => $tasks,
            ]
        );
    }

    public function updateTasks(Request $request, $id): JsonResponse
    {
        $task = Task::find($id);

        $error = '';
        $success = '';

        if ($task) {
            $name = $request->get('name');
            $description = $request->get('description');
            $status = $request->get('status');

            if (in_array($status, [Task::STATUS_CREATED, Task::STATUS_IN_PROGRESS, Task::STATUS_DONE])) {
                $task->status = $status;
                $task->name = $name;
                $task->description = $description;

                $task->save();
                $task->refresh();

                $success = 'Task saved';
            } else {
                $error = 'Task selected is not valid!';
            }
        } else {
            $error = 'Task not found!';
        }

        return response()->json(['error' => $error, 'success' => $success, 'task' => $task]);
    }

    /**
     * @param  Request  $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function deleteTasks(Request $request, $id): JsonResponse
    {
        $task = Task::find($id);

        $error = '';
        $success = '';

        if ($task) {
            $task->delete();

            $success = 'Task deleted';
        } else {
            $error = 'Task not found!';
        }

        return response()->json(['error' => $error, 'success' => $success]);
    }
}
