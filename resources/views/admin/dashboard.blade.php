@extends('layouts.admin')
@section('page-content')
<!--welcome  -->
<div class="flex items-center">
    <div class="bread-crumb">
        <div>Admin</div>
        <div>/</div>
        <div><i class="bi-house"></i></div>
    </div>
</div>

<!-- pallets -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 mt-8">
    <a href="{{ route('admin.sections.index') }}" class="pallet-box">
        <div class="flex-1">
            <div class="title">Classes</div>
            <div class="flex items-center">
                <div class="h2">{{ $sections->count() }}</div>
                <i class="bi-person text-sm ml-4"></i>
                <p class="text-sm ml-1">{{ $students->count() }}</p>
            </div>
        </div>
        <div class="ico bg-green-100">
            <i class="bi bi-layers text-green-600"></i>
        </div>
    </a>
    <a href="{{ route('admin.tests.index') }}" class="pallet-box">
        <div class="flex-1">
            <div class="title">Tests
                @if($tests->where('is_open',1)->count())
                <sup><i class="bi-circle-fill text-green-500 text-xxs"></i></sup>
                @endif
            </div>
            <div class="h2">{{ $tests->count() }}</div>
        </div>
        <div class="ico bg-indigo-100">
            <i class="bi bi-clipboard-check text-indigo-400"></i>
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

@endsection