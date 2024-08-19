<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Group;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $applications = Application::orderBy('id', 'desc')->get();
        $numOfApplicationsToday = Application::whereDate('created_at', today())->count();
        $sumOfFeeToday = Application::whereDate('paid_at', today())->sum('fee_paid');
        $numOfObjectionsToday = Application::whereNotNull('objection')->count();
        $numOfHighAchieversToday = Application::where('obtained', '>=', 1000)->whereDate('created_at', today())->count();

        $groups = Group::all();

        return view('admission.dashboard', compact('applications', 'groups', 'numOfApplicationsToday', 'sumOfFeeToday', 'numOfObjectionsToday', 'numOfHighAchieversToday'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
