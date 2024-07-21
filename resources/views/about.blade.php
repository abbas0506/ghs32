@extends('layouts.basic')

@section('header')
<x-header></x-header>
@endsection
@section('body')
<!-- <div class="text-center bg-sky-100 text-sm py-1">(+92 42) 99233106-7</div> -->
<section id='page_title' class="pt-32 pb-8 bg-app text-orange-200">
    <div class="section-title text-center">
        About Us
    </div>
</section>
<section class="">

    <div class="grid md:grid-cols-2 mt-16">
        <div class="flex justify-center items-center">
            <img src="{{url('images/bg/office.png')}}" alt="sat" class="h-80" alt="">
        </div>
        <div class="block w-full p-5 md:px-12 text-justify text-lg leading-relaxed">
            Govt Higher Secondary School Chak Bedi is a public sector institute situated in Chak Bedi, near by Kasur Multan Road, 23 km away from Shehr-e-Fareed, Pakpattan.
            People choose us because of our quality education from primary to higher secondary level, ease of access and so many other reasons.
            We offer science and arts education from grades 9 to 12 and prepare our students for their future challanges.
            We focus on their personal development and help them become a successful citizen of pakistan
        </div>
    </div>
</section>
<section class="mt-16">
    <div class="bg-slate-200 p-5 md:p-16 grid grid-cols-2 md:grid-cols-4 gap-5">
        <div class="text-center">
            <p class="text-2xl md:text-4xl">1500+</p>
            <p>Students</p>
        </div>
        <div class="text-center">
            <p class="text-2xl md:text-4xl">40+</p>
            <p>Teachers</p>
        </div>
        <div class="text-center">
            <p class="text-2xl md:text-4xl">5</p>
            <p>Practical Labs</p>
        </div>
        <div class="text-center">
            <p class="text-2xl md:text-4xl">1000+</p>
            <p>Library Books</p>
        </div>
    </div>
</section>
<!-- footer -->
<x-footer></x-footer>
@endsection

@section('script')