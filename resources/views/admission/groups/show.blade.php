@extends('layouts.admission')
@section('page-content')
<div class="custom-container">
    <!--Title  -->
    <h1>{{ $group->name }}</h1>
    <div class="flex items-center">
        <div class="flex-1">
            <div class="bread-crumb">
                <a href="{{ url('/') }}">Dashboard</a>
                <div>/</div>
                <div>{{ $group->name }}</div>
                <div>/</div>
                <div>Applications ( {{ $group->applications->count() }} )</div>
            </div>
        </div>
        <!-- search -->
        <div class="flex relative w-full md:w-1/3">
            <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full" oninput="search(event)">
            <i class="bx bx-search absolute top-2 right-2"></i>
        </div>
    </div>


    @php $sr=1; @endphp
    <div class="overflow-x-auto w-full mt-8">

        <table class="table-fixed borderless w-full">
            <thead>
                <tr class="border-b">
                    <th class="w-8">Sr</th>
                    <th class="w-16">App #</th>
                    <th class="w-40 text-left">Student Name</th>
                    <th class="w-24">Group</th>
                    <th class="w-16">Marks</th>
                    <th class="w-16">%</th>
                    <th class="w-24">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($group->applications as $application)
                <tr class="tr text-sm border-b">
                    <td>{{$sr++}}</td>
                    <td>{{ $application->rollno }}</td>
                    <td class="text-left">{{ $application->name }}</td>
                    <td>{{ $application->group->name }}</td>
                    <td>{{ $application->obtained }}</td>
                    <td>{{ $application->obtainedPercentage() }}</td>
                    <td>{{ $application->status() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('script')
<script type="text/javascript">
    function search(event) {
        // var searchtext = event.target.value.toLowerCase();
        var searchtext = $('#searchby').val().toLowerCase();
        var str = 0;
        $('.tr').each(function() {
            if (!(
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