@extends('layouts.admin')
@section('body')
<div class="responsive-container">
    <div class="container">
        <h2>New Class</h2>
        <div class="bread-crumb">
            <a href="{{url('admin')}}">Dashoboard</a>
            <div>/</div>
            <a href="{{route('admin.sections.index')}}">Sections</a>
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
            <div>
                <label>Grade</label>
                <h2>{{ $grade->grade_no }}</h2>
            </div>
            <form action="{{route('admin.grade.sections.store',$grade)}}" method='post' class="mt-4" onsubmit="return validate(event)">
                @csrf
                <div class="grid grid-cols-2 gap-2">

                    <div>
                        <label>Section Label </label>
                        <input type="text" name='name' class="custom-input-borderless" placeholder="e.g A" value="">
                    </div>
                    <div>
                        <label>Starts at : mm-dd-yyyy</label>
                        <input type="date" name='starts_at' class="custom-input-borderless" value="{{ now()->format('Y-m-d') }}">
                    </div>
                    <div class="col-span-full">
                        <label>Incharge</label>
                        <select name="incharge_id" id="" class="custom-input-borderless">
                            @forelse($users as $user)
                            <option value="{{$user->id}}">{{ $user->profile->name }}</option>
                            @empty
                            <option value="">No teacher available</option>
                            @endforelse
                        </select>
                    </div>


                    <!-- <div>
                        <label>Ends at : mm-dd-yyyy </label>
                        <input type="date" name='ends_at' class="custom-input-borderless" value="2024-03-31">
                    </div> -->
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit" class="btn-teal rounded p-2">Create Now</button>
                </div>
            </form>

        </div>
    </div>
    @endsection