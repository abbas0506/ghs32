@extends('layouts.admission')
@section('page-content')
<div class="custom-container">
    <!-- Title     -->
    <h1>Applications</h1>
    <div class="flex flex-wrap items-center gap-2">
        <div class="flex-1">
            <div class="bread-crumb">
                <a href="{{ url('/') }}">Dashboard</a>
                <div>/</div>
                <div>Applications ( {{ $applications->count() }} )</div>
            </div>
        </div>
    </div>

    <form action="{{ route('admission.cards.store') }}" method="post">
        @csrf
        <div class="flex mt-4">
            <!-- search -->
            <div class="flex relative w-full md:w-1/3">
                <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full" oninput="search(event)">
                <i class="bx bx-search absolute top-2 right-2"></i>
            </div>
            <div class="flex justify-end w-full">
                <div class="flex w-12 h-12 items-center justify-center rounded-full bg-orange-100 hover:bg-orange-200">
                    <button type="submit"><i class="bi-printer"></i></button>
                </div>
            </div>

        </div>
        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

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
                        <th class="w-16">Fee</th>
                        <th class="w-16">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications->sortByDesc('updated_at') as $application)
                    <tr class="tr text-sm border-b">
                        <td>{{$sr++}}</td>
                        <td>
                            <a href="{{ route('admission.applications.show', $application) }}" class="link">{{ $application->rollno }}</a>
                        </td>
                        <td class="text-left">{{ $application->name }}</td>
                        <td>{{ $application->group->name }}</td>
                        <td>{{ $application->obtained }}</td>
                        <td>{{ $application->obtainedPercentage() }}</td>
                        <td>{{ $application->fee_paid }}</td>
                        <td>@if ($application->img)
                            <img src="{{ asset('storage/' . $application->img) }}" alt="Photo"
                                style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px;">
                            @else
                            <span style="color: #999;">No Photo</span>
                            @endif
                        </td>
                        <td>
                            <div class="flex items-center justify-center">
                                <input type="checkbox" class="w-4 h-4 rounded" name="application_ids_array[]" value="{{ $application->id }}">
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>
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