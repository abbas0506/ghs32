@extends('layouts.admission')
@section('page-content')
<div class="container bg-slate-100">
    <!-- Title     -->
    <h1>Objections</h1>
    <div class="bread-crumb">
        <a href="{{ url('/') }}">Dashboard</a>
        <div>/</div>
        <div>Objections {{ $application->rollno }}</div>
        <div>/</div>
        <div>Edit</div>
    </div>
    <div class="container px-5 md:px-48 mt-2 relative">
        <a href="{{ route('admission.objections.index') }}" class="absolute top-2 right-2 p-2 hover:bg-slate-200 rounded"><i class="bi-x-lg"></i></a>
        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <form action="{{route('admission.objections.update', $application)}}" method="post" class="mt-8 grid gap-4">
            @csrf
            @method('PATCH')
            <div>
                <label for="">Application #</label>
                <div class="flex flex-wrap items-center gap-x-4">
                    <h2>{{ $application->rollno }}</h2>
                    <p>dated {{ $application->created_at->format('d/m/Y h:m') }}</p>
                </div>
            </div>
            <div>
                <label for="">Name</label>
                <h2>{{ $application->name }} s/o {{ $application->father }}</h2>
            </div>
            <div>
                <label for="">Group</label>
                <p>{{ $application->group->name }}</p>
            </div>
            <div>
                <label for="">Marks</label>
                <p>{{ $application->obtained }} ( {{ $application->obtainedPercentage() }} % ) {{ ucfirst($application->bise_name)}} board, {{ $application->pass_year }}</p>
            </div>
            <div>
                <label for="">Objection</label>
                <input type="text" name="objection" class="custom-input" placeholder="Objection" value="{{ $application->objection }}">
            </div>

            <div class="mt-5">
                <button class="btn-teal rounded py-2">Update Now</button>

            </div>
        </form>
    </div>

    @endsection