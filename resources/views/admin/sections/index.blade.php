@extends('layouts.admin')
@section('page-content')

<div class="custom-container">
    <h1>Sections</h1>
    <div class="bread-crumb">
        <a href="/">Dashboard</a>
        <div>/</div>
        <div>Sections</div>
        <div>/</div>
        <div>All</div>
    </div>

    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <!-- search -->
    <div class="flex items-center justify-between mt-8">
        <div class="flex relative w-full md:w-1/3">
            <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full" oninput="search(event)">
            <i class="bx bx-search absolute top-2 right-2"></i>
        </div>
        <a href="{{route('admin.sections.create')}}" class="text-sm p-2 btn-teal rounded">Add New Class <i class="bi bi-plus"></i></a>
    </div>

    @php $sr=1; @endphp
    <div class="overflow-x-auto w-full mt-8">

        <table class="table-fixed w-full">
            <thead>
                <tr>
                    <th class="w-12">Sr</th>
                    <th class="w-40">Class</th>
                    <th class="w-12"><i class="bi-people-fill"></i></th>
                    <th class="w-12">Import</th>
                    <th class="w-12">Clean</th>
                    <th class="w-12">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sections->sortBy('grade_id') as $section)
                <tr class="tr text-sm">
                    <td>{{$sr++}}</td>
                    <td>
                        <a href="{{route('admin.section.students.index',$section)}}" class="link">{{$section->grade->grade_no}}-{{ $section->name}}</a>
                    </td>
                    <td>{{$section->students->count()}}</td>
                    <td><a href="{{url('admin/students/import',$section)}}" class="link"><i class="bi bi-file-earmark-excel text-teal-600"></i></a></td>
                    <td>
                        <form action="{{ route('admin.sections.clean', $section) }}" method="post" onsubmit="return confirmClean(event)">
                            @csrf
                            <button><i class="bx bx-recycle text-base text-orange-500"></i></button>
                        </form>

                    </td>

                    <td>
                        <div class="flex items-center justify-center">
                            <a href="{{route('admin.sections.edit',$section)}}"><i class="bx bx-pencil text-green-600"></i></a>
                            <span class="text-slate-300 px-2">|</span>
                            <form action="{{route('admin.sections.destroy',$section)}}" method="post" onsubmit="return confirmDel(event)">
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

    function confirmClean(event) {
        event.preventDefault(); // prevent form submit
        var form = event.target; // storing the form

        Swal.fire({
            title: 'Are you sure?',
            text: "You are going to clean this class!",
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