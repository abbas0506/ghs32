@extends('layouts.teacher')
@section('page-content')
<!--welcome  -->
<div class="flex items-center">
    <div class="flex-1">
        <div class="bread-crumb">
            <div>Teacher</div>
            <div>/</div>
            <div>Dashbaord</div>
        </div>
    </div>
    <label class="text-slate-500">{{ today()->format('d/m/Y') }}</label>
</div>

<!-- pallets -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
    <a href="{{ route('teacher.tests.index') }}" class="pallet-box bg-gradient-to-r from-teal-50 to-white ">
        <div class="flex-1">
            <h3>Collective Tests</h3>
            <p class="text-sm text-slate-600 font-thin">Pendency:
                @if (Auth::user()->testAllocations()->active()->count())
                {{100-round(Auth::user()->testAllocations()->combined()->active()->resultSubmitted()->count()/Auth::user()->testAllocations()->combined()->active()->count()*100,0)}} %
                @else
                -
                @endif

            </p>
        </div>
        <div class="ico bg-teal-100 text-teal-600">
            {{ $tests->whereNull('user_id')->where('is_open', true)->count() }}
        </div>
    </a>
    <a href="#" class="pallet-box bg-gradient-to-r from-indigo-50 to-white">
        <div class="flex-1">
            <h3>Individual Tests</h3>
            <p class="text-sm text-slate-600 font-thin">Pendency: -</p>
        </div>
        <div class="ico bg-indigo-100 text-indigo-400">
            {{ Auth::user()->tests()->individual()->count() }}
        </div>
    </a>

</div>

<h2 class="text-red-600 mt-12">My Subjects: {{ Auth::user()->allocations()->count() }}</h2>
<div class="overflow-x-auto w-full mt-4">
    <table class="table-fixed borderless w-full">
        <thead>
            <tr>
                <th class="w-8">Sr</th>
                <th class="w-40 text-left">Subject</th>
                <th class="w-16">Class</th>
                <th class="w-16">Lecture #</th>
            </tr>

        </thead>
        <tbody>
            @foreach(Auth::user()->allocations->sortBy('lecture_no') as $allocation)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td class="text-left">{{ $allocation->subject->name }}</td>
                <td>{{ $allocation->section->roman() }}</td>
                <td>{{ $allocation->lecture_no }} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection