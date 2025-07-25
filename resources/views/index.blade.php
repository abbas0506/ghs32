@extends('layouts.basic')

@section('header')
<x-header></x-header>
@endsection

@section('body')
<!-- Bootstrap Icons CDN -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet"> -->

<!-- Bootstrap Icons CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    /* Container holds both button and floating pointer */
    .button-container {
        position: relative;
        display: inline-block;
    }

    /* Button styling */
    .click-demo-button {
        padding: 1rem 2.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        color: #0d9488;
        background-color: transparent;
        border: 2px solid #0d9488;
        border-radius: 9999px;
        cursor: pointer;
        overflow: hidden;
        transition: background-color 0.3s ease;
        position: relative;
        z-index: 1;
    }

    .click-demo-button:hover {
        background-color: rgba(13, 148, 136, 0.1);
    }

    /* Pointer icon absolutely positioned OVER the button */
    .pointer-icon {
        position: absolute;
        font-size: 24px;
        color: #0d9488;
        opacity: 0;
        z-index: 10;
        animation: flyClick 3s ease-in-out infinite;

        left: 100%;
        top: 100%;
        transform: rotate(-90deg);
    }

    @keyframes flyClick {
        0% {
            opacity: 0;
            transform: translate(40px, 40px) rotate(-90deg);
        }

        20% {
            opacity: 1;
            transform: translate(-300%, -100%) rotate(-90deg);
        }

        40% {
            transform: translate(-300%, -100%) scale(0.9) rotate(-90deg);
        }

        45% {
            transform: translate(-300%, -100%) scale(1) rotate(-90deg);
        }

        50% {
            transform: translate(-300%, -100%) scale(0.9) rotate(-90deg);
        }

        55% {
            transform: translate(-300%, -100%) scale(1) rotate(-90deg);
        }

        80% {
            opacity: 1;
        }

        100% {
            opacity: 0;
            transform: translate(40px, 40px) rotate(-90deg);
        }
    }
</style>

<!-- page message -->
@if($errors->any())
<x-message :errors='$errors'></x-message>
@else
<x-message></x-message>
@endif

<section class="w-screen h-screen">
    <div class="flex flex-col md:flex-row-reverse justify-between items-center px-5 md:px-24 h-full py-16">
        <div class="flex flex-1 justify-end items-center">
            <img src="{{ url(asset('images/small/admission-2.png')) }}" alt="student" class="w-40 h-40 md:w-96 md:h-96">

        </div>

        <div class="flex flex-col flex-1 gap-y-2 justify-center">
            <p>2025</p>
            <h2 class="text-2xl md:text-4xl font-bold">Admission Open</h2>
            <p class="text-slate-600 text-sm md:text-lg leading-relaxed mt-4">We are thrilled to welcome ambitious students to our dynamic academic journey, proudly offering FA, Pre-Engineering, and ICS programs.</p>
            <a href="{{ url('admission-25')}}">
                <div class="button-container">
                    <button class="click-demo-button click-demo-button mt-5 rounded py-0 px-5">
                        Join Us
                    </button>
                    <i class="bi bi-cursor-fill pointer-icon"></i>

                </div>
            </a>
        </div>

    </div>
</section>
<section class="w-screen h-screen">
    <div class="flex flex-col md:flex-row-reverse justify-between items-center px-5 md:px-24 h-full pt-16">
        <div class="flex flex-1 justify-end items-center">
            <img src="{{ url(asset('images/small/world.png')) }}" alt="student" class="w-48 h-48 md:w-96 md:h-96">

        </div>

        <div class="flex flex-col flex-1 gap-y-2 justify-center">
            <p>Explore</p>
            <h2 class="text-2xl md:text-4xl font-bold">OUR LIBRARY</h2>
            <p class="text-slate-600 text-sm md:text-lg leading-relaxed mt-4">We have established a state-of-the-art library, fully managed by a web-based application. It consists of 1000+ books from various domains like religion, science, history, literature, and more. </p>
            <a href="">
                <button class="btn-teal mt-5 rounded py-2">Start Exploring <i class="bi-arrow-right"></i></button>
            </a>
        </div>

    </div>
