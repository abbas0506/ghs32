@extends('layouts.library')
@section('page-content')
<div class="container bg-slate-100">
    <!--welcome  -->
    <div class="flex items-center">
        <div class="flex-1">
            <h2>Welcome !</h2>
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
        <a href="" class="pallet-box">
            <div class="flex-1 ">
                <div class="title">Top Readers</div>
                <div class="h2">%</div>
            </div>
            <div class="ico bg-teal-100">
                <i class="bi bi-person-hearts text-teal-600"></i>
            </div>
        </a>
        <a href="" class="pallet-box">
            <div class="flex-1">
                <div class="title">Defaulters</div>
                <div class="h2"> %</div>
            </div>
            <div class="ico bg-orange-100">
                <i class="bi bi-person-slash text-orange-600"></i>
            </div>
        </a>
        <a href="" class="pallet-box">
            <div class="flex-1">
                <div class="title">Book Reviews</div>
                <div class="h2">?</div>
            </div>
            <div class="ico bg-green-100">
                <i class="bi bi-card-text text-green-600"></i>
            </div>
        </a>
        <a href="" class="pallet-box">
            <div class="flex-1 ">
                <div class="title">Top Rated Books</div>
                <div class="h2">%</div>
            </div>
            <div class="ico bg-teal-100">
                <i class="bi bi-bookmark-star text-teal-600"></i>
            </div>
        </a>
    </div>

    <div class="grid mt-8 gap-6">
        <!-- update news  -->
        <div class="p-4 bg-red-50">
            <h2>Today's Activity <span class="font-normal text-sm">({{$books->where('created_at','>=',today())->count()}} / {{$books->count()}})</span></h2>
            <div class="grid grid-cols-2 md:grid-cols-4 mt-3">
                @foreach($assistants as $assistant)
                <div class="text-center">
                    <label for="">{{$assistant->name}}</label>
                    <p>{{$assistant->books()->createdToday()->count()}}</p>
                </div>
                @endforeach

            </div>
        </div>

    </div>

</div>
</div>
@endsection