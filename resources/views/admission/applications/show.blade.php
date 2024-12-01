@extends('layouts.admission')

@section('page-content')
<div class="custom-container">
    <!-- Title     -->
    <h1>Applications</h1>

    <div class="bread-crumb">
        <a href="{{ url('/') }}">Dashboard</a>
        <div>/</div>
        <div>Application # {{ $application->rollno }}</div>
        <div>/</div>
        <div>View</div>
    </div>

    <div class="container grid gap-4 px-5 md:px-60 relative mt-3">
        <a href="{{ route('admission.applications.index') }}" class="absolute top-2 right-2 p-2 hover:bg-slate-200 rounded"><i class="bi-x-lg"></i></a>
        <div>
            <label for="">Application #</label>
            <div class="flex flex-wrap items-center gap-x-4">
                <h2>{{ $application->rollno }}</h2>
                <p>dated {{ $application->created_at->addHours(5)}}</p>
            </div>
        </div>
        <div>
            <label for="">Name</label>
            <h2>{{ $application->name }} s/o {{ $application->father }}</h2>
            <p class="text-slate-600 text-sm">{{ $application->bform }}, {{ $application->phone }}</p>
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
            <label for="">Fee Paid</label>
            <p>{{ $application->fee_paid }} @if($application->concession>0) <span class="text-sm">( Concession: {{ $application->concession }} )</span> @endif </p>
        </div>
        <div>
            <label for="">Objection</label>
            <p>{{ $application->objection }} </p>
        </div>

    </div>

    @endsection