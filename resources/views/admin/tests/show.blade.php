@extends('layouts.admin')
@section('page-content')
    <h1>
        {{ $test->title }}</h1>
    <div class="bread-crumb">
        <a href="{{ url('/') }}">Home</a>
        <div>/</div>
        <a href="{{ route('admin.tests.index') }}">Tests</a>
        <div>/</div>
        <div>View</div>

    </div>

    <div class="grid md:grid-cols-2 md:w-4/5 mx-auto mt-6 bg-white md:p-8 p-4 rounded border gap-3">
        <div class="flex items-center gap-3 flex-wrap">
            <h2>Result</h2>
            @if ($test->testAllocations()->count())
                <p>{{ $test->testAllocations()->resultSubmitted()->count() }}/{{ $test->testAllocations->count() }}
                    ({{ round(($test->testAllocations()->resultSubmitted()->count() / $test->testAllocations->count()) * 100, 0) }}%)
                </p>
                <p class="text-sm"><i
                        class="bi-arrow-up"></i>{{ $test->testAllocations()->resultSubmitted()->today()->count() }}
                </p>
            @endif
        </div>

        <div class="flex items-center flex-wrap  justify-center md:justify-end">
            <div class="flex flex-wrap gap-2 items-center">

                @if ($test->is_open)
                    {{-- new allocation --}}
                    <a href="{{ route('admin.test.allocations.create', $test) }}"><i
                            class="bi-plus-lg text-blue-600"></i></a>
                    {{-- test edit button --}}
                    <a href="{{ route('admin.tests.edit', $test) }}">
                        <i class="bx bx-pencil text-green-600"></i>
                    </a>
                    <form action="{{ route('admin.test.lock', $test) }}" method='post'>
                        @csrf
                        @method('patch')
                        <button type="submit"><i class="bi-unlock text-slate-500 font-bold"></i></button>
                    </form>
                    {{-- delete button --}}
                    <form action="{{ route('admin.tests.destroy', $test) }}" method="POST" onsubmit="confirmDel(event)">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="flex justify-center items-center w-8 h-8 btn-red rounded-full text-xs">
                            <i class="bi-trash3 text-white"></i>
                        </button>
                    </form>
                @else
                    <form action="{{ route('admin.test.unlock', $test) }}" method='post'>
                        @csrf
                        @method('patch')
                        <button type="submit"><i class="bi-lock text-red-500 font-bold"></i></button>
                    </form>
                    {{-- print button --}}
                    <a href="{{ route('admin.test.sections.index', $test) }}">
                        <i class="bi-printer text-teal-600"></i>
                    </a>
                @endif


            </div>
        </div>
    </div>
    <div class="md:w-4/5 mx-auto mt-6 bg-white">
        <!-- page message -->
        @if ($errors->any())
            <x-message :errors='$errors'></x-message>
        @else
            <x-message></x-message>
        @endif
    </div>

    <div class="md:w-4/5 mx-auto mt-6 bg-white md:p-8 p-4 rounded border overflow-auto">
        <!-- search -->
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex relative w-full md:w-1/3">
                <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full"
                    oninput="search(event)">
                <i class="bx bx-search absolute top-2 right-2"></i>
            </div>
            <div class="flex items-center space-x-3 text-sm">
                <i class="bi-filter"></i>
                <span class="text-slate-600 hover:cursor-pointer" onclick="filterBy('all')">All</span>
                <span class="text-teal-600 hover:cursor-pointer" onclick="filterBy('submitted')">Submitted </span>
                <span class="text-red-600 hover:cursor-pointer" onclick="filterBy('pending')">Pending</span>

            </div>
        </div>

        <table class="table-fixed borderless w-full mt-8">
            <thead>
                <tr>
                    <th class="w-16">Sr</th>
                    <th class="text-left w-48">Subject</th>
                    <th class="w-16">Class</th>
                    <th class="w-16"><i class="bi-people"></i></th>
                    <th class="w-16">Marks</th>
                    <th class="w-16">Status</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($test->testAllocations->sortBy(['section_id', 'lecture_no']) as $testAllocation)
                    <tr class="tr">
                        <td>{{ $loop->index + 1 }}</td>
                        <td class="text-left"><a href="{{ route('admin.test.allocations.show', [$test, $testAllocation]) }}"
                                class="link">{{ $testAllocation->subject->name }}</a>
                            <br>
                            <span class="text-slate-500 text-xs">{{ $testAllocation->teacher?->name }}</span>
                        </td>
                        <td>{{ $testAllocation->section->fullName() }}</td>
                        <td>{{ $testAllocation->appearingStudents->count() }}</td>
                        <td>{{ $testAllocation->max_marks }}</td>
                        <td class="@if ($testAllocation->result_date) submitted @else pending @endif">
                            @if ($testAllocation->result_date)
                                <form action="{{ route('admin.test-allocation.unlock', $testAllocation) }}" method='post'>
                                    @csrf
                                    @method('patch')
                                    <button type="submit"><i class="bi-lock text-red-500 font-bold"></i></button>
                                </form>
                            @else
                                <form action="{{ route('admin.test-allocation.lock', $testAllocation) }}" method='post'>
                                    @csrf
                                    @method('patch')
                                    <button type="submit"><i class="bi-unlock text-slate-500 "></i></button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
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
                            $(this).children().eq(5).hasClass(criteria)
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
