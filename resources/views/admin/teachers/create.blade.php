@extends('layouts.admin')
@section('page-content')
<div class="custom-container">
    <h2>Teachers / New</h2>
    <div class="bread-crumb">
        <a href="{{url('library')}}">Dashoboard</a>
        <div>/</div>
        <a href="{{route('admin.teachers.index')}}">Teachers</a>
        <div>/</div>
        <div>New</div>
    </div>
    <div class="content-section relative">
        <a href="{{ route('admin.teachers.index') }}" class="absolute top-2 right-2 p-2 hover:bg-slate-200 rounded"><i class="bi-x-lg"></i></a>
        <div class="w-full md:w-3/4 mx-auto mt-8">
            <!-- page message -->
            @if($errors->any())
            <x-message :errors='$errors'></x-message>
            @else
            <x-message></x-message>
            @endif

            <form action="{{route('admin.teachers.store')}}" method='post' class="mt-4" onsubmit="return validate(event)">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="md:col-span-2">
                        <label>Teacher Name *</label>
                        <input type="text" name='name' class="custom-input" placeholder="Type here" value="">
                    </div>
                    <div class="">
                        <label>Designation *</label>
                        <input type="text" name='designation' class="custom-input" placeholder="Type here" value="">
                    </div>
                    <div class="">
                        <label>BPS *</label>
                        <input type="number" name='bps' class="custom-input" placeholder="Type here" value="16">
                    </div>
                    <div class="">
                        <label>CNIC *</label>
                        <input type="text" name='cnic' class="custom-input" placeholder="Type here" value="">
                    </div>
                    <div class="">
                        <label>Phone *</label>
                        <input type="text" name='phone' class="custom-input" placeholder="Type here" value="">
                    </div>
                    <div class="">
                        <label>Email *</label>
                        <input type="text" name='email' class="custom-input" placeholder="Type here" value="">
                    </div>
                    <div class="">
                        <label>Qualification</label>
                        <input type="text" name='qualification' class="custom-input" placeholder="Type here" value="">
                    </div>

                    <div class="text-right mt-4 col-span-2">
                        <button type="submit" class="btn-teal rounded p-2">Create Now</button>
                    </div>
            </form>

        </div>
    </div>

</div>
@endsection