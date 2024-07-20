@extends('layouts.library')
@section('page-content')
<div class="custom-container">
    <div class="flex flex-col md:flex-row items-center">
        <div class="flex-1">
            <h2>{{$book->title}}</h2>
            <p>{{$book->author}}</p>
        </div>
        <div class="flex-1 space-x-4 text-center text-sm">
            <a href="{{route('library.books.edit', $book)}}" class="text-green-600">Edit <i class="bx bx-pencil"></i></a>
            <a href="{{route('library.books.index')}}" class="text-blue-600">Cancel</a>

        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 mt-8">

        <div class="col-span-2 border p-4">
            <div class="grid grid-cols-2 gap-x-4 gap-y-1">
                <!-- <div></div> -->
                <label for="">Pubish year</label>
                <div>{{$book->publish_year}}</div>
                <label>Copies</label>
                <div>{{$book->num_of_copies}}</div>
                <label>Price</label>
                <div>{{$book->price}}</div>
                <label>Language</label>
                <div>{{$book->language->name}}</div>
                <label>Domain</label>
                <div>{{$book->domain->name}}</div>
                <label>Book Rack</label>
                <div>{{$book->rack->label}}</div>
            </div>
        </div>
        <div class="flex justify-center items-center border bg-slate-100 p-4">
            {!! DNS2D::getBarcodeHTML($book->reference(), 'QRCODE',4,4) !!}
        </div>
    </div>



</div>
@endsection