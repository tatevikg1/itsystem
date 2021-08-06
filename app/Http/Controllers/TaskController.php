<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{

    public function store(Request $request)
    {
        Task::create([
            'description' => $request['description'],
            'for_user' => $request['for_user'],
            'created_by' => auth()->user()->id
        ]);

        return Redirect::route('dashboard');
    }

    public function update(Request $request)
    {
        $task = Task::find($request['id']);

        $task->update([ 'status' => $request['status'] ]);
        $task->save();

        return Redirect::route('dashboard');
    }

}
