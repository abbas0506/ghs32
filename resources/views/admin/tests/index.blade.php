@extends('layouts.admin')
@section('page-content')

<h1>Collective Tests</h1>
<div class="bread-crumb">
    <a href="{{url('/')}}">Home</a>
    <div>/</div>
    <div>Tests</div>
</div>


<div class="content-section">
    <div class="flex items-center flex-wrap justify-between">
        <!-- search -->
        <div class="flex relative w-full md:w-1/3">
            <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full" oninput="search(event)">
            <i class="bx bx-search absolute top-2 right-2"></i>
        </div>
        <a href="{{route('admin.tests.create')}}" class="fixed bottom-4 right-4 flex justify-center items-center bg-teal-400 hover:bg-teal-600 hover:cursor-pointer rounded-full w-12 h-12"><i class="bi-plus-lg"></i></a>
    </div>

    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <table class="table-auto borderless w-full mt-3">
        <thead>
            <tr class="">
                <th class="w-16">Sr</th>
                <th class="text-left">Test Title</th>
                <th>Status</th>
                <th class="w-24">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach($tests as $test)
            <tr class="tr">
                <td>{{ $loop->index+1 }}</td>
                <td class="text-left"><a href="{{ route('admin.test.allocations.index', $test) }}" class="link">{{ $test->title }}</a></td>
                <td> @if($test->is_open)
                    <i class="bi-unlock-fill text-green-600"></i>
                    @else
                    <i class="bi-lock-fill text-red-600"></i>
                    @endif
                </td>
                <td>
                    <div class="flex justify-center items-center space-x-3">
                        <a href="{{route('admin.tests.edit', $test)}}">
                            <i class="bx bx-pencil text-green-600"></i>
                        </a>
                        <span class="text-slate-400">|</span>
                        <form action="{{route('admin.tests.destroy',$test)}}" method="POST" id='del_form{{$test->id}}'>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-transparent p-0 border-0" onclick="delme('{{$test->id}}')">
                                <i class="bx bx-trash text-red-600"></i>
                            </button>
                        </form>
                    </div>

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