<?php

namespace App\Http\Controllers\assistant;

use App\Http\Controllers\Controller;
use App\Models\rack;
use Illuminate\Http\Request;

class RackController extends Controller
{

    public function index()
    {
        //

    }
    /**
     * Display a listing of the resource.
     */

    public function show(string $id)
    {
        //
        $rack = Rack::find($id);
        return view('assistant.racks.show', compact('rack'));
    }
}
