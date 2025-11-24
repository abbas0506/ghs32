@extends('layouts.admin')
@section('page-content')
    <div class="custom-container">
        <h1>Attendance</h1>
        <div class="bread-crumb">
            <a href="{{ url('/') }}">Home</a>
            <div>/</div>
            <div>Attendance</div>
        </div>

        <div class="md:w-4/5 mx-auto bg-white md:p-8 p-4 rounded border mt-12">
            <form action="{{ route('admin.attendance.filter') }}" method="POST">
                @csrf
                <input type="date" name="date" class="custom-input">
                <div class="text-right mt-3">
                    <button type="submit" class="btn-blue rounded"><i class="bi-filter"></i> Filter</button>
                </div>
            </form>
        </div>
        <div class="md:w-4/5 mx-auto bg-white md:p-8 p-4 rounded border mt-3">
            <!-- page message -->
            @if ($errors->any())
                <x-message :errors='$errors'></x-message>
            @else
                <x-message></x-message>
            @endif
            <h2><i class="bi-clock mr-3"></i> {{ \Carbon\Carbon::parse($today)->format('d-m-Y') }}</h2>
            <table class="table-auto borderless w-full mt-8">
                <thead>
                    <tr class="tr">
                        <th class="text-left">Class</th>
                        <th class="w-24">Attendance</th>
                        <th class="w-24"></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($sections as $section)
                        <tr class="tr">
                            <td class="text-left"><a
                                    href="{{ route('admin.attendance.show', $section) }}">{{ $section->fullName() }}</a>
                            </td>
                            <td>{{ $section->present_count }} / {{ $section->students->count() }}</td>
                            <td>{{ round(($section->present_count / $section->students->count()) * 100, 1) }} %</td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
