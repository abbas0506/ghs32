@extends('layouts.admin')
@section('page-content')
<h2>Edit Test</h2>
<div class="bread-crumb">
    <a href="/">Home</a>
    <div>/</div>
    <a href="{{route('admin.tests.index')}}">Tests</a>
    <div>/</div>
    <div>Edit</div>
</div>

<div class="md:w-3/4 mx-auto mt-12 bg-white md:p-8 rounded">
    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <label for="">{{ $test->title }}</label>
    <div class="border rounded-md mt-3 p-3 text-sm bg-gradient-to-r from-blue-100 to-blue-50 border-blue-200">
        <h3 class="font-bold">{{ $testAllocation->allocation->section->roman()}} Lecture # {{ $testAllocation->allocation->lecture_no }}</h3>
        <p>{{ $testAllocation->allocation->subject->name}} <span class="text-slate-400">by {{ $testAllocation->allocation->teacher->profile->name }}</span></p>
    </div>

    <form action="{{route('admin.test.allocations.update',[$test, $testAllocation])}}" method='post' class="w-full grid gap-6 mt-6">
        @csrf
        @method('patch')

        <div>
            <label>Total Marks</label>
            <input type="number" name='total_marks' class="custom-input" placeholder="Total marks" value="{{ $testAllocation->total_marks }}" required>
        </div>
        @if($testAllocation->result_date)
        <div>
            <div class="flex items-center">Status <i class="bi-lock-fill text-red-600"></i></div>
            <input type="checkbox" id='unlock' name="unlock" value="1" class="rounded">
            <label for="unlock">Unlock now</label>
        </div>
        @endif

        <button type="submit" class="btn-teal rounded p-2 w-32 mt-3">Update Now</button>
    </form>
</div>
@endsection