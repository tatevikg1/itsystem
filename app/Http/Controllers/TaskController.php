<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function index()
    {
        $tasks =  Task::all();
        dd($tasks);

        return Inertia::render('Profile/Index', [
            'user'  => Auth::user('id', 'name', 'email'),
        ]);
    }

    public function store(Request $request)
    {
        Task::create([
            'description' => $request['description'],
            'for_user' => $request['for_user'],
            'created_by' => auth()->user()->id
        ]);

        return Redirect::route('dashboard');
    }
}
