@extends('layouts.admin')
@section('page-content')

<div class="custom-container">
    <h1>{{$clas->roman()}}</h1>
    <div class="bread-crumb">
        <a href="{{url('admin')}}">Dashoboard</a>
        <div>/</div>
        <a href="{{route('admin.classes.index')}}">Classes</a>
        <div>/</div>
        <div>{{$clas->roman()}}</div>
    </div>

    <!-- search -->
    <div class="flex items-center justify-between mt-12">
        <div class="flex relative w-full md:w-1/3">
            <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full" oninput="search(event)">
            <i class="bx bx-search absolute top-2 right-2"></i>
        </div>
        <div class="flex space-x-3">
            <a href="{{route('admin.class.students.create', $clas)}}" class="text-sm p-2 border hover:bg-teal-400">New <i class="bi bi-person-add text-teal-600"></i></a>
            <a href="{{url('admin/students/import',$clas)}}" class="text-sm p-2 border hover:bg-teal-50">Import from Excel <i class="bi bi-file-earmark-excel text-teal-600"></i></a>
            <form action="{{ route('admin.classes.clean', $clas) }}" method="post" onsubmit="return confirmClean(event)">
                @csrf
                <button class="btn-orange rounded"><i class="bx bx-recycle text-base"></i></button>
            </form>
        </div>

    </div>

    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <div class="overflow-x-auto bg-white w-full mt-8">

        <table class="table-auto borderless w-full">
            <thead>
                <tr>
                    <th class="w-10">Roll No</th>
                    <th class="w-40 text-left">Name</th>
                    <th class="w-24">BForm</th>
                    <th class="w-24">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clas->students as $student)
                <tr class="tr">
                    <td>{{$student->rollno}}</td>
                    <td class="text-left"><a href="{{route('admin.class.students.show', [$clas, $student])}}" class="link">{{$student->name}}</a></td>
                    <td>{{$student->cnic}}</td>
                    <td>
                        <div class="flex items-center justify-center">
                            <a href="{{route('admin.class.students.edit',[$clas, $student])}}"><i class="bx bx-pencil text-green-600"></i></a>
                            <span class="text-slate-300 px-2">|</span>
                            <form action="{{route('admin.class.students.destroy',[$clas, $student])}}" method="post" onsubmit="return confirmDel(event)">
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