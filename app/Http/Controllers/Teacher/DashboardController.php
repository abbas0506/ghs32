<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        //
        $allocations = Auth::user()->allocations;
        $tests = Test::all();

        return view('teacher.dashboard', compact('allocations', 'tests'));
    }

    /**
     * Show the form for creating a new resource.
     */
}
