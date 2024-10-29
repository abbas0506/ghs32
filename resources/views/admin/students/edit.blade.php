@extends('layouts.admin')
@section('body')
<div class="responsive-container">
    <div class="container">
        <h1>{{$section->roman()}} / Edit Student </h1>
        <div class="bread-crumb">
            <a href="{{url('admin')}}">Dashoboard</a>
            <div>/</div>
            <a href="{{route('admin.sections.index')}}">Sections</a>
            <div>/</div>
            <a href="{{route('admin.section.students.index', $section)}}">{{$section->roman()}}</a>
            <div>/</div>
            <div>Students / Edit</div>
        </div>

        <div class="content-section relative">
            <!-- close button -->
            <a href="{{ route('admin.section.students.index', $section) }}" class="absolute top-2 right-2 p-2 hover:bg-slate-200 rounded"><i class="bi-x-lg"></i></a>

            <div class="w-full md:w-3/4 mx-auto mt-8">
                <!-- page message -->
                @if($errors->any())
                <x-message :errors='$errors'></x-message>
                @else
                <x-message></x-message>
                @endif

                <form action="{{route('admin.section.students.update', [$section, $student])}}" method='post' class="mt-4" onsubmit="return validate(event)">
                    @csrf
                    @method('PATCH')
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label>Name *</label>
                            <input type="text" name='name' class="custom-input" placeholder="Type here" value="{{$student->name}}">
                        </div>
                        <div class="">
                            <label>CNIC *</label>
                            <input type="text" name='cnic' class="custom-input" placeholder="Type here" value="{{$student->bform}}">
                        </div>
                        <div class="">
                            <label>Roll No *</label>
                            <input type="text" name='rollno' class="custom-input" placeholder="Type here" value="{{$student->rollno}}">
                        </div>

                        <div class="text-right mt-4 col-span-2">
                            <button type="submit" class="btn-teal rounded p-2">Update Now</button>
                        </div>
                </form>

            </div>
        </div>
    </div>
    @endsection