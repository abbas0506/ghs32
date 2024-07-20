@extends('layouts.library')
@section('page-content')
<div class="container bg-slate-100">
    <!--welcome  -->
    <div class="flex items-center">
        <div class="flex-1">
            <h2>Welcome {{ Auth::user()->userable->name }}!</h2>
            <div class="bread-crumb">
                <div>eSchool</div>
                <div>/</div>
                <div>Library</div>
                <div>/</div>
                <div>Home</div>
            </div>
        </div>
        <div class="text-slate-500">{{ today()->format('d/m/Y') }}</div>
    </div>

    <!-- pallets -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-8">
        <a href="{{route('library.book.search')}}" class="pallet-box">
            <div class="flex-1 ">
                <div class="title">Search for Book</div>
                <div class="h2">{{$books->count()}}</div>
            </div>
            <div class="ico bg-teal-100">
                <i class="bi bi-search text-teal-600"></i>
            </div>
        </a>
        <a href="{{route('library.book-issuance.issued')}}" class="pallet-box">
            <div class="flex-1 ">
                <div class="title">Issued Books</div>
                <div class="h2">{{$bookIssuances->count()}}</div>
            </div>
            <div class="ico bg-blue-100">
                <i class="bi bi-upc text-blue-600"></i>
            </div>
        </a>
        <a href="{{route('library.book-issuance.delayed')}}" class="pallet-box">
            <div class="flex-1">
                <div class="title">Delayed Books</div>
                <div class="h2">{{$bookIssuances->where('due_date', '<' , today())->count()}}</div>
            </div>
            <div class="ico bg-green-100">
                <i class="bi bi-clock-history text-green-600"></i>
            </div>
        </a>
        <a href="{{route('library.book-issuance.default')}}" class="pallet-box">
            <div class="flex-1">
                <div class="title">Defaulters</div>
                <div class="h2">{{$defaulters->count()}}</div>
            </div>
            <div class="ico bg-orange-100">
                <i class="bi bi-person-slash text-orange-600"></i>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 mt-8 gap-6">
        <!-- middle panel  -->
        <div class="md:col-span-2">
            <!-- update news  -->
            <div class="p-4 bg-white">
                <h2>Today's Activity</h2>
                <div class="overflow-x-auto w-full">
                    @php $sr=1; @endphp
                    <table class="table-auto borderless w-full mt-4 xs">
                        <thead>
                            <tr class="">
                                <th>Sr</th>
                                <th>Book</th>
                                <th>Reader</th>
                                <th>Issued On</th>
                                <th>Due On</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($bookIssuances->where('created_at','>=',today())->sortByDesc('updated_at') as $bookIssuance)
                            <tr class="tr even:bg-transparent border-b">
                                <td>{{$sr++}}</td>
                                <td class="text-left">{{$bookIssuance->book->title}}
                                    <br>
                                    <span class="text-xs text-slate-600">{{$bookIssuance->book->reference()}}-{{$bookIssuance->copy_no}} @ {{$bookIssuance->book->author}}</span>
                                </td>
                                <td class="text-left">
                                    {{$bookIssuance->user->userable->name}}
                                    <br>
                                    <label for="">
                                        @if($bookIssuance->user->userable_type=='App\Models\Student')
                                        {{$bookIssuance->user->userable->clas->roman()}} ({{$bookIssuance->user->userable->rollno}})
                                        @else
                                        {{$bookIssuance->user->userable->designation}}
                                        @endif
                                    </label>
                                </td>
                                <td>{{$bookIssuance->created_at->format('d/m/Y')}}</td>
                                <td>{{$bookIssuance->due_date->format('d/m/Y')}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- middle panel end -->
        <!-- right side bar starts -->
        <div class="">
            <div class="bg-sky-100 p-4">
                <h2>Profile</h2>
                <div class="flex flex-col">
                    <div class="flex text-sm mt-4">
                        <div class="w-8"><i class="bi-person"></i></div>
                        <div>{{ Auth::user()->userable->name }}</div>
                    </div>
                    <div class="flex text-sm mt-2">
                        <div class="w-8"><i class="bi-at"></i></div>
                        <div>...</div>
                    </div>
                    <div class="flex text-sm mt-2">
                        <div class="w-8"><i class="bi-phone"></i></div>
                        <div>...</div>
                    </div>
                    <div class="divider border-blue-200 mt-4"></div>
                    <div class="flex text-sm mt-4">
                        <div class="w-8"><i class="bi-key"></i></div>
                        <a href="" class="link">Change Password</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection