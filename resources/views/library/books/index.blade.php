@extends('layouts.library')
@section('page-content')
<div class="custom-container">
    <h2>Books</h2>
    <div class="bread-crumb">
        <a href="{{url('librarian')}}">Home</a>
        <div>/</div>
        <div>Books</div>
        <div>/</div>
        <div>All</div>
    </div>

    <div class="mt-8">
        <div class="flex items-center flex-wrap justify-between mt-8">
            <!-- search -->
            <form action="{{route('library.books.search')}}" class="flex items-center w-full md:w-1/3">
                <input type="text" id='searchby' name='searchby' placeholder="Search ..." class="border-b border-slate-200 focus:border-indigo-200 outline-none w-full">
                <button type="submit" class="btn-teal py-2"><i class="bx bx-search hover:cursor-pointer"></i></button>
            </form>
            <div onclick="toggleFilterSection()" class="hover:cursor-pointer"><i class="bi-filter pr-2"></i>Filter</div>
        </div>
        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <div id="filterSection" class="border hidden border-slate-200 p-4 mt-4">
            <div class="grid grid-col-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <div id='all' class="filterOption active" onclick="filter('all')">
                    <span class="desc">All</span>
                    <span class="ml-1 text-sm text-slate-600">
                        ({{$books->count()}})
                    </span>
                </div>
                @foreach($bookDomains as $bookDomain)

                <div id='{{$bookDomain->id}}' class="filterOption" onclick="filter('{{$bookDomain->id}}')">
                    <span class="desc">{{$bookDomain->name}}</span>
                    <span class="ml-1 text-sm text-slate-600">
                    </span>
                </div>
                @endforeach
            </div>
        </div>
        <div class="flex items-center flex-wrap justify-between mt-8">
            <div class="flex space-x-4 items-center">
                <div class="text-gray-400">({{ $books->count() }}) records found</div>
                @if($filtered)
                <a href="{{route('library.books.index')}}" class="link text-xs"><i class="bi-x"></i>Clear Filter</a>
                @endif
            </div>
        </div>
        @php $sr=1; @endphp
        <div class="overflow-x-auto w-full">
            <table class="table-fixed w-full mt-1">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="w-12">Sr</th>
                        <th class="w-40">Title/Author</th>
                        <th class="w-16">Ref.</th>
                        <th class="w-24">Domain</th>
                        <th class="w-24">Published</th>
                        <th class="w-24">Copies</th>
                        <th class="w-24">Crated By</th>
                        <th class="w-20">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($books->sortByDesc('updated_at') as $book)
                    <tr class="tr">

                        <td>{{$sr++}}</td>
                        <td class="text-left">
                            <a href="{{route('library.books.show', $book)}}" class="link">{{$book->title}}</a>
                            <br>
                            <span class="text-xs text-slate-600">{{$book->author}}</span>
                        </td>
                        <td>{{$book->reference()}}</td>
                        <td>{{$book->domain->name}}</td>
                        <td>{{$book->publish_year}}</td>
                        <td>{{$book->num_of_copies}}</td>
                        <td>{{$book->assistant->name ?? ''}}</td>
                        <td>
                            <div class="flex items-center justify-center">
                                <a href="{{route('library.books.edit',$book)}}"><i class="bx bx-pencil text-green-600"></i></a>
                                <span class="text-slate-300 px-2">|</span>
                                <form action="{{route('library.books.destroy',$book)}}" method="post" onsubmit="return confirmDel(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button><i class="bx bx-trash text-red-600"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    function search(event) {
        // var searchtext = event.target.value.toLowerCase();
        var searchtext = $('#searchby').val().toLowerCase();
        var str = 0;
        $('.tr').each(function() {
            if (!(
                    $(this).children().eq(1).prop('outerText').toLowerCase().includes(searchtext)
                )) {
                $(this).addClass('hidden');
            } else {
                $(this).removeClass('hidden');
            }
        });
    }

    function confirmDel(event) {
        event.preventDefault(); // prevent form submit
        var form = event.target; // storing the form

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        })
    }

    function toggleFilterSection() {
        $('#filterSection').slideToggle().delay(500);
    }
</script>
@endsection