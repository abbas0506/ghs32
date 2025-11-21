@extends('layouts.admin')
@section('page-content')
    <h1>Collective Tests</h1>
    <div class="bread-crumb">
        <a href="{{ url('/') }}">Home</a>
        <div>/</div>
        <div>Tests</div>
    </div>

    <div class="grid md:w-4/5 mx-auto mt-6 bg-white md:p-8 p-4 rounded border gap-3">
        <!-- page message -->
        @if ($errors->any())
            <x-message :errors='$errors'></x-message>
        @else
            <x-message></x-message>
        @endif

        <!-- search -->
        <div class="flex relative w-full md:w-1/3">
            <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full" oninput="search(event)">
            <i class="bx bx-search absolute top-2 right-2"></i>
        </div>

        {{-- new buttn --}}
        <a href="{{ route('admin.tests.create') }}"
            class="fixed bottom-4 right-4 flex justify-center items-center bg-teal-400 hover:bg-teal-600 hover:cursor-pointer rounded-full w-12 h-12"><i
                class="bi-plus-lg"></i></a>

        <table class="table-auto borderless w-full mt-8">
            <thead>
                <tr class="">
                    <th class="w-16">Sr</th>
                    <th class="text-left">Test Title</th>
                    <th class="w-12"></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($tests->sortByDesc('created_at') as $test)
                    <tr class="tr">
                        <td>{{ $loop->index + 1 }}</td>
                        <td class="text-left">
                            @if ($test->is_open)
                                <a href="{{ route('admin.tests.show', $test) }}" class="link">{{ $test->title }}</a>
                                <br><span class="text-slate-500 text-xs">Created at:
                                    {{ $test->created_at }}</span>
                            @else
                                {{ $test->title }}
                            @endif
                        </td>
                        <td>
                            @if ($test->is_open)
                                <form action="{{ route('admin.test.lock', $test) }}" method='post'>
                                    @csrf
                                    @method('patch')
                                    <button type="submit"><i class="bi-unlock text-green-500 font-bold"></i></button>
                                </form>
                            @else
                                <form action="{{ route('admin.test.unlock', $test) }}" method='post'>
                                    @csrf
                                    @method('patch')
                                    <button type="submit"><i class="bi-lock text-red-500 font-bold"></i></button>
                                </form>
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
