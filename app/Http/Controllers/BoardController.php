<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardUser;
use App\Models\User;
use App\Models\Task;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * Class BoardController
 *
 * @package App\Http\Controllers
 */
class BoardController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function boards()
    {
        /** @var User $user */
        $user = Auth::user();

        $boards = Board::with(['user', 'boardUsers']);

        if ($user->role === User::ROLE_USER) {
            $boards = $boards->where(function ($query) use ($user) {
                //Suntem in tabele de boards in continuare
                $query->where('user_id', $user->id)
                    ->orWhereHas('boardUsers', function ($query) use ($user) {
                        //Suntem in tabela de board_users
                        $query->where('user_id', $user->id);
                    });
            });
        }

        $boards = $boards->paginate(10);
        $users = User::all();

        return view(
            'boards.index',
            [
                'boards' => $boards,
                'users' => $users
            ]
        );
    }

    public function updateBoard(Request $request, $id): JsonResponse
    {
        $board = Board::find($id);

        $error = '';
        $success = '';

        if ($board) {

            $board->boardUsers()->delete();

            $board_user_ids = $request->get('board_user_ids');

            if (isset($board_user_ids)) {
                foreach ($board_user_ids as $board_user_id) {
                    BoardUser::query()->create([
                        'user_id' => $board_user_id,
                        'board_id' => $id
                    ]);
                }
            }

            $success = 'Board saved';
        } else {
            $error = 'Board not found!';
        }

        return response()->json(['error' => $error, 'success' => $success, 'board' => $board]);
    }


    /**
     * @param  Request  $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function deleteBoard(Request $request, $id): JsonResponse
    {
        $board = Board::find($id);

        $error = '';
        $success = '';

        if ($board) {
            $board->delete();

            $success = 'User deleted';
        } else {
            $error = 'User not found!';
        }

        return response()->json(['error' => $error, 'success' => $success]);
    }

    /**
     * @param $id
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function board($id)
    {
        /** @var User $user */
        $user = Auth::user();

        $boards = Board::query();

        if ($user->role === User::ROLE_USER) {
            $boards = $boards->where(function ($query) use ($user) {
                $query->where('user_id', $user->id)
                    ->orWhereHas('boardUsers', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    });
            });
        }

        $board = clone $boards;
        $board = $board->where('id', $id)->first();

        $boards = $boards->select('id', 'name')->get();

        if (!$board) {
            return redirect()->route('boards.all');
        }

        $tasks = Task::query()->where('board_id', $id)->paginate(10);

        return view(
            'boards.view',
            [
                'board' => $board,
                'boards' => $boards,
                'tasks' => $tasks
            ]
        );
    }
}
