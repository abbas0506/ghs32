<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;

use App\Models\BookDomain;
use Exception;
use Illuminate\Http\Request;

class BookDomainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bookDomains = BookDomain::all();
        return view('librarian.book-domains.index', compact('bookDomains'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('librarian.book-domains.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);
        try {
            BookDomain::create($request->all());
            return redirect()->route('librarian.book-domains.index')->with('success', 'Successfully updated');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BookDomain $bookDomain)
    {
        //
        return view('librarian.book-domains.show', compact('bookDomain'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookDomain $bookDomain)
    {
        //
        return view('librarian.book-domains.edit', compact('bookDomain'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookDomain $bookDomain)
    {
        //
        $request->validate([
            'name' => 'required',
        ]);
        try {
            $bookDomain->update($request->all());
            return redirect()->route('librarian.book-domains.index')->with('success', 'Successfully updated');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookDomain $bookDomain)
    {
        //
        try {
            $bookDomain->delete();
            return redirect()->back()->with('success', 'Successfully deleted!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
