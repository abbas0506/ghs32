<?php

namespace App\Http\Controllers\Admission;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $applications = Application::all();
        return view('admission.cards.index', compact('applications'));
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
        $request->validate([
            'application_ids_array' => 'required',
        ]);


        try {
            $applicationIdsArray = array();
            $applicationIdsArray = $request->application_ids_array;
            $applications = Application::whereIn('id', $applicationIdsArray)->get();
            session([
                'applications' => $applications,
            ]);
            return redirect()->route('admission.cards.print');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
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
    public function print()
    {
        if (session('applications')) {
            $applications = session('applications');

            $pdf = PDF::loadview('admission.cards.print', compact('applications'))->setPaper('a4', 'portrait');
            $pdf->set_option("isPhpEnabled", true);
            $file = "cards.pdf";
            return $pdf->stream($file);
        } else {
            echo "Nothing to print";
        }
    }
}
