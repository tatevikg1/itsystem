<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $users =  User::where('id', '!=', auth()->id())->select('id', 'name', 'email')->get(5);

        return Inertia::render('Dashboard', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'user'  => Auth::user('id', 'name', 'email'),
            'users' => $users
        ]);
    }

    // public function store()
    // {
    //     return Inertia::render('Task/Create', [
    //         'user'  => Auth::user('id', 'name', 'email'),
    //         'users' => User::where('id', '!=', auth()->id())
    //             ->select('id', 'name', 'email')
    //             ->paginate(3)
    //     ]);
    // }
}
