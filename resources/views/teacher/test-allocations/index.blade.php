@extends('layouts.teacher')
@section('page-content')

<h1>{{ $test->title }}</h1>
<div class="bread-crumb">
    <a href="{{url('/')}}">Home</a>
    <div>/</div>
    <a href="{{ route('teacher.tests.index')}}">Tests</a>
    <div>/</div>
    <div>Subjects</div>
</div>

@php
$colors=config('globals.colors');
@endphp

<div class="content-section">

    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <div class="grid gap-5 md:w-2/3 mx-auto mt-12">
        <p class="p-3 bg-slate-100">Please click on any of the following subjects to view / feed the result</p>
        <div class="grid md:grid-cols-2 gap-6 ">
            @foreach($testAllocations as $testAllocation)
            <a href="{{ route('teacher.test-allocation.results.index',$testAllocation) }}" class="text-center p-4 rounded-lg bg-{{ $colors[$loop->index%4] }}-100 text-{{ $colors[$loop->index%4] }}-600">
                {{ $testAllocation->allocation->subject->name }} , {{ $testAllocation->allocation->section->roman() }}
            </a>
            @endforeach

        </div>
    </div>
    @endsection