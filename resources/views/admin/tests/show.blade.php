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
    <div class="flex items-center justify-between">
        <h2>Result Submission @if($test->testAllocations()->resultSubmitted()->today()->count()) <span class="text-teal-600 font-normal ml-8"> <i class="bi-arrow-up"></i>{{ $test->testAllocations()->resultSubmitted()->today()->count() }} @endif</span></h2>
        <div class="flex justify-center items-center w-12 h-12 rounded-full bg-teal-100 text-teal-600">{{ round($test->testAllocations()->resultSubmitted()->count()/$test->testAllocations->count()*100,0) }}%</div>

    </div>
    <div class="overflow-auto">
        <table class="table-fixed borderless w-full mt-8">
            <thead>
                <tr>
                    <th class="w-16">Sr</th>
                    <th class="w-16">Class</th>
                    <th class="text-left w-48">Subject</th>
                    <th class="text-left w-48">Teacher</th>
                    <th class="w-16">Studens</th>
                    <th class="w-16">Marks</th>
                    <th class="w-16">Status</th>
                    <th class="w-16">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach($test->testAllocations->sortBy('test.section_id')->sortBy('result_date') as $testAllocation)
                <tr class="tr">
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $testAllocation->allocation->section->roman() }}</td>
                    <td class="text-left">{{ $testAllocation->allocation->subject->name }}</td>
                    <td class="text-left">{{ $testAllocation->allocation->teacher?->profile?->name }}</td>
                    <td>{{ $testAllocation->appearingStudents->count() }}</td>
                    <td>{{ $testAllocation->total_marks }}</td>
                    <td> @if(!$testAllocation->result_date)
                        <i class="bi-question text-red-600"></i>
                        @else
                        <i class="bi-check-lg text-green-600"></i>
                        @endif
                    </td>
                    <td> @if($testAllocation->result_date)
                        <form action="{{ route('admin.test-allocations.unlock',$testAllocation) }}" method="post" onsubmit="return validate(event)">
                            @csrf
                            @method('patch')
                            <button class="btn-blue rounded-full text-xs" type="submit">Unlock</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    function validate(event) {
        event.preventDefault(); // prevent form submit
        var form = event.target; // storing the form

        Swal.fire({
            title: 'Are you sure?',
            text: "Result will be unlocked!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, unlock it!'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        })
    }
</script>
@endsection