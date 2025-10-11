@extends('layouts.basic')
@section('header')
<x-header></x-header>
@endsection
@section('body')
<div class="min-h-screen w-screen flex flex-col justify-center items-center">

    <h2 class="text-3xl font-bold mb-4 mt-32 text-center text-gray-800">Meet Our Faculty</h2>

    <div class="text-center mb-8">
        <a href="{{ route('teachers.create') }}"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full transition duration-300 shadow-lg">
            Join as Faculty Member
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 text-center">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 w-4/5 md:w-3/4 mx-auto">
        @forelse($teachers as $teacher)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-shadow duration-300 hover:scale-105 transform p-4 group">
            @if($teacher->photo)
            <img src="{{ asset('storage/' . $teacher->photo) }}" alt="{{ $teacher->name }}"
                class="w-24 h-24 mx-auto rounded-full mb-4 shadow-sm">
            @else
            <div class="w-full h-36 bg-gray-200 flex items-center justify-center rounded-xl mb-4 text-gray-500">
                No Image
            </div>
            @endif

            <h3 class="text-lg font-semibold text-gray-800">{{ $teacher->prefix }} {{ $teacher->name }}</h3>
            <div class="text-xs text-gray-500 mt-3">
                <p><strong>Designation:</strong> {{ $teacher->designation }} (BPS {{ $teacher->bps }})</p>
                <p><strong>Email:</strong> {{ $teacher->user?->email }}</p>
                <p><strong>Phone:</strong> {{ $teacher->personal_phone }}</p>
                <!-- <p class="mt-3"><strong>Home:</strong> {{ $teacher->address }}</p> -->
                <p><strong>Working Since:</strong> {{ $teacher->joined_at->format('d-m-Y') }}</p>
            </div>
        </div>
        @empty
        <p class="col-span-full text-center text-gray-500">No teacher profile yet. Be the first to join!</p>
        @endforelse
    </div>


</div>
@endsection