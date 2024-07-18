@extends('layouts.admission')
@section('page-content')
<div class="container bg-slate-100">
    <!--Title  -->
    <h1>Fee</h1>
    <div class="bread-crumb">
        <a href="{{ url('/') }}">Dashboard</a>
        <div>/</div>
        <div>Fee</div>
        <div>/</div>
        <div>Edit</div>
    </div>
    <div class="container px-5 md:px-48 mt-2 relative">
        <a href="{{ route('admission.fee.index') }}" class="absolute top-2 right-2 p-2 hover:bg-slate-200 rounded"><i class="bi-x-lg"></i></a>
        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <form action="{{route('admission.fee.update', $application)}}" method="post" class="mt-8 grid gap-4">
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
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="">Fee</label>
                    <input type="number" name="fee_paid" class="custom-input" placeholder="Fee" min='0' value="{{ $application->fee_paid }}">
                </div>
                @if($application->obtained>=1000)
                <div>
                    <label for="">Concession</label>
                    <input type="number" name="concession" class="custom-input" placeholder="Concession" min='0' value="{{ $application->concession}}">
                </div>
                @endif
            </div>

            <div class="mt-5">
                <button class="btn-teal rounded py-2">Pay Now</button>
            </div>
        </form>
    </div>
</div>

@endsection