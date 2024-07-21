@extends('layouts.admin')
@section('page-content')
<div class="custom-container">

    <h2>Teachers / Profile</h2>

    <div class="content-section relative">
        <a href="{{ route('admin.teachers.index') }}" class="absolute top-2 right-2 p-2 hover:bg-slate-200 rounded"><i class="bi-x-lg"></i></a>

        <h2 class="">{{ $teacher->name }}</h2>
        <label>{{$teacher->designation}}, BPS {{$teacher->bps}}</label>
        <div class="divider my-3"></div>

        <div class="grid grid-cols-1 md:grid-cols-3 mt-8">

            <div class="col-span-2 p-4">
                <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-sm">

                    <label for="">CNIC</label>
                    <div>{{$teacher->cnic}}</div>

                    <label for="">Phone</label>
                    <div>{{$teacher->phone}}</div>

                    <label for="">Email</label>
                    <div>{{$teacher->email}}</div>

                    <label for="">Qualification</label>
                    <div>{{$teacher->qualification}}</div>

                </div>
            </div>
            <div class="flex justify-center items-center border p-4">
                {!! DNS2D::getBarcodeHTML($teacher->cnic, 'QRCODE',4,4) !!}
            </div>
        </div>
    </div>
</div>
@endsection