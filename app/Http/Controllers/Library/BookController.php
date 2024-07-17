<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookDomain;
use App\Models\BookRack;
use App\Models\Language;
use Exception;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $filtered = false;
        if (session('books')) {
            $books = session('books');
            $filtered = true;
        } else
            $books = Book::all();

        $bookDomains = BookDomain::all();
        return view('librarian.books.index', compact('books', 'bookDomains', 'filtered'));
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
        $book = Book::find($id);
        return view('librarian.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $book = Book::find($id);
        $languages = Language::all();
        $book_domains = BookDomain::all();
        $book_racks = BookRack::all();
        return view('librarian.books.edit', compact('book', 'languages', 'book_domains', 'book_racks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publish_year' => 'required',
            'language_id' => 'required',
            'num_of_copies' => 'required',
            'price' => 'required|min:0',
            'book_domain_id' => 'required',
            'book_rack_id' => 'required',
            'language_id' => 'required',
        ]);
        try {
            $book = Book::find($id);
            $book->update($request->all());
            return redirect()->back()->with('success', 'Successfully updated');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
        try {
            $book->delete();
            return redirect()->back()->with('success', 'Successfully deleted!');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function search(Request $request)
    {
        $books = Book::where('title', 'like', '%' . $request->searchby . '%')->get();
        return redirect()->route('librarian.books.index')->with('books', $books);
    }
}
