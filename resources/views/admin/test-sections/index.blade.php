@extends('layouts.admin')
@section('page-content')

<div class="custom-container">
    <h1>Print Result</h1>
    <div class="bread-crumb">
        <a href="{{url('/')}}">Dashoboard</a>
        <div>/</div>
        <div>Tests</div>
        <div>/</div>
        <div>Print</div>
    </div>
    <div class="overflow-x-auto">
        <h2 class="mt-12">{{ $test->title }}</h2>
        <table class="table-auto borderless w-full mt-6 text-sm">
            <thead>
                <tr>
                    <th>Sr</th>
                    <th>Class</th>
                    <th><i class="bi-people-fill"></i></th>
                    <th>Print</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sections->sortBy('grade_id') as $section)
                <tr class="text-sm">
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $section->roman() }}</td>
                    <td>{{$section->students->count()}}</td>
                    <td>
                        <a href="{{route('admin.test.section.results.index',[$test, $section])}}" class="w-16"><i class="bi-printer"></i></a>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection