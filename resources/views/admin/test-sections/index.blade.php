@extends('layouts.admin')
@section('page-content')

<div class="custom-container">
    <h1>Result Cards</h1>
    <div class="bread-crumb">
        <a href="{{url('/')}}">Dashoboard</a>
        <div>/</div>
        <div>Tests</div>
        <div>/</div>
        <div>Result Cards</div>
    </div>
    <div class="overflow-x-auto md:w-2/3 mx-auto">
        <h2 class="mt-12">{{ $test->title }}</h2>
        <p class="text-slate-600">Section Wise Result Cards</p>
        <table class="table-auto borderless w-full mt-6 sm">
            <thead>
                <tr>
                    <th>Sr</th>
                    <th>Class</th>
                    <th><i class="bi-people-fill"></i></th>
                    <th>Result Detail</th>
                    <th>Positions</th>
                    <th>Report Cards</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sections->sortBy('grade') as $section)
                <tr class="border-b">
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $section->roman() }}</td>
                    <td>{{$section->students->count()}}</td>
                    <td>
                        <a href="{{route('admin.test.section.result.print',[$test, $section])}}" target="_blank" class="w-16"><i class="bi-printer"></i></a>
                    </td>
                    <td>
                        <a href="{{route('admin.test.section.positions.print',[$test, $section])}}" target="_blank" class="w-16"><i class="bi-printer"></i></a>
                    </td>
                    <td>
                        <a href="{{route('admin.test.section.report-cards.print',[$test, $section])}}" target="_blank" class="w-16"><i class="bi-printer"></i></a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection