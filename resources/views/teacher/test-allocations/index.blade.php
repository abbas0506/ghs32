@extends('layouts.teacher')
@section('page-content')
<style>
    tr.submitted td {
        background-color: #f0f9f7;

    }

    tr.submitted {
        border-bottom: 0.4px solid #a6e0e1;
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

    @if(Auth::user()->section)
    <h2 class="mt-8">My Section: ({{ Auth::user()->section->fullName() }})</h2>
    <div class="flex flex-wrap items-center gap-4 mt-4">
        <div class="rounded-full border flex justify-center items-center w-10 h-10 p-3">
            <i class="bi-printer text-xl"></i>
        </div>
        <div class="flex flex-wrap items-center gap-4 text-sm">
            <a href="{{ route('teacher.test.section.result.print', [$test, Auth::user()->section]) }}" target="_blank" class="link">Result Summary</a>|
            <a href="{{ route('teacher.test.section.positions.print', [$test, Auth::user()->section]) }}" target="_blank" class="link">Class Positions</a>|
            <a href="{{ route('teacher.test.section.report-cards.print', [$test, Auth::user()->section]) }}" target="_blank" class="link">Result Cards</a>
        </div>
    </div>
    <div class="divider mt-8"></div>
    @endif
    <h2 class="mt-8">My Subjects ({{ $testAllocations->count() }})</h2>
    <div class="overflow-x-auto w-full mt-4">
        <table class="table-fixed borderless w-full">
            <thead>
                <tr>
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
                    <td>{{ $testAllocation->section->fullName() }}</td>
                    <td class="text-left">
                        <a href="{{ route('teacher.test-allocation.results.index',$testAllocation) }}" class="link">
                            {{ $testAllocation->subject->name }}
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
                        <a href="{{ route('teacher.test-allocation.result.print', $testAllocation) }}" target="_blank"><i class="bi-printer"></i></a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection