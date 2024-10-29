@extends('layouts.admin')
@section('page-content')

<div class="custom-container">
    <h1>Classes</h1>
    <div class="bread-crumb">
        <a href="{{url('admin')}}">Dashoboard</a>
        <div>/</div>
        <div>Grades</div>
        <div>/</div>
        <div>All</div>
    </div>
    <div class="overflow-x-auto">
        <table class="table-fixed w-full mt-12 text-sm">
            <thead>
                <tr>
                    <th class="w-16">Grade</th>
                    <th class="w-24 text-left">Sections</th>
                    <th class="w-16"><i class="bi-people-fill"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $grade)
                <tr class="text-sm">
                    <td>{{$grade->grade_no}}</td>
                    <td class="text-left">

                        @foreach($grade->sections as $section)
                        <a href="{{route('admin.section.students.index',$section)}}" class="w-16 rounded btn-teal">{{$section->name}} <span class="text-xs"> ({{ $section->students->count() }})</span></a>
                        @endforeach
                        <a href="{{route('admin.grade.sections.create',$grade)}}" class="w-16 rounded btn-teal"><i class="bi-plus-lg"></i></a>
                    </td>
                    <td>{{$grade->students->count()}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection