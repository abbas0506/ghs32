@extends('layouts.teacher')
@section('page-content')
    <h1>Student Attendance</h1>
    <div class="bread-crumb">
        <a href="{{ url('/') }}">Home</a>
        <div>/</div>
        <div>Attendance</div>
    </div>
    <div class="divider my-3"></div>
    <div class="content-section">
        <!-- page message -->
        @if ($errors->any())
            <x-message :errors='$errors'></x-message>
        @else
            <x-message></x-message>
        @endif

        <div class="flex justify-center items-center mt-12">

            <form action="{{ route('teacher.attendance.store') }}" method="post">
                @csrf
                <button type="submit" class="btn-blue px-8 py-3 rounded">Start Attendace</button>
            </form>


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
        </script>
    @endsection
