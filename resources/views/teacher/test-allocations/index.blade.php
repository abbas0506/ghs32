@extends('layouts.teacher')
@section('page-content')
<style>
    tr.submitted td {
        background-color: #dcfce7;
    }
</style>
<h1>{{ $test->title }}</h1>
<div class="bread-crumb">
    <a href="{{url('/')}}">Home</a>
    <div>/</div>
    <a href="{{ route('teacher.tests.index')}}">Tests</a>
    <div>/</div>
    <div>Subjects</div>
</div>
<div class="divider my-3"></div>
@php
$colors=config('globals.colors');
@endphp

<div class="content-section">

    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <h2 class="mt-8">My Allocations ({{ $testAllocations->count() }})</h2>
    <div class="overflow-x-auto w-full mt-4">
        <table class="table-fixed borderless w-full">
            <thead>
                <tr class="">
                    <th class="w-8">Sr</th>
                    <th class="w-16">Class</th>
                    <th class="w-40 text-left">Subject</th>
                    <th class="w-16">Appeared</th>
                    <th class="w-16">Status</th>
                    <th class="w-16">Print</th>
                </tr>
            </thead>
            <tbody>
                @foreach($testAllocations as $testAllocation)
                <tr class="tr @if($testAllocation->hasBeenSubmitted()) submitted @endif">
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $testAllocation->allocation->section->roman() }}</td>
                    <td class="text-left">
                        <a href="{{ route('teacher.test-allocation.results.index',$testAllocation) }}" class="link">
                            {{ $testAllocation->allocation->subject->name }}
                        </a>
                    </td>
                    <td>{{ $testAllocation->appearingStudents->count() }}</td>
                    <td>
                        @if($testAllocation->hasBeenSubmitted())
                        <i class="bi-check-lg text-teal-600"></i>
                        @else
                        <i class="bi-question-lg text-red-600"></i>
                        @endif
                    </td>
                    <td>
                        @if($testAllocation->hasBeenSubmitted())
                        <a href="{{ route('teacher.test-allocation.result.print', $testAllocation) }}"><i class="bi-printer"></i></a>
                        <a href="{{ route('teacher.test.section.results.index', [$testAllocation->test, $testAllocation->allocation->section]) }}" class="ml-2"><i class="bi-award"></i></a>

                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- <p class="p-3 bg-slate-100">Please click on any of the following subjects to view / feed the result</p>
    <div class="grid md:grid-cols-2 gap-6 ">
        @foreach($testAllocations as $testAllocation)
        <a href="{{ route('teacher.test-allocation.results.index',$testAllocation) }}" class="text-center p-4 rounded-lg bg-{{ $colors[$loop->index%4] }}-100 text-{{ $colors[$loop->index%4] }}-600">
            {{ $testAllocation->allocation->subject->name }} , {{ $testAllocation->allocation->section->roman() }}
        </a>
        @endforeach

    </div> -->
</div>
@endsection