@extends('layouts.admin')
@section('page-content')

<div class="custom-container">
    <h1>Grades</h1>
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
                    <th class="w-16">Grade #</th>
                    <th class="w-32">Engllish</th>
                    <th class="w-16">Roman</th>
                    <th class="w-24">Sections</th>
                    <th class="w-16"><i class="bi-people-fill"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $grade)
                <tr class="text-sm">
                    <td>{{$grade->grade_no}}</td>
                    <td>{{$grade->english_name}}</td>
                    <td>{{$grade->roman_name}}</td>
                    <td>

                        @foreach($grade->classes as $clas)
                        <a href="{{route('admin.class.students.index',$clas)}}" class="w-4 link">{{$clas->section_label}}</a>
                        @endforeach

                    </td>
                    <td>{{$grade->students->count()}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection