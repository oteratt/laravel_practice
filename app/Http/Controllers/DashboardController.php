<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $tasks = Task::where('status', '1')->orwhere('status', 2)->get();
        $loginUserId = Auth::id();

        return view('dashboard', compact('tasks', 'loginUserId'));
    }
}
