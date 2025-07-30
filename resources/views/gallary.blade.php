@extends('layouts.basic')

@section('header')
<x-header></x-header>
@endsection
@section('style')
<style>
    /* Custom styles for smoother transitions or specific overrides */
    .gallery-item img {
        transition: transform 0.3s ease-in-out, filter 0.3s ease-in-out;
    }

    .gallery-item:hover img {
        transform: scale(1.05);
        filter: brightness(0.9);
    }

    .filter-btn.active {
        background-color: #3b82f6;
        /* Blue-500 */
        color: #ffffff;
        font-weight: 600;
        /* Semibold */
    }

    /* Modal specific styles */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1000;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        margin: auto;
        display: block;
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
        /* Ensure image fits without cropping */
    }

    .modal-caption {
        margin-top: 20px;
        color: #fff;
        text-align: center;
        font-size: 1.25rem;
        /* text-xl */
    }

    .close-modal {
        position: absolute;
        top: 20px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
        cursor: pointer;
    }

    .close-modal:hover,
    .close-modal:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }
</style>
@endsection
@section('body')


<section class="py-12 md:py-16">
    <div class="container mx-auto px-4">

        <div class="flex flex-wrap justify-center gap-3 mb-10 md:mb-12">
            <button class="filter-btn active bg-blue-500 text-white py-2 px-6 rounded-full text-base font-semibold shadow-md hover:bg-blue-700 transition duration-300" data-category="all">All Events</button>
            <button class="filter-btn bg-gray-200 text-gray-700 py-2 px-6 rounded-full text-base font-medium shadow-md hover:bg-gray-300 transition duration-300" data-category="sports">Sports</button>
            <button class="filter-btn bg-gray-200 text-gray-700 py-2 px-6 rounded-full text-base font-medium shadow-md hover:bg-gray-300 transition duration-300" data-category="national-days">National & Int'l Days</button>
            <button class="filter-btn bg-gray-200 text-gray-700 py-2 px-6 rounded-full text-base font-medium shadow-md hover:bg-gray-300 transition duration-300" data-category="misc">Miscellaneous</button>
        </div>

        <div id="gallery-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            <div class="gallery-item bg-white rounded-lg shadow-md overflow-hidden group cursor-pointer" data-category="sports">
                <img src="https://via.placeholder.com/600x400/FF5733/FFFFFF?text=Annual+Sports+Day" alt="Annual Sports Day" class="w-full h-48 object-cover object-center">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Annual Sports Day</h3>
                    <p class="text-sm text-gray-600">Students participating in various track and field events. - Jan 2025</p>
                </div>
            </div>
            <div class="gallery-item bg-white rounded-lg shadow-md overflow-hidden group cursor-pointer" data-category="sports">
                <img src="https://via.placeholder.com/600x400/33A0FF/FFFFFF?text=Football+Tournament" alt="Football Tournament" class="w-full h-48 object-cover object-center">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Inter-House Football</h3>
                    <p class="text-sm text-gray-600">Exciting final match of the inter-house football tournament. - Feb 2025</p>
                </div>
            </div>

            <div class="gallery-item bg-white rounded-lg shadow-md overflow-hidden group cursor-pointer" data-category="national-days">
                <img src="https://via.placeholder.com/600x400/33FF57/FFFFFF?text=Independence+Day" alt="Independence Day Celebration" class="w-full h-48 object-cover object-center">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Independence Day</h3>
                    <p class="text-sm text-gray-600">Students celebrating national Independence Day with patriotic fervor. - Aug 2024</p>
                </div>
            </div>
            <div class="gallery-item bg-white rounded-lg shadow-md overflow-hidden group cursor-pointer" data-category="national-days">
                <img src="https://via.placeholder.com/600x400/F0FF33/FFFFFF?text=Earth+Day" alt="Earth Day Activities" class="w-full h-48 object-cover object-center">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Earth Day Activities</h3>
                    <p class="text-sm text-gray-600">Planting trees and learning about environmental conservation. - Apr 2025</p>
                </div>
            </div>

            <div class="gallery-item bg-white rounded-lg shadow-md overflow-hidden group cursor-pointer" data-category="misc">
                <img src="https://via.placeholder.com/600x400/8A33FF/FFFFFF?text=Science+Fair" alt="Science Fair" class="w-full h-48 object-cover object-center">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Annual Science Fair</h3>
                    <p class="text-sm text-gray-600">Students showcasing innovative science projects. - Mar 2025</p>
                </div>
            </div>
            <div class="gallery-item bg-white rounded-lg shadow-md overflow-hidden group cursor-pointer" data-category="misc">
                <img src="https://via.placeholder.com/600x400/FF338A/FFFFFF?text=Prize+Distribution" alt="Prize Distribution Ceremony" class="w-full h-48 object-cover object-center">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Prize Distribution Ceremony</h3>
                    <p class="text-sm text-gray-600">Acknowledging academic and extracurricular achievements. - Jun 2025</p>
                </div>
            </div>
            <div class="gallery-item bg-white rounded-lg shadow-md overflow-hidden group cursor-pointer" data-category="misc">
                <img src="https://via.placeholder.com/600x400/33FFE0/FFFFFF?text=Parent+Teacher+Meeting" alt="Parent-Teacher Meeting" class="w-full h-48 object-cover object-center">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Parent-Teacher Meeting</h3>
                    <p class="text-sm text-gray-600">Engaging discussion between parents and teachers. - Nov 2024</p>
                </div>
            </div>
            <div class="gallery-item bg-white rounded-lg shadow-md overflow-hidden group cursor-pointer" data-category="misc">
                <img src="https://via.placeholder.com/600x400/A0FF33/FFFFFF?text=Field+Trip" alt="School Field Trip" class="w-full h-48 object-cover object-center">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Educational Field Trip</h3>
                    <p class="text-sm text-gray-600">Students exploring a local historical site. - Oct 2024</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="imageModal" class="modal">
    <span class="close-modal">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption" class="modal-caption"></div>
