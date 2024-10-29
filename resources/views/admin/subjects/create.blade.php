@extends('layouts.admin')
@section('body')
<div class="responsive-container">
    <div class="container">
        <h2>New Subjects</h2>
        <div class="bread-crumb">
            <a href="/">Home</a>
            <div>/</div>
            <a href="{{route('admin.subjects.index')}}">subjects</a>
            <div>/</div>
            <div>New</div>
        </div>

        <div class="md:w-3/4 mx-auto mt-12 bg-white md:p-8 rounded">
            <!-- page message -->
            @if($errors->any())
            <x-message :errors='$errors'></x-message>
            @else
            <x-message></x-message>
            @endif
            <form action="{{route('admin.subjects.store')}}" method='post' class="w-full grid gap-6" onsubmit="return validate(event)">
                @csrf
                <div>
                    <label>Full Name</label>
                    <input type="text" name='name' class="custom-input" placeholder="Subject name" value="">
                </div>

                <button type="submmit" class="btn-teal rounded p-2 w-32 mt-3">Create Now</button>
            </form>

        </div>
    </div>
    @endsection