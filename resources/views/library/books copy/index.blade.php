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
        <div class="flex items-center flex-wrap justify-between mt-8">
            <!-- search -->
            <div class="flex relative w-full md:w-1/3">
                <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full" oninput="search(event)">
                <i class="bx bx-search absolute top-2 right-2"></i>
            </div>

            <!-- <a href="" class="btn-teal rounded">Create New</a> -->
        </div>
        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <div class="text-gray-400 mt-8">({{Auth::user()->userable->books()->createdToday()->count()}}/{{$books->count()}}) created today</div>

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
                        <th class="w-20">Action</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach(Auth::user()->userable->books()->createdToday()->get()->sortByDesc('updated_at') as $book)
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
                        <td>
                            <a href="{{route('library.books.edit',$book)}}">
                                <i class="bx bx-pencil text-green-600"></i>
                            </a>
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
        var searchtext = event.target.value.toLowerCase();
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
</script>

@endsection