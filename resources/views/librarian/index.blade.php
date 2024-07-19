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

    <div class="grid grid-cols-1 md:grid-cols-3 mt-8 gap-6">
        <!-- middle panel  -->
        <div class="md:col-span-2">
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
                        <div class="w-8"><i class="bi-envelope-at"></i></div>
                        <div>{{ Auth::user()->userable->email }}</div>
                    </div>
                    <div class="flex text-sm mt-2">
                        <div class="w-8"><i class="bi-phone"></i></div>
                        <div>{{ Auth::user()->userable->phone }}</div>
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