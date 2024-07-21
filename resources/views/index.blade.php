@extends('layouts.basic')

@section('header')
<x-header></x-header>
@endsection

@section('body')

<!-- page message -->
@if($errors->any())
<x-message :errors='$errors'></x-message>
@else
<x-message></x-message>
@endif

<section class="w-screen h-screen">
    <div class="flex flex-col md:flex-row-reverse justify-between items-center px-5 md:px-24 h-full pt-16 bg-teal-800">
        <div class="flex flex-1 justify-end items-center">
            <img src="{{ url(asset('images/hero/book-0.png')) }}" alt="" class="w-48 h-48 md:w-96 md:h-96">

        </div>
        <div class="flex flex-col flex-1 gap-y-2 justify-center text-slate-100">
            <div class="text-3xl md:text-5xl">Admission Open</div>
            <p class="text-slate-300">Welcome to our online admission portal. Join us to get quality education in any of three disciplines: Pre Engineering, ICS & Humanities (Arts group). </p>
            <a href="{{route('applications.create')}}">
                <button class="btn-orange mt-5">Apply Now <i class="bi-arrow-right"></i></button>
            </a>
        </div>

    </div>


</section>
<div class="flex justify-center w-full bg-teal-200">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-x-24 p-5 text-center">
        <a href="{{url('login/admin')}}" class="flex flex-col justify-center items-center">
            <div class="flex items-center justify-center bg-cyan-100 rounded-full w-16 h-16">
                <i class="bi bi-tools text-2xl text-cyan-400"></i>
            </div>
            <h3 class="mt-3 text-lg">Site Administration</h3>
        </a>
        <a href="{{url('login/admission-portal')}}" class="flex flex-col justify-center items-center">
            <div class="flex items-center justify-center bg-cyan-100 rounded-full w-16 h-16">
                <i class="bi bi-person-gear text-2xl text-green-400"></i>
            </div>
            <h3 class="mt-3 text-lg">Admission Portal</h3>
        </a>
        <a href="{{ url('login/library') }}" class="flex flex-col justify-center items-center">
            <div class="flex items-center justify-center bg-cyan-100 rounded-full w-16 h-16">
                <i class="bi bi-book text-2xl text-orange-400"></i>
            </div>
            <h3 class="mt-3 text-lg">Library System</h3>
        </a>
        <a href="" class="flex flex-col justify-center items-center">
            <div class="flex items-center justify-center bg-cyan-100 rounded-full w-16 h-16">
                <i class="bi bi-laptop text-2xl text-blue-400"></i>
            </div>
            <h3 class="mt-3 text-lg">Self Assessment</h3>
        </a>


    </div>

</div>
<!-- features section -->
<section id='features' class="md:mt-24 px-4 md:px-24">
    <h2 class="text-4xl text-center">Why Us</h2>
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
            <h3 class="mt-3 text-lg">IT Skills</h3>
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
            <div class="flex flex-col flex-1">
                <h2 class="text-xl">Our Achievements</h2>
                <ul class="flex mt-3">
                    <li><i class="bi-check2-circle pr-3"></i></li>
                    <li> *WINNER*: All Punjab Qirat Competition</li>
                </ul>
                <ul class="flex mt-3">
                    <li><i class="bi-check2-circle pr-3"></i></li>
                    <li> *WINNER*: Hock Tournament Sahiwal Division, 2022-23</li>
                </ul>
                <ul class="flex mt-3">
                    <li><i class="bi-check2-circle pr-3"></i></li>
                    <li> *RUNNER UP*: Hock Tournament Sahiwal Division, 2023-24</li>
                </ul>
                <ul class="flex mt-3">
                    <li><i class="bi-check2-circle pr-3"></i></li>
                    <li> *WINNER*: Speech Competition District Pakpattan, 2023-24</li>
                </ul>

            </div>
        </div>
    </div>
</section>

<!-- testimonial section -->
<section class="testimonials pt-0" data-aos="fade-up">
    <div class="mt-24 px-4 md:px-16 md:w-3/4 mx-auto">
        <h2 class="text-4xl text-center">Our Faculty</h2>
        <p class="text-gray-600 text-center mt-8">
            We have highly skilled and qualified teaching faculty who consistently demonstrate a passion for fostering student growth through innovative teaching methods and personalized support
        </p>
        <div class="h-1 w-24 bg-teal-800 mx-auto mt-6"></div>
    </div>
    <div class="testimonials-carousel swiper w-full md:w-3/4 mx-auto mt-12">
        <div class="swiper-wrapper">
            <div class="testimonial-item swiper-slide">
                <img src="{{asset('images/logo/app_logo.png')}}" class="testimonial-img" alt="">
                <h3>Abdul Majeed</h3>
                <h4>Principal</h4>
                <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    "Through a commitment to academic excellence, character education, and inclusive community engagement, we empower our students to become lifelong learners, compassionate leaders, and contributors to a globally connected society."
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
            </div>

            <div class="testimonial-item swiper-slide">
                <img src="{{asset('images/logo/app_logo.png')}}" class="testimonial-img" alt="">
                <h3>Rasheed Ahmad Khawar</h3>
                <h4>Senior Subject Specialist (Physics)</h4>
                <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    "Our mission at GHSS Chakbedi is to cultivate a dynamic learning environment that inspires intellectual curiosity, fosters critical thinking, and promotes the holistic development of each student."
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
            </div>
            <div class="testimonial-item swiper-slide">
                <img src="{{asset('images/logo/app_logo.png')}}" class="testimonial-img" alt="">
                <h3>Dr. Ahmad Ali</h3>
                <h4>Senior Subject Specialist (Biology)</h4>
                <p>
                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                    "We are committed to provide quality education to each and every student of this instiution. For this purpose, we leave no stone unturned to keep the confidence level maintained."
                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                </p>
            </div>

        </div>
        <div class="swiper-pagination"></div>
    </div>

