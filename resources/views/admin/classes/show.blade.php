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
        <a href="{{url('admin/students/import',$clas)}}" class="text-sm p-2 border hover:bg-teal-50">Import from Excel <i class="bi bi-file-earmark-excel text-teal-600"></i></a>
    </div>

    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <div class="overflow-x-auto w-full mt-8">

        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="w-10">Roll No</th>
                    <th class="w-40">Name</th>
                    <th class="w-40">Father</th>
                    <th class="w-24">BForm</th>
                    <th class="w-16">Phone</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clas->students as $student)
                <tr class="tr text-sm">
                    <td>
                        <a href="{{route('admin.students.show', $student)}}" class="link">
                            {{$student->rollno}}
                        </a>
                    </td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->father}}</td>
                    <td>{{$student->cnic}}</td>
                    <td>{{$student->phone}}</td>
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