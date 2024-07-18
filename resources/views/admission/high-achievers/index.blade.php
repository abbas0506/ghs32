@extends('layouts.admission')
@section('page-content')
<div class="container bg-slate-100">
    <!-- Title     -->
    <h1>High Achievers</h1>
    <div class="flex items-center space-x-2">
        <div class="flex-1">
            <div class="bread-crumb">
                <a href="{{ url('/') }}">Dashboard</a>
                <div>/</div>
                <div>High Achievers</div>
                <div>/</div>
                <div>Applications ( {{ $applications->count() }} )</div>
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
                    <th class="w-16">Fee</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications->sortByDesc('updated_at') as $application)
                <tr class="tr text-sm border-b">
                    <td>{{$sr++}}</td>
                    <td>
                        <a href="{{ route('admission.fee.edit', $application) }}" class="link">{{ $application->rollno }}</a>
                    </td>
                    <td class="text-left">{{ $application->name }}</td>
                    <td>{{ $application->group->name }}</td>
                    <td>{{ $application->obtained }} <span class="text-xs ml-2">({{ $application->obtainedPercentage() }} %)</span></td>
                    <td>{{ $application->fee_paid }} @if($application->concession)<span class="text-xs ml-2"><i class="bi-arrow-down"></i>{{ $application->concession }}</span>@endif </td>
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
</script>
@endsection