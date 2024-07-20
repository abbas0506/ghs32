<?php

namespace App\Http\Controllers\assistant;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Domain;
use App\Models\BookRack;
use App\Models\Language;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $books = Book::all();
        return view('assistant.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $languages = Language::all();
        $domains = Domain::all();
        $book_racks = BookRack::all();
        $books = Book::all();
        return view('assistant.books.create', compact('languages', 'domains', 'book_racks', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publish_year' => 'required',
            'language_id' => 'required',
            'num_of_copies' => 'required',
            'price' => 'required|min:0',
            'domain_id' => 'required',
            'book_rack_id' => 'required',
            'language_id' => 'required',
        ]);
        try {
            $request->merge([
                'assistant_id' => Auth::user()->userable->id,
            ]);
            $book = Book::create($request->all());
            return redirect()->back()->with(
                [
                    'success' => 'Successfully added',
                    'recent_language_id' => $book->language_id,
                    'recent_domain_id' => $book->domain_id,
                    'recent_rack_id' => $book->book_rack_id,
                ]
            );
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
        $book = Book::find($id);
        return view('assistant.books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $book = Book::find($id);
        $languages = Language::all();
        $domains = Domain::all();
        $book_racks = BookRack::all();
        return view('assistant.books.edit', compact('book', 'languages', 'domains', 'book_racks'));
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
            'domain_id' => 'required',
            'book_rack_id' => 'required',
            'language_id' => 'required',
        ]);
        try {
            $book = Book::find($id);
            $book->update($request->all());
            return redirect()->route('library.books.index')->with('success', 'Successfully updated');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
            // something went wrong
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function search()
    {
        return view('assistant.books.search');
    }
    public function postSearch(Request $request)
    {
        $books = Book::where('title', 'like', '%' . $request->searchby . '%')->get();
        return redirect()->route('library.book.search')->with('books', $books);
    }
}
