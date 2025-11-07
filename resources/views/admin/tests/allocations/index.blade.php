@extends('layouts.admin')
@section('page-content')
    <h1>{{ $test->title }}</h1>
    <div class="bread-crumb">
        <a href="{{ url('/') }}">Home</a>
        <div>/</div>
        <a href="{{ route('admin.tests.index') }}">Tests</a>
        <div>/</div>
        <div>View</div>

    </div>


    <div class="content-section  mt-8">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-8 flex-wrap">
                <h2>Result Status</h2>
                <div class="flex items-center gap-4 flex-wrap">
                    @if ($test->testAllocations()->count())
                        <p>{{ $test->testAllocations()->resultSubmitted()->count() }} / {{ $testAllocations->count() }}
                            ({{ round(($test->testAllocations()->resultSubmitted()->count() / $test->testAllocations->count()) * 100, 0) }}%)
                        </p>
                        <p class="text-sm"><i
                                class="bi-arrow-up"></i>{{ $test->testAllocations()->resultSubmitted()->today()->count() }}
                        </p>
                    @endif
                </div>
                <a href="{{ route('admin.test.sections.index', $test) }}" class="link text-sm">Get Print &nbsp <i
                        class="bi-printer"></i></a>
            </div>
            <div class="flex items-center space-x-3 text-sm">
                <i class="bi-filter"></i>
                <span class="text-slate-600 hover:cursor-pointer" onclick="filterBy('all')">All</span>
                <span class="text-teal-600 hover:cursor-pointer" onclick="filterBy('submitted')">Submitted </span>
                <span class="text-red-600 hover:cursor-pointer" onclick="filterBy('pending')">Pending</span>

            </div>
        </div>

        <!-- page message -->
        @if ($errors->any())
            <x-message :errors='$errors'></x-message>
        @else
            <x-message></x-message>
        @endif

        <div class="overflow-auto">
            <table class="table-fixed borderless w-full mt-4">
                <thead>
                    <tr>
                        <th class="w-16">Sr</th>
                        <th class="w-16">Class</th>
                        <th class="text-left w-48">Subject</th>
                        <th class="text-left w-48">Teacher</th>
                        <th class="text-left w-16">Lecture #</th>
                        <th class="w-16">Studens</th>
                        <th class="w-16">Marks</th>
                        <th class="w-16">Result</th>
                        <th class="w-16">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($testAllocations->sortBy(['section_id', 'lecture_no']) as $testAllocation)
                        <tr class="tr">
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $testAllocation->section->fullName() }}</td>
                            <td class="text-left">{{ $testAllocation->subject->name }}</td>
                            <td class="text-left">{{ $testAllocation->teacher?->name }}</td>
                            <td class="">{{ $testAllocation->lecture_no }}</td>
                            <td>{{ $testAllocation->appearingStudents->count() }}</td>
                            <td>{{ $testAllocation->max_marks }}</td>
                            <td class="@if ($testAllocation->result_date) submitted @else pending @endif">
                                @if ($testAllocation->result_date)
                                    <i class="bi-check-lg text-green-500 font-bold"></i>
                                @else
                                    <i class="bi-question text-red-600 font-bold"></i>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-center items-center space-x-2">
                                    <a href="{{ route('admin.test.allocations.edit', [$test, $testAllocation]) }}">
                                        <i class="bx bx-pencil text-green-600"></i>
                                    </a>
                                    <span class="text-slate-400">|</span>
                                    @if ($testAllocation->appearingStudents->count() == 0)
                                        <form
                                            action="{{ route('admin.test.allocations.destroy', [$test, $testAllocation]) }}"
                                            method="POST" onsubmit="return confirmDel(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-transparent p-0 border-0">
                                                <i class="bx bx-trash text-red-600"></i>
                                            </button>
                                        </form>
                                    @else
                                        <i class="bx bx-trash text-red-300"></i>
                                    @endif
                                </div>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <a href="{{ route('admin.test.allocations.create', $test) }}"
        class="flex w-12 h-12 justify-center items-center fixed bottom-4 right-4 btn-blue rounded-full"><i
            class="bi-plus"></i></a>
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

        function filterBy(criteria) {
            if (criteria == 'all') {
                $('.tr').each(function() {
                    $(this).removeClass('hidden');
                });
            } else {
                // show submitted or pending as selected
                $('.tr').each(function() {
                    if ((
                            $(this).children().eq(6).hasClass(criteria)
                        )) {
                        $(this).removeClass('hidden');
                    } else {
                        $(this).addClass('hidden');
                    }
                });
            }

        }
    </script>
@endsection
