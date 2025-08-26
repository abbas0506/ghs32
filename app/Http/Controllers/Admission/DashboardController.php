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
        $today = \Carbon\Carbon::today();
        $applications = Application::orderBy('id', 'desc')->get();
        $recentApplications = $applications->where('created_at', $today);

        $stats = [
            'applications_today' => Application::where('created_at', $today)->count(),
            'applications_admitted' => Application::where('status', 'admitted')->count(),

            'pending_total'   => Application::where('status', 'pending')->count(),
            'pending_today'   => Application::where('status', 'pending')->whereDate('created_at', $today)->count(),

            'accepted_total'  => Application::where('status', 'accepted')->count(),
            'accepted_today'  => Application::where('status', 'accepted')->whereDate('created_at', $today)->count(),

            'rejected_total'  => Application::where('status', 'rejected')->count(),
            'rejected_today'  => Application::where('status', 'rejected')->whereDate('created_at', $today)->count(),

            'admitted_total'  => Application::where('status', 'admitted')->count(),
            'admitted_today'  => Application::where('status', 'admitted')->whereDate('created_at', $today)->count(),

            'amount_paid_total'  => Application::sum('amount_paid'),
            'amount_paid_today'  => Application::whereDate('payment_date', $today)->sum('amount_paid'),

            'pre_engg_total'  => Application::where('group_id', 1)->count(),
            'pre_engg_today'  => Application::where('group_id', 1)->whereDate('created_at', $today)->count(),
            'pre_engg_admitted'  => Application::where('group_id', 1)->where('status', 'admitted')->count(),

            'ics_total'  => Application::where('group_id', 2)->count(),
            'ics_today'  => Application::where('group_id', 2)->whereDate('created_at', $today)->count(),
            'ics_admitted'  => Application::where('group_id', 2)->where('status', 'admitted')->count(),

            'arts_total'  => Application::where('group_id', 3)->count(),
            'arts_today'  => Application::where('group_id', 3)->whereDate('created_at', $today)->count(),
            'arts_admitted'  => Application::where('group_id', 3)->where('status', 'admitted')->count(),


            '1000+_total'  => Application::where('obtained_marks', '>=', 1000)->count(),
            '1000+_today'  => Application::where('obtained_marks', '>=', 1000)->whereDate('created_at', $today)->count(),
            '1000+_admitted'  => Application::where('obtained_marks', '>=', 1000)->where('status', 'admitted')->count(),

            'other_board_total'  => Application::where('bise', '<>', 'sahiwal')->count(),
            'other_board_today'  => Application::where('bise', '<>', 'sahiwal')->whereDate('created_at', $today)->count(),
            'other_board_admitted'  => Application::where('bise', '<>', 'sahiwal')->where('status', 'admitted')->count(),

        ];



        $groups = Group::all();

        return view('admission.dashboard', compact('applications', 'groups', 'stats', 'recentApplications'));
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
