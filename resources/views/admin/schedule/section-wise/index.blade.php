@extends('layouts.admin')
@section('page-content')

<style>
    table.sm tbody tr td,
    table.sm tbody tr td div {
        font-size: 12px;
    }
</style>
<h1>Allocations</h1>
<div class="bread-crumb">
    <a href="{{url('admin')}}">Dashoboard</a>
    <div>/</div>
    <a href="{{route('admin.sections.index')}}">Sections</a>
    <div>/</div>
    <div>Allocations</div>
</div>

<!-- search -->
<div class="flex items-center justify-between mt-12">
    <div class="flex relative w-full md:w-1/3">
        <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full" oninput="search(event)">
        <i class="bx bx-search absolute top-2 right-2"></i>
    </div>
    <div class="flex gap-3">
        <a href="{{ url('admin/teacher-wise-schedule') }}"><i class="bi-repeat text-green-700"></i></a>
        <a href="{{ url('admin/section-wise-schedule/print') }}" target="_blank"><i class="bi-printer text-cyan-700"></i></a>
        <a href="{{ url('admin/section-wise-schedule/clear') }}"><i class="bi-recycle text-orange-600"></i></a>
    </div>
</div>

<!-- page message -->
@if($errors->any())
<x-message :errors='$errors'></x-message>
@else
<x-message></x-message>
@endif

<div class="overflow-x-auto bg-white w-full mt-8">

    <table class="table-auto sm w-full">
        <thead>
            <tr>
                <th class="w-24">Class</th>
                @foreach(range(1,8) as $lecture_no)
                <th>{{ $lecture_no }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($sections as $section)
            <tr>
                <td class="font-bold"> {{ $section->fullName()}}</td>
                @foreach(range(1,8) as $lecture_no)
                <td class="p-1">
                    @foreach($section->allocations()->havingLectureNo($lecture_no)->get() as $allocation)
                    <div class="text-sm bg-teal-50">
                        <a href="{{ route('admin.section.lecture.schedule.edit', [$section, $lecture_no, $allocation]) }}" class="link">{{ $allocation->subject->short_name }}</a>
                        <p>{{ $allocation->teacher->name }}</p>
                    </div>
                    <div class="divider"></div>
                    @endforeach
                    <a href="{{ route('admin.section.lecture.schedule.create',[$section, $lecture_no]) }}" class="text-sm link"><i class="bi-plus"></i></a>
                </td>
                @endforeach
            </tr>
            @endforeach

        </tbody>
    </table>
</div>

</div>

<script type="text/javascript">
    function confirmDel(event) {
        event.preventDefault(); // prevent form submit
        var form = event.target; // storing the form

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        })
    }

    function confirmClean(event) {
        event.preventDefault(); // prevent form submit
        var form = event.target; // storing the form

        Swal.fire({
            title: 'Are you sure?',
            text: "You are going to clean this class!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        })
    }


    function search(event) {
        var searchtext = event.target.value.toLowerCase();
        var str = 0;
        $('.tr').each(function() {
            if (!(
                    $(this).children().eq(0).prop('outerText').toLowerCase().includes(searchtext) ||
                    $(this).children().eq(1).prop('outerText').toLowerCase().includes(searchtext)
                )) {
                $(this).addClass('hidden');
            } else {
                $(this).removeClass('hidden');
            }
        });
    }
</script>

@endsection