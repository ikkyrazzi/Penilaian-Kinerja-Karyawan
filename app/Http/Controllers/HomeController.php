<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'hrd') {
            return redirect()->route('hrd.dashboard');
        } elseif ($user->role === 'manager') {
            return redirect()->route('manager.dashboard');
        }

        // Default behavior if the user's role is neither HRD nor Manager
        return view('home');
    }
}
