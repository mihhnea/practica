<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\User;
use Illuminate\Http\Request;

/**
 * Class AdminController
 *
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    public function users()
    {
        $users = User::paginate(10);

        return view(
            'users.index',
            [
                'users' => $users
            ]
        );
    }

    public function editUsers($id)
    {
        $user = User::find($id);

        if (!$user) {
            return 'user_not_found';
        }

        return view('edit-post', compact('user'));
    }

    public function updateUsers($id, Request $request)
    {

        $user = User::find($id);

        if (!$user) {
            return 'user_not_found';
        }

        $user->update([
            'role' => $request->role_id
        ]);

        return $user->with('message', 'The role has been changed!');
    }

    public function deleteUsers($id)
    {
        $user = User::find($id);

        if (!$user) {
            return 'user_not_found';
        }

        $user->delete();

        return back()->with('message', 'User has been removed successfully!');
    }

    public function boards()
    {
        $boards = Board::paginate(10);

        return view(
            'boards.index',
            [
                'boards' => $boards
            ]
        );
    }
}
