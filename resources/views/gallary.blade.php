@extends('layouts.basic')

@section('header')
<x-header></x-header>
@endsection
@section('body')
<!-- <div class="text-center bg-sky-100 text-sm py-1">(+92 42) 99233106-7</div> -->
<section id='page_title' class="pt-32 pb-8 bg-app text-orange-200">
    <div class="section-title text-center">
        Gallary
    </div>
</section>
<section class="">

    <div class="mt-5 md:mt-16 md:w-1/2 flex justify-center items-center mx-auto relative">
        <div class="slider-container">
            <div class="slides">
                <img src="{{asset('images/events/event-000.png')}}" alt="Image 1" class="w-96 h-64">
                <img src="{{asset('images/events/event-001.png')}}" alt="Image 1" class="w-96 h-64">
                <img src="{{asset('images/events/event-004.png')}}" alt="Image 2" class="w-96 h-64">
                <img src="{{asset('images/events/event-005.png')}}" alt="Image 3" class="w-96 h-64">
                <!-- Add more images as needed -->
                <img src="{{asset('images/events/event-006.png')}}" alt="Image 1" class="w-96 h-64">
                <img src="{{asset('images/events/event-007.png')}}" alt="Image 2" class="w-96 h-64">
                <img src="{{asset('images/events/event-008.png')}}" alt="Image 3" class="w-96 h-64">

                <img src="{{asset('images/events/event-010.png')}}" alt="Image 3" class="w-96 h-64">
                <img src="{{asset('images/events/event-011.png')}}" alt="Image 3" class="w-96 h-64">
                <img src="{{asset('images/events/event-012.png')}}" alt="Image 3" class="w-96 h-64">
                <!-- Add more images as needed -->
            </div>
        </div>
        <button class="prev absolute top-1/2 transform -translate-y-1/2 left-4 bg-white p-2 rounded-full shadow-md text-gray-600" onclick="changeSlide(-1)">❮</button>
        <button class="next absolute top-1/2 transform -translate-y-1/2 right-4 bg-white p-2 rounded-full shadow-md text-gray-600" onclick="changeSlide(1)">❯</button>
    </div>
    </div>

</section>
<!-- footer -->
<x-footer></x-footer>
@endsection

@section('script')
<script>
    let slideIndex = 0;
    const slides = document.querySelectorAll('.slides img');
    const totalSlides = slides.length;

    function changeSlide(n) {
        slideIndex += n;
        if (slideIndex >= totalSlides) {
            slideIndex = 0;
        } else if (slideIndex < 0) {
            slideIndex = totalSlides - 1;
        }
        updateSlides();
    }

    function updateSlides() {
        slides.forEach((slide, index) => {
            if (index === slideIndex) {
                slide.classList.remove('hidden');
            } else {
                slide.classList.add('hidden');
            }
        });
    }

    updateSlides();
</script>
@endsection