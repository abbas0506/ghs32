@extends('layouts.teacher')
@section('page-content')

<h2>{{ $testAllocation->allocation->section->roman() }}</h2>
<div class="bread-crumb">
    <a href="{{url('/')}}">Home</a>
    <div>/</div>
    <a href="{{ route('teacher.tests.index') }}">Tests</a>
    <div>/</div>
    <a href="{{ route('teacher.test.test-allocations.index', $testAllocation->test) }}">Subjects</a>
    <div>/</div>
    <div>Results</div>
</div>

<div class="flex flex-col md:flex-row md:items-center gap-x-2 mt-8">
    <i class="bi bi-info-circle text-2xl w-8"></i>
    <ul class="text-sm">
        <li>If you find any student missing here, you can import from section </li>
        <li>If you mistakenly added any student here, feel free to remove it </li>
    </ul>
</div>
<!-- page message -->
@if($errors->any())
<x-message :errors='$errors'></x-message>
@else
<x-message></x-message>
@endif
<div class="flex flex-wrap justify-between gap-3 items-center mt-8">
    <div>
        <h2 class="text-teal-600">{{ $testAllocation->test->title }}</h2>
        <p class="text-teal-600">{{ $testAllocation->allocation->subject->name }} , {{ $testAllocation->allocation->section->roman() }}</p>
    </div>

    <div class="flex items-center gap-3">
        <h2 class="text-slate-600 text-center"><i class="bi-people"></i> {{ $testAllocation->appearingStudents->count() }}/{{ $testAllocation->allocation->section->students->count() }}</h2>
        <a href="{{route('teacher.test-allocation.import-students.index',$testAllocation)}}" class="btn-blue rounded">Import <i class="bi bi-file-earmark-excel text-teal-200"></i></a>
        @if($testAllocation->appearingStudents->count())
        <a href="{{route('teacher.test-allocation.results.edit',[$testAllocation,0])}}" class="btn-teal rounded">Feed Result</i></a>
        @endif
    </div>
</div>

<div class="overflow-x-auto w-full mt-8">
    <table class="table-fixed borderless w-full">
        <thead>
            <tr>
                <th class="w-12">Roll #</th>
                <th class="w-40 text-left">Name</th>
                <th class="w-12">Marks</th>
                <th class="w-16">Remove</th>
            </tr>
        </thead>
        <tbody>
            @foreach($testAllocation->results->sortBy('student.rollno') as $result)
            <tr class="tr">
                <td>{{ $result->student->rollno }}</td>
                <td class="text-left">{{ $result->student->name }}</td>
                <td>{{ $result->obtained_marks }}</td>
                <td>
                    <form action="{{route('teacher.test-allocation.results.destroy',[$testAllocation, $result])}}" method="post" onsubmit="return confirmDel(event)">
                        @csrf
                        @method('DELETE')
                        <button><i class="bi-x text-red-600"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<!-- dont show final submission if no student -->
@if($testAllocation->appearingStudents->count())
<div class="md:w-2/3 mx-auto mt-8 text-center">
    <h3 class="text-red-600">Please note!</h3>
    <p>After feeding complete result, you need to make final submission as a last step. Use this option only when you are sure about the result. Once submitted, result will not remain editable for this subject.</p>
    <form action="{{ route('teacher.test.test-allocations.update',[$testAllocation->test, $testAllocation]) }}" method="post" class="mt-6 text-center">
        @csrf
        @method('patch')
        <button type="submit" class="btn-red rounded p-2 px-5 text-sm">Make Final Submission</button>
    </form>
</div>
@endif

@endsection
@section('script')
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
</script>
@endsection