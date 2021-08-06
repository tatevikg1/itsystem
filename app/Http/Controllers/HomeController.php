<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;


class HomeController extends Controller
{
    public function index()
    {
        /** @var App/Model/User $user */ 
        $user = Auth::user();

        $users =  User::where('id', '!=', auth()->id())->select('id', 'name', 'email')->get(5);
        $tasks = $user->tasks()->where(['status' => 'pending'])->get();
        $inProgress = $user->cTasks()->where('status', '!=', 'pending')->get();

        return Inertia::render('Dashboard', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'user'  => $user,
            'users' => $users,
            'tasks' => $tasks,
            'progress' => $inProgress
        ]);
    }

}
