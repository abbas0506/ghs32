@extends('layouts.admin')
@section('page-content')

<div class="custom-container">
    <h1>Teachers</h1>
    <div class="bread-crumb">
        <a href="{{url('admin')}}">Dashoboard</a>
        <div>/</div>
        <div>Teachers</div>
        <div>/</div>
        <div>All</div>
    </div>
    <div class="content-section">
        <label>List of all teachers</label>
        <div class="divider my-3"></div>

        <!-- search -->
        <div class="flex items-center justify-between mt-8">
            <div class="flex relative w-full md:w-1/3">
                <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full" oninput="search(event)">
                <i class="bx bx-search absolute top-2 right-2"></i>
            </div>
            <div class="flex space-x-3">
                <a href="{{route('admin.teachers.create')}}" class="text-sm p-2 border hover:bg-teal-400">New <i class="bi bi-person-add text-teal-600"></i></a>
                <a href="{{route('admin.teachers.import')}}" class="text-sm p-2 border hover:bg-teal-400">Import from Excel <i class="bi bi-file-earmark-excel text-teal-600"></i></a>
            </div>
        </div>

        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <div class="overflow-x-auto w-full mt-8">
            @php $sr=1; @endphp
            <table class="table-fixed w-full">
                <thead>
                    <tr>
                        <th class="w-12">Cnic</th>
                        <th class="w-36">Teacher</th>
                        <th class="w-36">Phone/email</th>
                        <th class="w-12">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teachers as $teacher)
                    <tr class="tr text-sm">

                        <td>{{$sr++}}</td>
                        <td class="text-left pl-3 text-slate-800"><a href="{{route('admin.teachers.show', $teacher)}}" class="link">{{$teacher->name}} </a><br><span class="text-xs text-slate-500">{{$teacher->designation}}, BPS {{$teacher->bps}}</span></td>
                        <td>{{$teacher->phone}}<br><span class="text-xs text-slate-500">{{$teacher->email}}</span></td>
                        <td>
                            <div class="flex items-center justify-center">
                                <a href="{{route('admin.teachers.edit',$teacher)}}"><i class="bx bx-pencil text-green-600"></i></a>
                                <span class="text-slate-300 px-2">|</span>
                                <form action="{{route('admin.teachers.destroy',$teacher)}}" method="post" onsubmit="return confirmDel(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button><i class="bx bx-trash text-red-600"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
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

    function search(event) {
        var searchtext = event.target.value.toLowerCase();
        var str = 0;
        $('.tr').each(function() {
            if (!(
                    $(this).children().eq(0).prop('outerText').toLowerCase().includes(searchtext) ||
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