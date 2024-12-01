@extends('layouts.admission')

@section('page-content')
<div class="custom-container">
    <!-- Title     -->
    <h1>Applications</h1>
    <div class="flex items-center">
        <div class="flex-1">
            <div class="bread-crumb">
                <a href="{{ url('/') }}">Dashboard</a>
                <div>/</div>
                <div>Application # {{ $application->rollno }}</div>
                <div>/</div>
                <div>Edit</div>
            </div>
        </div>
        <div class="text-slate-500">{{ today()->format('d/m/Y') }}</div>
    </div>
    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <form action="{{route('admission.applications.update', $application)}}" method="post" class="mt-8">
        @csrf
        @method('PATCH')

        <!-- student info -->
        <div class="grid md:grid-cols-3 gap-4 mt-8">
            <div>
                <label for="">Group</label>
                <select name="group_id" class="custom-input">
                    @foreach($groups as $group)
                    <option value="{{ $group->id }}" @selected($group->id == $application->group_id)>{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="">
                <label for="">Passing Year</label>
                <select name="pass_year" id="" class="custom-input">
                    <option value="2022" @selected($application->pass_year==2022)>2022</option>
                    <option value="2023" @selected($application->pass_year==2023)>2023</option>
                    <option value="2024" @selected($application->pass_year==2024)>2024</option>
                </select>
            </div>
            <div class="md:col-span-3">
                <label for="">Student Name (as per matric certificate)</label>
                <input type="text" name="name" class="custom-input" placeholder="Student name" value="{{ $application->name }}">
            </div>
            <div class="">
                <label for="">Father name</label>
                <input type="text" name="father" class="custom-input" placeholder="Father name" value="{{ $application->father }}">
            </div>
            <div>
                <label for="">BForm</label>
                <input type="text" name="bform" class="custom-input" placeholder="B Form" value="{{ $application->bform }}">
            </div>
            <div>
                <label for="">Phone No</label>
                <input type="text" name="phone" class="custom-input" placeholder="Phone No." value="{{ $application->phone }}">
            </div>
            <div>
                <label for="">Board Name</label>
                <select name="bise_name" id="" class="custom-input">
                    <option value="sahiwal" @selected($application->bise_name=='sahiwal')>Sahiwal Board</option>
                    <option value="other" @selected($application->bise_name=='other')>Other Board</option>
                </select>
            </div>
            <div>
                <label for="">Matric Roll No.</label>
                <input type="number" name="rollno" class="custom-input" placeholder="Roll number" min='0' value="{{ $application->rollno }}">
            </div>
            <div>
                <label for="">Obtanied Marks</label>
                <input type="number" name="obtained" class="custom-input" placeholder="Obtained marks" min='0' value="{{ $application->obtained }}">
            </div>
            <div>
                <label for="">Total Marks</label>
                <select name="total" id="" class="custom-input">
                    <option value="1100" @selected($application->total==1100)>1100</option>
                    <option value="1200" @selected($application->total==1200)>1200</option>
                </select>
            </div>
            <div>
                <label for="">Fee</label>
                <p>{{ $application->fee_paid }} <a href="{{ route('admission.fee.edit', $application) }}" class="ml-2 btn-teal rounded">edit<i class="bx bx-pencil ml-2"></i></a></p>
            </div>
            <div class="md:col-span-3">
                <label for="">Objection</label>
                <input type="text" name="objection" class="custom-input" placeholder="Objection" value="{{ $application->objection }}">
            </div>

        </div>
        <div class="text-center mt-8">
            <button class="btn-teal rounded py-3">Update Application</button>
        </div>
    </form>
</div>

@endsection