</section>
<section class="mt-5 md:mt-0">
    <div class="flex justify-center w-full bg-teal-100">
        <div class="flex flex-col md:flex-row items-center p-5 md:p-16">
            <div class="w-1/3 grid place-items-center">
                <img src="{{ url('images/small/paper-0.png') }}" alt="test" class="w-32">
            </div>
            <div class="">
                <h3 class="text-xl md:text-2xl">Self Assessment</h3>
                <p class="text-sm md:text-lg mt-1">Self assessment improves your underdtanding about the subject, helps you identify your deficiency areas and gauage your performance. We offer self assement from grade 9 to 12 </p>
                <div class="mt-6">
                    <a href="{{ url('https://www.exampixel.com/') }}" target="_blank" class="bg-teal-600 hover:bg-teal-800 text-slate-100 rounded-full duration-200 px-6 py-2">
                        Start Self Testing
                    </a>
                </div>

            </div>



        </div>

    </div>
</section>
<!-- features section -->
<section id='features' class="md:mt-24 px-4 md:px-24 mt-12">
    <h2 class="text-2xl md:text-4xl text-center">WELCOME TO</h2>
    <p class="text-center text-sm md:text-lg mt-3">Govt Higher Secondary School Chak Bedi, Pakpattan</p>
    <div class="h-1 w-24 bg-teal-800 mx-auto mt-6"></div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
        <div class="feature-box hover:border-pink-300 hover:bg-pink-50">
            <div class="flex items-center justify-center bg-pink-100 rounded-full w-16 h-16">
                <i class="bi-book text-2xl text-pink-400"></i>
            </div>
            <h3 class="mt-3 text-lg">Free Education</h3>
            <p class="text-sm text-center">We provide free education as per govt policy from nursery to 12<sup>th</sup> class.</p>
        </div>

        <div class="feature-box hover:border-orange-300 hover:bg-orange-50">
            <div class="flex items-center justify-center bg-orange-100 rounded-full w-16 h-16">
                <i class="bi-laptop text-2xl text-orange-400"></i>
            </div>
            <h3 class="mt-3 text-lg">N. Computing IT Lab</h3>
            <p class="text-sm text-center">Students learn basic IT skills using state of art NComputing lab. </p>
        </div>

        <div class="feature-box hover:border-cyan-200 hover:bg-cyan-50">
            <div class="flex items-center justify-center bg-cyan-100 rounded-full w-16 h-16">
                <i class="bi bi-palette text-2xl text-cyan-400"></i>
            </div>
            <h3 class="mt-3 text-lg">Practical Labs</h3>
            <p class="text-sm text-center">We have well equipped pratcical labs of all core science subjects.</p>
        </div>

        <div class="feature-box hover:border-green-200 hover:bg-green-50">
            <div class="flex items-center justify-center bg-green-100 rounded-full w-16 h-16">
                <i class="bx bx-run text-2xl text-green-400"></i>
            </div>
            <h3 class="mt-3 text-lg">Vast Playgrounds</h3>
            <p class="text-sm text-center">Vast playgrounds of hockey, footbal, cricket are always open to students.</p>
        </div>

        <div class="feature-box hover:border-indigo-200 hover:bg-indigo-50">
            <div class="flex items-center justify-center bg-indigo-100 rounded-full w-16 h-16">
                <i class="bi bi-palette text-2xl text-indigo-400"></i>
            </div>
            <h3 class="mt-3 text-lg">Quiz Competitions</h3>
            <p class="text-sm text-center">We conduct vairous competitions to promote our students' inner talent.</p>
        </div>
        <div class="feature-box hover:border-rose-200 hover:bg-rose-50">
            <div class="flex items-center justify-center bg-rose-100 rounded-full w-16 h-16">
                <i class="bx bx-run text-2xl text-rose-400"></i>
            </div>
            <h3 class="mt-3 text-lg">Day Celebrations</h3>
            <p class="text-sm text-center">We celebrate various days like national heroes, culture day, etc. </p>
        </div>
    </div>
