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
    <form action="{{route('admin.tests.update',$test)}}" method='post' class="w-full grid gap-6" onsubmit="return validate(event)">
        @csrf
        @method('patch')
        <div>
            <label>Test Title</label>
            <input type="text" name='title' class="custom-input" placeholder="test title" value="{{ $test->title }}" required>
        </div>
        <div>
            <label>Status</label>
            <select name="is_open" class="custom-input-borderless">
                <option value="1" @selected($test->is_open)>Open</option>
                <option value="0" @selected(!$test->is_open)>Closed</option>
            </select>
        </div>

        <button type="submmit" class="btn-teal rounded p-2 w-32 mt-3">Create Now</button>
    </form>

</div>
</div>
@endsection