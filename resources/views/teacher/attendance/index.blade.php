@extends('layouts.teacher')
@section('page-content')
    <div class="custom-container">
        <h1>Classes</h1>
        <div class="bread-crumb">
            <a href="{{ url('/') }}">Dashoboard</a>
            <div>/</div>
            <div>Classes</div>
            <div>/</div>
            <div>All</div>
        </div>

        <!-- page message -->
        @if ($errors->any())
            <x-message :errors='$errors'></x-message>
        @else
            <x-message></x-message>
        @endif

        <div class="grid grid-cols-2 md:grid-cols-4 mt-12 w-full md:w-3/4 mx-auto gap-4 text-center">
            @foreach ($sections->sortBy('grade') as $section)
                <a href="{{ route('teacher.attendance.show', $section) }}"
                    class="p-4 border rounded-md bg-slate-100 hover:bg-slate-200 transition-all ease-in-out duration-500">
                    <h2>Class {{ $section->fullName() }}</h2>
                    <div class="text-slate-500"><i class="bx bx-group"></i> {{ $section->students->count() }}</div>
                </a>
            @endforeach
        </div>
    </div>
@endsection