</section>

<!-- distinction -->
<section>
    <div class="mt-24 bg-slate-100">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-4 md:p-8">
            <div class="flex flex-1">
                <img src="{{url('images/sports/trophy.png')}}" alt="sat" class="">
            </div>
            <div class="flex flex-col flex-1 md:text-base text-sm">
                <h2 class="text-xl">Our Achievements</h2>
                <ul class="flex mt-3">
                    <li><i class="bi-check2-circle pr-3"></i></li>
                    <li> All Punjab Qirat Competition Winner</li>
                </ul>
                <ul class="flex mt-3">
                    <li><i class="bi-check2-circle pr-3"></i></li>
                    <li>Hockey Champion 2022-23, Sahiwal Division</li>
                </ul>
                <ul class="flex mt-3">
                    <li><i class="bi-check2-circle pr-3"></i></li>
                    <li> Hockey Runner Up 2023-24, Sahiwal Division</li>
                </ul>
                <ul class="flex mt-3">
                    <li><i class="bi-check2-circle pr-3"></i></li>
                    <li>Speech Competition Winner 2023-24, District Level</li>
                </ul>

            </div>
        </div>
    </div>
</section>

<section class="pt-0" data-aos="fade-up">
    <div class="mt-24 px-4 md:px-16 md:w-3/4 mx-auto">
        <h2 class="text-4xl text-center">Message</h2>
        <div class="h-1 w-24 bg-teal-800 mx-auto mt-6"></div>
    </div>
    <div class="w-full md:w-3/4 mx-auto mt-12">
        <div class="flex justify-center items-center flex-col">
            <img src="{{asset('images/principal/muzammil.png')}}" class="w-64 rounded-full" alt="">
            <h2 class="mt-3">Muzammil Hussain SS(Chemistry)</h2>
            <h2>Principal</h2>
            <p class="mt-3 text-sm md:text-lg text-center">
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                "We are committed to achieve academic excellence, character education, and inclusive community engagement. we empower our students to become lifelong learners, compassionate leaders, and contributors to a globally connected society."
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
        </div>


    </div>


</section><!-- End Ttstimonials Section -->



<section id='key_features' class="mt-12 md:mt-24 px-4 md:px-24">
    <div class="md:w-3/4 mx-auto">
        <h2 class="text-2xl md:text-4xl text-center">Key Features</h2>
        <p class="text-gray-600 text-center mt-8 text-sm md:text-lg">
            We have highly skilled and qualified teaching staff who consistently demonstrate a passion for fostering student growth through innovative teaching methods and personalized support
        </p>
        <div class="h-1 w-24 bg-teal-800 mx-auto mt-6"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 place-items-center gap-y-6 mt-16 w-full justify-between">
        <div class="bg-teal-100 p-5">
            <h2 class="text-2xl text-slate-800">Planned Testing</h2>
            <p class="mt-3 text-slate-600 leading-relaxed">We conduct well planned series of tests in order to get our students ready for their final exams. Our online assessment system also helps specially the brilliant students to perform their self assessment and identify their deficiencies properly.</p>
        </div>
        <div class="">
            <img src="{{asset('images/sports/shield.png')}}" alt="" class="md:w-3/4 md:float-right">
        </div>
        <div class="">
            <img src="{{asset('images/library/library-1.png')}}" alt="" class="md:w-3/4 md:float-left">
        </div>
        <div class="bg-teal-100 p-5">
            <h2 class="text-2xl text-slate-800">Books Library</h2>
            <p class="mt-3 text-slate-600 leading-relaxed">
                We have established a state-of-the-art library, fully managed by a web-based application. It consists of 1000+ books from various domains like religion, science, history, literature, and more. Students can find their desired books using our web application.
            </p>
        </div>
        <div class="bg-teal-100 p-5">
            <h2 class="text-2xl text-slate-800">Character Building</h2>
            <p class="mt-3 text-slate-600 leading-relaxed">
                We pay special focus on the social development of our students. We provide healthy environment where student grow to become morally good citizens.
                We show them the right way that can lead to their destination.
            </p>
        </div>
        <div class="">
            <img src="{{asset('images/events/prayer.png')}}" alt="" class="md:w-3/4 md:float-right">
        </div>

    </div>

