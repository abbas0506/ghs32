<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookRack;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Str;

class BookRackController extends Controller
{

    public function index()
    {
        //
        // $bookRacks = BookRack::has('books')->get();
        $bookRacks = BookRack::all();
        $books = Book::all();
        return view('library.book-racks.index', compact('bookRacks', 'books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('library.book-racks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'label' => 'required',
        ]);
        try {
            BookRack::create($request->all());
            return redirect()->route('library.book-racks.index')->with('success', 'Successfully updated');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(BookRack $BookRack)
    {
        //
        $bookRack = $BookRack;
        return view('library.book-racks.show', compact('bookRack'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $bookRack = BookRack::find($id);
        return view('library.book-racks.edit', compact('bookRack'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookRack $BookRack)
    {
        //
        $request->validate([
            'label' => 'required',
        ]);
        try {
            $BookRack->update($request->all());
            return redirect()->route('library.book-racks.index')->with('success', 'Successfully updated');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookRack $BookRack)
    {
        //
        try {
            $BookRack->delete();
            return redirect()->back()->with('success', 'Successfully deleted!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function print($id)
    {
        $bookRack = BookRack::find($id);

        $pdf = PDF::loadview('library.book-racks.preview', compact('bookRack'))->setPaper('a4', 'portrait');
        $pdf->set_option("isPhpEnabled", true);
        $file = Str::lower($bookRack->title) . "-list of books.pdf";
        return $pdf->stream($file);
    }
}
