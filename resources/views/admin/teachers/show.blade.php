@extends('layouts.admin')
@section('page-content')
<h1>View Teacher</h1>
<div class="flex items-center">
    <div class="flex-1">
        <div class="bread-crumb">
            <a href="{{ url('/') }}">Dashboard</a>
            <div>/</div>
            <a href="{{ route('admin.teachers.index') }}">Teachers</a>
            <div>/</div>
            <div>{{ $teacher->id }}</div>
        </div>
    </div>
</div>
<div class="content-section relative mt-12">

    <div class="absolute top-2 right-2">
        <div class="flex items-center justify-center space-x-2">
            <div class="flex w-8 h-8 rounded-full border justify-center items-center">
                <form action="{{route('admin.teachers.destroy',$teacher)}}" method="post" onsubmit="return confirmDel(event)">
                    @csrf
                    @method('DELETE')
                    <button><i class="bx bx-trash text-red-600"></i></button>
                </form>
            </div>
            <div class="flex w-8 h-8 rounded-full border justify-center items-center">
                <a href="{{route('admin.teachers.edit',$teacher)}}"><i class="bx bx-pencil text-green-600"></i></a>
            </div>
            <div class="flex w-8 h-8 rounded-full border justify-center items-center">
                <a href="{{ route('admin.teachers.index')}}"><i class="bi-x-lg"></i></a>
            </div>
        </div>
    </div>

    <h2 class="p-4 border border-dashed border-slate-200">{{ $teacher->name }} ({{ $teacher->designation }})</h2>

    <!-- display info -->
    <div class="grid md:grid-cols-3 mt-8 gap-4">
        <div class="grid md:col-span-2 gap-3 order-2 md:order-1">
            <div>
                <label for="">Personal # </label>
                <div class="flex flex-wrap items-center gap-x-4">
                    <h2>{{ $teacher->personal_number }}</h2>

                </div>
            </div>
            <div>
                <label for="">Personal Info</label>
                <p>{{ $teacher->name }} s/o {{ $teacher->father_name }}</p>
                <p class="text-slate-600 text-sm"><i class="bi-balloon"></i>{{ $teacher->dob }} <i class="bi-card-heading ml-2"></i> {{ $teacher->cnic }} </p>
                <p><i class="bi-telephone ml-2"></i> {{ $teacher->personal_phone }} <i class="bi-at"></i>{{ $teacher->user?->email }}</p>
                <p class="text-slate-600 text-sm">{{ $teacher->address }} </p>
            </div>

            <div>
                <label for="">Academic Info</label>
                <p class="text-slate-600 text-sm"><i class="bi-layers"></i>{{ $teacher->qualification }} <i class="bi-layers ml-2"></i> {{ $teacher->designation }}({{ $teacher->bps }}), {{ $teacher->joined_at }}</p>
                <p class="text-slate-600 text-sm">{{ $teacher->address }} </p>
            </div>

        </div>
        <div class="order-1 md:order-2">
            <div>
                <img src="{{ asset('storage/' . $teacher->photo) }}" alt="Student Photo" width="100" height="100">
            </div>
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