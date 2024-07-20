@extends('layouts.library')
@section('page-content')
<div class="custom-container">
    <h2>Books</h2>
    <div class="bread-crumb">
        <a href="{{url('library')}}">Dashoboard</a>
        <div>/</div>
        <div>Books</div>
        <div>/</div>
        <div>All</div>
    </div>

    <div class="mt-8">
        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <form action="{{route('library.book.search.post')}}" method='post' class="mt-4">
            @csrf
            <div class="flex justify-between  items-center space-x-4">

                <div class="flex-1 relative">
                    <input type="text" name='searchby' class="custom-input" placeholder="Type here">
                    <i class="bi-search absolute right-3 top-4"></i>
                </div>
                <!-- <div class="">
                    <button type="submit" class="btn-teal rounded p-2"><i class="bi-search"></i></button>
                </div> -->
            </div>
        </form>
        <!-- if books search result -->
        @php $sr=1; @endphp
        @if(session('books'))
        <div class="overflow-x-auto w-full mt-4">
            <table class="table-fixed w-full mt-1">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="w-12">Sr</th>
                        <th class="w-40">Book</th>
                        <th class="w-16">Copies</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach(session('books')->sortByDesc('updated_at') as $book)
                    <tr class="tr">

                        <td>{{$sr++}}</td>
                        <td class="text-left">
                            {{$book->title}}
                            <br>
                            <span class="text-xs text-slate-600">{{$book->reference()}} @ {{$book->author}}</span>
                        </td>
                        <td>{{$book->num_of_copies}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection