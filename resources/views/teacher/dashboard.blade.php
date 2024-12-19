@extends('layouts.teacher')
@section('page-content')
<!--welcome  -->
<div class="flex items-center">
    <div class="flex-1">
        <div class="bread-crumb">
            <div>Teacher</div>
            <div>/</div>
            <div>Dashbaord</div>
        </div>
    </div>
    <label class="text-slate-500">{{ today()->format('d/m/Y') }}</label>
</div>

<!-- pallets -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
    <a href="{{ route('teacher.tests.index') }}" class="pallet-box bg-gradient-to-r from-teal-100 to-white ">
        <div class="flex-1">
            <h3>Collective Tests</h3>
            <p class="text-sm text-slate-600 font-thin">Pendency:
                @if (Auth::user()->testAllocations()->active()->count())
                {{100-round(Auth::user()->testAllocations()->combined()->active()->resultSubmitted()->count()/Auth::user()->testAllocations()->combined()->active()->count()*100,0)}} %
                @else
                -
                @endif

            </p>
        </div>
        <div class="ico bg-teal-100 text-teal-600">
            {{ $tests->whereNull('user_id')->where('is_open', true)->count() }}
        </div>
    </a>
    <a href="#" class="pallet-box bg-gradient-to-r from-indigo-100 to-white">
        <div class="flex-1">
            <h3>Individual Tests</h3>
            <p class="text-sm text-slate-600 font-thin">Pendency: -</p>
        </div>
        <div class="ico bg-indigo-100 text-indigo-400">
            {{ Auth::user()->tests()->individual()->count() }}
        </div>
    </a>

</div>

<div class="grid w-full p-5 bg-gradient-to-b  from-sky-100 to-white border border-sky-200 rounded-lg text-xs md:text-sm mt-8">
    <h2 class="text-left">Please Note</h2>
    <p class="text-left">Result submission requires following 6-steps process: </p>
    <ul class="pl-5 list-roman leading-relaxed ">
        <li>Select test type: combined or individual</li>
        <li>Open the selected test and review your subjects </li>
        <li>Open each subject and import the students list</li>
        <li>After successful import, feed the result </li>
        <li>Ensure total marks are updated correctly</li>
        <li>Once all data is entered and reviewed, submit the final results</li>
    </ul>

</div>

@endsection