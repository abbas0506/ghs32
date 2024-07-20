@extends('layouts.admin')
@section('page-content')
<div class="custom-container">
    <h2>New Class</h2>
    <div class="bread-crumb">
        <a href="{{url('admin')}}">Dashoboard</a>
        <div>/</div>
        <a href="{{route('admin.classes.index')}}">Classes</a>
        <div>/</div>
        <div>New</div>
    </div>

    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <div class="w-full md:w-3/4 mx-auto mt-8">
        <h1 class="text-teal-600 mt-8">New Clas</h1>
        <form action="{{route('admin.classes.store')}}" method='post' class="mt-4" onsubmit="return validate(event)">
            @csrf
            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label>Class Grade</label>
                    <select name="grade_id" id="" class="custom-input p-2">
                        @forelse($grades as $grade)
                        <option value="{{$grade->id}}">{{ $grade->roman_name }}</option>
                        @empty
                        <option value="">No group available</option>
                        @endforelse
                    </select>
                </div>
                <div>
                    <label>Section Label </label>
                    <input type="text" name='section_label' class="custom-input" placeholder="e.g A" value="">
                </div>

                <div>
                    <label>Induction Year</label>
                    <input type="number" name='induction_year' class="custom-input" placeholder="Type here" value="{{date('Y')}}" min="2018" max="{{date('Y')}}">
                </div>
                <div>
                    <label>Incharge</label>
                    <select name="incharge_id" id="" class="custom-input p-2">
                        @forelse($teachers as $teacher)
                        <option value="{{$teacher->id}}">{{ $teacher->name }}</option>
                        @empty
                        <option value="">No teacher available</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="flex mt-4">
                <button type="submit" class="btn-teal rounded p-2">Create Now</button>
            </div>
        </form>

    </div>
</div>
@endsection