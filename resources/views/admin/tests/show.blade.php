@extends('layouts.admin')
@section('page-content')

<h1>{{ $test->title }}</h1>
<div class="bread-crumb">
    <a href="{{url('/')}}">Home</a>
    <div>/</div>
    <a href="{{route('admin.tests.index')}}">Tests</a>
    <div>/</div>
    <div>View</div>

</div>


<div class="content-section  mt-8">
    <h2>Result Submission Status</h2>
    <table class="table-auto borderless w-full mt-8">
        <thead>
            <tr class="">
                <th class="w-16">Sr</th>
                <th>Class</th>
                <th>Lecture #</th>
                <th class="text-left">Subject</th>
                <th class="text-left">Teacher</th>
                <th>Studens</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>

            @foreach($test->testAllocations->sortBy('test.section_id') as $testAllocation)
            <tr class="tr">
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $testAllocation->allocation->section->roman() }}</td>
                <td>{{ $testAllocation->allocation->lecture_no }}</td>
                <td class="text-left">{{ $testAllocation->allocation->subject->name }}</td>
                <td class="text-left">{{ $testAllocation->allocation->teacher?->profile?->name }}</td>
                <td>{{ $testAllocation->appearingStudents->count() }}</td>
                <td> @if(!$testAllocation->result_date)
                    <i class="bi-question text-red-600"></i>
                    @else
                    <i class="bi-check-lg text-green-600"></i>
                    @endif
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
</div>
</div>
<script type="text/javascript">
    function delme(formid) {

        event.preventDefault();

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
                //submit corresponding form
                $('#del_form' + formid).submit();
            }
        });
    }

    function search(event) {
        var searchtext = event.target.value.toLowerCase();
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