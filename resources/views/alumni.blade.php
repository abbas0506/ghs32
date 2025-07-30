@extends('layouts.basic')
@section('header')
<x-header></x-header>
@endsection
@section('body')
<div class="min-h-screen w-screen flex flex-col justify-center items-center">

    <h2 class="text-3xl font-bold mb-4 text-center text-gray-800">Meet Our Alumni</h2>

    <div class="text-center mb-8">
        <a href="{{ route('alumni.create') }}"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full transition duration-300 shadow-lg">
            🎓 Join as Alumni
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 text-center">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($alumni as $a)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-shadow duration-300 hover:scale-105 transform p-4 group">
            @if($a->photo)
            <img src="{{ asset('storage/' . $a->photo) }}" alt="{{ $a->name }}"
                class="w-full h-48 object-cover rounded-xl mb-4 shadow-sm">
            @else
            <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-xl mb-4 text-gray-500">
                No Image
            </div>
            @endif

            <h3 class="text-xl font-semibold text-gray-800">{{ $a->prefix }} {{ $a->name }}</h3>
            <p class="text-sm text-gray-600"><strong>Job:</strong> {{ $a->job_desc }}</p>
            <p class="text-sm text-gray-600"><strong>Email:</strong> {{ $a->email }}</p>
            <p class="text-sm text-gray-600"><strong>Phone:</strong> {{ $a->phone }}</p>

            <div class="text-xs text-gray-500 mt-3">
                <p><strong>Home:</strong> {{ $a->home_address }}</p>
                <p><strong>Office:</strong> {{ $a->office_address }}</p>
            </div>
        </div>
        @empty
        <p class="col-span-full text-center text-gray-500">No alumni profiles yet. Be the first to join!</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $alumni->links() }}
    </div>
</div>
@endsection