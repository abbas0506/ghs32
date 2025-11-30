@extends('layouts.teacher')
@section('page-content')
    <h1>{{ $student->name }} </h1>
    <!-- display info -->
    <div class="md:w-4/5 mx-auto bg-white md:p-8 p-4 rounded border mt-12 relative">
        <div class="absolute top-2 right-2">
            <div class="flex items-center justify-center space-x-2">
                <div class="flex w-8 h-8 rounded-full border justify-center items-center">
                    <a href="{{ route('teacher.students.edit', $student) }}"><i class="bx bx-pencil text-green-600"></i></a>
                </div>
                <div class="flex w-8 h-8 rounded-full border justify-center items-center">
                    <a href="{{ route('teacher.students.index') }}"><i class="bi-x-lg"></i></a>
                </div>
            </div>
        </div>
        <div class="grid md:col-span-2 gap-3 order-2 md:order-1">
            <div>
                <label for="">Admission # </label>
                <div class="flex flex-wrap items-center gap-x-4">
                    <h2>{{ $student->admission_no }}</h2>
                </div>
            </div>
            <div>
                <label for="">Personal Info</label>
                <p>{{ $student->name }}</p>
                <p class="text-slate-600 text-sm">{{ $student->dob?->format('d-m-Y') }}</p>
                <p class="text-slate-600 text-sm"> {{ $student->bform }} </p>
                <p class="text-slate-600 text-sm">{{ $student->phone }}</p>
                <p class="text-slate-600 text-sm">{{ $student->id_mark }} </p>
                <p class="text-slate-600 text-sm">{{ $student->address }} </p>
            </div>
            <div>
                <label for="">Father / Guardian Info</label>
                <p>{{ $student->father_name }} </p>
                <p class="text-slate-600 text-sm">{{ $student->father_cnic }} </p>
                <p class="text-slate-600 text-sm">{{ $student->caste }} / {{ $student->profession }} </p>
                <p class="text-slate-600 text-sm"><i class="bi-currency"></i>{{ $student->income }} </p>
            </div>
        </div>
        <div class="order-1 md:order-2">
            <div>
                <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo" width="100" height="100">
            </div>
        </div>
    </div>
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
    </script>
@endsection
