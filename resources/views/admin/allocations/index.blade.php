@extends('layouts.admin')
@section('page-content')

<h1>Allocations</h1>
<div class="bread-crumb">
    <a href="{{url('admin')}}">Dashoboard</a>
    <div>/</div>
    <a href="{{route('admin.sections.index')}}">Sections</a>
    <div>/</div>
    <div>Allocations</div>
</div>

<!-- search -->
<!-- <div class="flex items-center justify-between mt-12">
    <div class="flex relative w-full md:w-1/3">
        <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full" oninput="search(event)">
        <i class="bx bx-search absolute top-2 right-2"></i>
    </div>
</div> -->

<!-- page message -->
@if($errors->any())
<x-message :errors='$errors'></x-message>
@else
<x-message></x-message>
@endif

<div class="overflow-x-auto bg-white w-full mt-8">

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="w-11">Section</th>
                <th>0</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i=0;
            @endphp

            @foreach($sections as $section)
            <tr>
                <td class="font-semibold">{{ $section->roman()}}</td>
                @foreach(range(0,8) as $lecture_no)
                <td class="p-0">
                    @foreach($section->allocations()->havingLectureNo($lecture_no)->get() as $allocation)
                    <div class="text-sm bg-teal-50">
                        <a href="{{ route('admin.section.lecture.allocations.edit', [$section, $lecture_no, $allocation]) }}" class="link">{{ $allocation->subject->short_name }}</a>
                        <p>{{ $allocation->teacher->profile->name }}</p>
                    </div>
                    <div class="divider"></div>
                    @endforeach
                    <a href="{{ route('admin.section.lecture.allocations.create',[$section, $lecture_no]) }}" class="text-sm link"><i class="bi-clock"></i></a>
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