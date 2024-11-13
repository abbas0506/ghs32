@extends('layouts.admin')

@section('page-content')
<style>
    .incharge:hover i {
        color: black;
        transition: all 0.5s ease-in-out;
    }
</style>
<h2>Edit Inchargeship</h2>
<div class="bread-crumb">
    <a href="/">Home</a>
    <div>/</div>
    <a href="{{route('admin.section.lecture.allocations.index',[0,0])}}">Allocations</a>
    <div>/</div>
    <div>Edit</div>
</div>

<div class="md:w-3/4 mx-auto mt-6 bg-white md:p-8 rounded">
    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <h2>Section: {{ $section->roman() }}</h2>
    <h2>Current Incharge: {{ $section->incharge?->profile?->name }}</h2>

    <div class="divider my-2"></div>
    <form action="{{ route('admin.incharges.update', $section) }}" method='post'>
        @csrf
        @method('PATCH')
        <input type='text' id='incharge_id' name="incharge_id" value="" hidden>
    </form>

    <div class="incharge flex justify-between items-center border border-teal-50 rounded-md mt-3 p-3 hover:bg-teal-100 transition-all duration-500 ease-in-out hover:cursor-pointer">
        <div data-bound=''>None </div>
        <i class="bi-arrow-right text-slate-400"></i>
    </div>
    @foreach($users as $user)
    <div class="incharge flex justify-between items-center border border-teal-50 rounded-md mt-3 p-3 hover:bg-teal-100 transition-all duration-500 ease-in-out hover:cursor-pointer">
        <div data-bound='{{ $user->id }}'>{{ $user->profile->name }} </div>
        <i class="bi-arrow-right text-slate-400"></i>
    </div>
    @endforeach
</div>
@endsection
@section('script')
<script type="module">
    $(document).ready(function() {

        $('.incharge').click(function() {
            var inchargeId = $(this).children().first().attr('data-bound');
            $('#incharge_id').val(inchargeId);
            $('form').submit();
        })


    });
</script>
@endsection