</section><!-- End Ttstimonials Section -->

<section id='key_features' class="mt-12 md:mt-24 px-4 md:px-24">
    <div class="md:w-3/4 mx-auto">
        <h2 class="text-4xl text-center">Key Features</h2>
        <p class="text-gray-600 text-center mt-8">
            We have highly skilled and qualified teaching staff who consistently demonstrate a passion for fostering student growth through innovative teaching methods and personalized support
        </p>
        <div class="h-1 w-24 bg-teal-800 mx-auto mt-6"></div>
    </div>

    <div class="flex flex-col md:flex-row gap-y-6 mt-16 w-full justify-between">
        <div class="flex-1">
            <h2 class="text-2xl text-slate-800">Planned Testing</h2>
            <p class="mt-3 text-slate-600 leading-relaxed">We conduct well planned series of tests in order to get our students ready for their final exams. Our online assessment system also helps specially the brilliant students to perform their self assessment and identify their deficiencies properly.</p>
        </div>
        <div class="flex-1">
            <img src="{{asset('images/sports/shield.png')}}" alt="" class="md:w-3/4 md:float-right">
        </div>
    </div>

    <div class="flex flex-col-reverse md:flex-row gap-y-6 mt-6 md:mt-16 w-full justify-between">
        <div class="flex-1">
            <img src="{{asset('images/library/library-1.png')}}" alt="" class="md:w-3/4 md:float-left">
        </div>
        <div class="flex-1">
            <h2 class="text-2xl text-slate-800">Computerized Library System</h2>
            <p class="mt-3 text-slate-600 leading-relaxed">
                We have a lot of books covering all subject domains like religion, science, culture, literature, history, etc. These books are free for all students. Thanks to our web application that keeps track of all the readers and books.
            </p>
        </div>

    </div>
    <div class="flex flex-col md:flex-row gap-y-6 mt-6 md:mt-16 w-full justify-between">
        <div class="flex-1">
            <h2 class="text-2xl text-slate-800">Moral Care</h2>
            <p class="mt-3 text-slate-600 leading-relaxed">
                We own our students in real sense. We show them the right way that can lead to their destination. We provide them evironment where they learn how to become good citizens of the nation.
            </p>
        </div>
        <div class="flex-1">
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
                <div id="default-carousel" class="relative w-full" data-carousel="slide">
                    <!-- Carousel wrapper -->
                    <div class="relative h-48 md:h-80 overflow-hidden  bg-slate-600">
                        <!-- Item 1 -->
                        <div class="hidden duration-700 ease-in-out h-full" data-carousel-item>
                            <img src="{{asset('images/events/events-1.png')}}" class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 opacity-50" alt="...">
                            <p class="absolute top-20 left-0 text-center w-full h-full opacity-80 text-white text-lg z-30">It is description of the event</p>
                        </div>
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{asset('images/events/events-2.png')}}" class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{asset('images/events/events-3.png')}}" class="absolute block w-full h-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        </div>
                    </div>
                    <!-- Slider indicators -->
                    <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                    </div>
                    <!-- Slider controls -->
                    <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
            </div>

            <div class="flex flex-col flex-1">
                <h2 class="text-slate-800">Seminars</h2>
                <p class="text-slate-600">We have great seminars for you. Click here to read which seminars are waiting for your click</p>
                <h2 class="text-slate-800 mt-6">Workshops</h2>
                <p class="text-slate-600">We have great seminars for you. Click here to read which seminars are waiting for your click</p>
                <h2 class="text-slate-800 mt-6">Trainings</h2>
                <p class="text-slate-600">We have great seminars for you. Click here to read which seminars are waiting for your click</p>
            </div>
        </div>
    </div>

</section>

<section class="mt-24 md:px-24">
    <div class="grid grid-cols-1 md:grid-cols-2 border">
        <div class="p-4 md:p-8 text-center">
            <img src="{{url(asset('images/donor.png'))}}" alt="" class="w-40 h-40 rounded-full mx-auto">
            <h2 class="mt-3">Rao Zahoor Ahmad</h2>
            <p class="text-slate-600 text-sm mt-2">A well known charity person of village Chak Bedi, who donated his 9 acres land for the establisment of school. May his sould rest in peace!</p>
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
<script lang="javascript">
    import {
        Carousel
    }
    from 'flowbite';
    const options = {
        defaultPosition: 1,
        interval: 3000,

        indicators: {
            activeClasses: 'bg-white dark:bg-gray-800',
            inactiveClasses: 'bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800',
            items: [{
                    position: 0,
                    el: document.getElementById('carousel-indicator-1')
                },
                {
                    position: 1,
                    el: document.getElementById('carousel-indicator-2')
                },
                {
                    position: 2,
                    el: document.getElementById('carousel-indicator-3')
                },
                {
                    position: 3,
                    el: document.getElementById('carousel-indicator-4')
                },
            ]
        }
    }

    const carousel = new Carousel(items, options);

    // const $prevButton = document.getElementById('data-carousel-prev');
    // const $nextButton = document.getElementById('data-carousel-next');


    // $prevButton.addEventListener('click', () => {
    //     carousel.prev();
    // });

    // $nextButton.addEventListener('click', () => {
    //     carousel.next();
    // });
    animateSlide()
    setTimeout(animateSlide, 3000);

    function animateSlide() {

        // slide1 = document.getElementById('slide1');
        // slide1.toggleClass('active')
        $('#slide1').toggleClass('active');
    }
</script>
@endsection