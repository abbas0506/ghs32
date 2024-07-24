@extends('layouts.admission')

@section('header')
<x-headers.admission></x-headers.admission>
@endsection

@section('page-content')
<div class="container bg-slate-100">
    <!-- Title     -->
    <h1>Applications / New</h1>
    <div class="flex flex-wrap items-center gap-2">
        <div class="flex-1">
            <div class="bread-crumb">
                <a href="{{ url('/') }}">Dashboard</a>
                <div>/</div>
                <a href="{{ route('admission.applications.index') }}">Applications</a>
                <div>/</div>
                <div>New</div>
            </div>
        </div>
    </div>
    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <form action="{{route('applications.store')}}" method="post" class="mt-8">
        @csrf
        <h2>Choose your desired group</h2>
        <div class="grid gap-y-2 mt-3">
            @foreach($groups as $group)
            <div>
                <input type="checkbox" id='group_id' name="group_id" value="{{ $group->id }}" class="rounded mr-2">
                <label for="group_id">{{ $group->name }} ({{ $group->subjects_list }})</label>
            </div>
            @endforeach
        </div>
        <div class="mt-8 md:w-1/2">
            <label for="">Passing Year</label>
            <select name="pass_year" id="" class="custom-input">
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024" selected>2024</option>
            </select>
        </div>
        <!-- student info -->
        <div class="grid md:grid-cols-2 gap-4 mt-8">
            <div class="md:col-span-2">
                <label for="">Your Name (as per matric result)</label>
                <input type="text" name="name" class="custom-input" placeholder="Your name">
            </div>
            <div class="md:col-span-2">
                <label for="">Father name</label>
                <input type="text" name="father" class="custom-input" placeholder="Father name">
            </div>
            <div>
                <label for="">BForm</label>
                <input type="text" name="bform" class="custom-input" placeholder="B Form">
            </div>
            <div>
                <label for="">Phone No</label>
                <input type="text" name="phone" class="custom-input" placeholder="Phone No.">
            </div>
            <div>
                <label for="">Board Name</label>
                <select name="bise_name" id="" class="custom-input">
                    <option value="sahiwal">Sahiwal Board</option>
                    <option value="other">Other Board</option>
                </select>
            </div>
            <div>
                <label for="">Matric Roll No.</label>
                <input type="number" name="rollno" class="custom-input" placeholder="Roll number" min='0'>
            </div>
            <div>
                <label for="">Obtanied Marks</label>
                <input type="number" name="obtained" class="custom-input" placeholder="Obtained marks" min='0'>
            </div>
            <div>
                <label for="">Total Marks</label>
                <select name="total" id="" class="custom-input">
                    <option value="1100">1100</option>
                    <option value="1200" selected>1200</option>
                </select>
            </div>

        </div>
        <div class="text-center mt-8">
            <button class="btn-teal rounded py-3">Submit Application</button>

        </div>
    </form>
</div>
@endsection