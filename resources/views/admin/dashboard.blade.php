@extends('layouts.admin')
@section('page-content')
<div class="container bg-slate-100">
    <!--welcome  -->
    <div class="flex items-center">
        <div class="flex-1">
            <div class="bread-crumb">
                <div>Admin</div>
                <div>/</div>
                <div>Dashbaord</div>
            </div>
        </div>
        <div class="text-slate-500">{{ today()->format('d/m/Y') }}</div>
    </div>

    <!-- pallets -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-8">
        <a href="#" class="pallet-box">
            <div class="flex-1">
                <div class="title">Classes</div>
                <div class="flex items-center">
                    <div class="h2">{{ $classes->count() }}</div>
                    <i class="bi-person-circle text-sm ml-4"></i>
                    <p class="text-sm ml-1">{{ $students->count() }}</p>
                </div>
            </div>
            <div class="ico bg-green-100">
                <i class="bi bi-layers text-green-600"></i>
            </div>
        </a>
        <a href="#" class="pallet-box">
            <div class="flex-1">
                <div class="title">Teachers</div>
                <div class="h2">{{ $teachers->count() }}</div>
            </div>
            <div class="ico bg-indigo-100">
                <i class="bi bi-person text-indigo-400"></i>
            </div>
        </a>

        <a href="#" class="pallet-box">
            <div class="flex-1">
                <div class="title">Books</div>
                <div class="h2"> {{ $books->count() }} </div>
            </div>
            <div class="ico bg-sky-100">
                <i class="bi bi-book text-sky-600"></i>
            </div>
        </a>

        <a href="#" class="pallet-box">
            <div class="flex-1 ">
                <div class="title">Applications</div>
                <div class="h2"> {{ $applications->count() }} </div>
            </div>
            <div class="ico bg-teal-100">
                <i class="bi bi-card-checklist text-teal-600"></i>
            </div>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 mt-8 gap-6">
        <!-- middle panel  -->

    </div>
    <!-- middle panel end -->
    <!-- right side bar starts -->
    <div class="">
        <div class="bg-white p-4">
            <p class="text-center">Welcome dear admin!</p>
        </div>
    </div>

</div>
</div>
</div>
@endsection