</div>



<!-- <div class="text-center bg-sky-100 text-sm py-1">(+92 42) 99233106-7</div> -->
<section id='page_title' class="pt-32 pb-8 bg-app text-orange-600">
    <div class="text-3xl text-center">
        Gallary
    </div>
</section>
<section class="">

    <div class="mt-5 md:mt-8 w-3/4 flex justify-center items-center mx-auto relative">
        <div class="slider-container">
            <div class="slides">
                <img src="{{asset('images/events/event_1.png')}}" alt="Image 1" class="bg-cover">
                <img src="{{asset('images/events/event_2.png')}}" alt="Image 1" class="bg-cover">
                <img src="{{asset('images/events/event_3.png')}}" alt="Image 2" class="bg-cover">
                <img src="{{asset('images/events/event_4.png')}}" alt="Image 3" class="bg-cover">
                <!-- Add more images as needed -->
                <img src="{{asset('images/events/event_5.png')}}" alt="Image 1" class="bg-cover">
                <img src="{{asset('images/events/event_6.png')}}" alt="Image 2" class="bg-cover">
                <img src="{{asset('images/events/event_7.png')}}" alt="Image 3" class="bg-cover">

                <img src="{{asset('images/events/event_8.png')}}" alt="Image 3" class="bg-cover">
                <img src="{{asset('images/events/event_9.png')}}" alt="Image 3" class="bg-cover">
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
    document.addEventListener('DOMContentLoaded', () => {
        const filterButtons = document.querySelectorAll('.filter-btn');
        const galleryItems = document.querySelectorAll('.gallery-item');
        const imageModal = document.getElementById('imageModal');
        const modalImg = document.getElementById('img01');
        const modalCaption = document.getElementById('caption');
        const closeModal = document.querySelector('.close-modal');

        // Image Filtering Logic
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                const category = button.dataset.category;

                // Remove 'active' from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active', 'bg-blue-500', 'text-white', 'font-semibold'));
                filterButtons.forEach(btn => btn.classList.add('bg-gray-200', 'text-gray-700', 'font-medium'));

                // Add 'active' to clicked button
                button.classList.add('active', 'bg-blue-500', 'text-white', 'font-semibold');
                button.classList.remove('bg-gray-200', 'text-gray-700', 'font-medium');

                galleryItems.forEach(item => {
                    if (category === 'all' || item.dataset.category === category) {
                        item.style.display = 'block'; // Or 'grid'/'flex' depending on inner display
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // Image Modal Logic
        galleryItems.forEach(item => {
            item.addEventListener('click', () => {
                imageModal.style.display = 'flex'; // Use flex for centering
                modalImg.src = item.querySelector('img').src;
                modalCaption.innerHTML = item.querySelector('h3').textContent + '<br>' + item.querySelector('p').textContent;
            });
        });

        closeModal.addEventListener('click', () => {
            imageModal.style.display = 'none';
        });

        // Close modal when clicking outside the image
        imageModal.addEventListener('click', (e) => {
            if (e.target === imageModal) {
                imageModal.style.display = 'none';
            }
        });
    });
</script>





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