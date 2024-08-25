@extends('layouts.admission')
@section('page-content')

<div class="custom-container">
    <h1>Sections</h1>
    <div class="bread-crumb">
        <a href="/">Dashboard</a>
        <div>/</div>
        <div>Sections</div>
    </div>

    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

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
                </tr>
            </thead>
            <tbody>
                @foreach($sections->sortBy('grade_id') as $section)
                <tr class="tr text-sm">
                    <td>{{$sr++}}</td>
                    <td>
                        <a href="{{route('admission.sections.show',$section)}}" class="link">{{$section->grade->grade_no}}-{{ $section->name}}</a>
                    </td>
                    <td>{{$section->students->count()}}</td>
                    <td>
                        <a href="{{route('admission.section.students.create',$section)}}" class="text-teal-600 hover:text-teal-800"><i class="bi bi-upload"></i></a>
                    </td>
                    <td>
                        <form action="{{ route('admission.sections.clean', $section) }}" method="post" onsubmit="return confirmClean(event)">
                            @csrf
                            <button><i class="bx bx-recycle text-base text-orange-500"></i></button>
                        </form>

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