<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookDomain;
use App\Models\BookRack;
use Exception;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Str;

class QrCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bookRacks = BookRack::has('books')->get();
        return view('librarian.qrcodes.index', compact('bookRacks'));
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
    public function createRangeQr(Request $request)
    {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
            'book_rack_id' => 'required',
        ]);
        try {
            $books = Book::whereBetween('id', [$request->from, $request->to])->where('book_rack_id', $request->book_rack_id)->get();
            return redirect()->route('librarian.qr.range.preview')->with('books', $books);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
    public function previewRangeQr()
    {

        if (session('books')) {
            $books = session('books');
            $pdf = PDF::loadView('librarian.qrcodes.preview', compact('books'))->setPaper('a4', 'portrait');
            $pdf->set_option("isPhpEnabled", true);

            $file = "QrCode.pdf";
            return $pdf->stream($file);
        } else {
            echo "The given range of book-serial has expired, go back!";
        }
    }
    public function createSpecificQr(Request $request)
    {
        $request->validate([
            'qr' => 'required|min:9',
        ]);
        try {
            $specificQr = $request->qr;
            return redirect()->route('librarian.qr.specific.preview')->with('specificQr', $specificQr);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }
    public function previewSpecificQr()
    {
        if (session('specificQr')) {
            $specificQr = session('specificQr');

            $pdf = PDF::loadView('librarian.qrcodes.specific', compact('specificQr'))->setPaper('a4', 'portrait');
            $pdf->set_option("isPhpEnabled", true);
            $file = Str::lower($specificQr) . "-qr.pdf";
            return $pdf->stream($file);
        } else {
            echo "Specific Qr expired, go back!";
        }
    }



    public function previewBooksQrByRack($id)
    {
        $bookRack = BookRack::find($id);
        $books = $bookRack->books;
        $pdf = PDF::loadView('librarian.qrcodes.preview', compact('books'))->setPaper('a4', 'portrait');
        $pdf->set_option("isPhpEnabled", true);
        $file = Str::lower($bookRack->label) . "-qr.pdf";
        return $pdf->stream($file);
    }
}