</section>


<section id='events' class="mt-12 md:mt-16 px-4 md:px-24">
    <!-- section title -->
    <h2 class="text-4xl text-slate-800 text-center">Recent Events</h2>
    <div class="h-1 w-24 bg-teal-800 mx-auto mt-6"></div>

    <div class="bg-slate-100 mt-12 p-6">
        <p class="italic text-center text-xl">We arrange wonderful and supportive events full of knowledge and experience for students and professionals. We are very concerned about enhancing our professional capacities.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 mt-12">
            <div class="flex flex-1">
                <div class="relative">
                    <div class="slider-container">
                        <div class="slides">
                            <img src="{{asset('images/events/event-001.png')}}" alt="Image 1" class="w-96 h-64">
                            <img src="{{asset('images/events/event-004.png')}}" alt="Image 2" class="w-96 h-64">
                            <!-- <img src="{{asset('images/events/event-005.png')}}" alt="Image 3" class="w-96 h-64"> -->
                            <!-- Add more images as needed -->
                            <img src="{{asset('images/events/event-006.png')}}" alt="Image 1" class="w-96 h-64">
                            <img src="{{asset('images/events/event-007.png')}}" alt="Image 2" class="w-96 h-64">
                            <img src="{{asset('images/events/event-010.png')}}" alt="Image 3" class="w-96 h-64">
                            <img src="{{asset('images/events/event-013.png')}}" alt="Image 3" class="w-96 h-64">
                            <!-- Add more images as needed -->
                        </div>
                    </div>
                    <button class="prev absolute top-1/2 transform -translate-y-1/2 left-4 bg-white p-2 rounded-full shadow-md text-gray-600" onclick="changeSlide(-1)">❮</button>
                    <button class="next absolute top-1/2 transform -translate-y-1/2 right-4 bg-white p-2 rounded-full shadow-md text-gray-600" onclick="changeSlide(1)">❯</button>
                </div>
            </div>

            <div class="flex flex-col flex-1">
                <h2>Days Celebrations</h2>
                <p>We are a team and every activity is performed in a team spirit. We celebrate welcomes, farewells and national days and provide our students an opertunity to showcase their abilities </p>
                <h2 class="mt-4">Student Promotion</h2>
                <p>We promote our students' physical capacities in grounds. We arrange sports competitions to give them an oppertunity to be selected in national games ultimately. </p>
            </div>
        </div>
    </div>

</section>

<section class="mt-24 md:px-24">
    <div class="grid grid-cols-1 md:grid-cols-2 border">
        <div class="p-4 md:p-8 text-center">
            <img src="{{url(asset('images/donor.png'))}}" alt="" class="w-40 h-40 rounded-full mx-auto">
            <h2 class="mt-3">Rao Zahoor Ahmad</h2>
            <p class="text-slate-600 text-sm mt-2">A well known charity person of village Chak Bedi, who donated his 9 acres land for the establisment of school. May his soul rest in peace!</p>
        </div>

        <div class="overflow-x-hidden">
            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d6044.265479385004!2d73.49551048367726!3d30.485434912974124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1shigher%20secondary%20school%20near%20Chak%20Bedi!5e0!3m2!1sen!2s!4v1701884753529!5m2!1sen!2s" width="540" height="320" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </div>
    <div class="flex flex-col md:flex-row justify-center md:items-center w-full mt-12 space-y-3 md:space-x-4">
        <img src="{{url('images/mini/email-5.png')}}" alt="" class="w-16 -rotate-6">
        <input type="text" placeholder="Enter your mailing address" class="w-full md:w-3/4 custom-input pl-12">
        <button class="btn-teal py-2 px-4">Submit</button>

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