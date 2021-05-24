<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Board;
use App\Models\Task;
use App\Models\User;

/**
 * Class DashboardController
 *
 * @package App\Http\Controllers
 */
class DashboardController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $boards = Board::get();
        $tasks = Task::get();

        return view(
            'dashboard.index',
            [
                'boards' => $boards,
                'tasks' => $tasks
            ]
        );
    }
}
