@extends('layouts.admin')
@section('page-content')
<h2>New Allocation</h2>
<div class="bread-crumb">
    <a href="/">Home</a>
    <div>/</div>
    <a href="{{route('admin.section.lecture.allocations.index',[0,0])}}">Allocations</a>
    <div>/</div>
    <div>New</div>
</div>

<div class="md:w-3/4 mx-auto mt-6 bg-white md:p-8 rounded">
    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <form action="{{route('admin.section.lecture.allocations.store',[$section, $lecture_no])}}" method='post' class="w-full grid gap-6" onsubmit="return validate(event)">
        @csrf
        <input type="hidden" name="session_id" value="1">
        <div>
            <h2>Section: {{ $section->roman() }}</h2>
            <h2>Lecture: {{ $lecture_no }}</h2>
            <div class="divider my-2"></div>
        </div>
        <div>
            <label>Subject</label>
            <select name="subject_id" id="" class="custom-input-borderless">
                @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Teacher</label>
            <select name="teacher_id" id="" class="custom-input-borderless">
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->profile->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submmit" class="btn-teal rounded p-2 w-32 mt-3">Create Now</button>

        </div>
    </form>

</div>
@endsection