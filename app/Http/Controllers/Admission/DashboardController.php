<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Models\Application;
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
        //$recentpayers =application::where('paidAt', now()->format('Y-m-d'))->get('id', 'group_id');
        $recentpayments = Application::select('group_id', 'fee_paid', 'concession')
            ->join('groups', 'groups.id', 'group_id')
            ->where('paid_at', now()->format('Y-m-d'))
            ->get();


        return view('admission.dashboard', compact('applications', 'recentpayments'));
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
