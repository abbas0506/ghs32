@extends('layouts.basic')

@section('header')
<x-header></x-header>
@endsection
@section('body')
<!-- <div class="text-center bg-sky-100 text-sm py-1">(+92 42) 99233106-7</div> -->
<section id='page_title' class="pt-32 pb-8 bg-app text-orange-200">
    <div class="section-title text-center">
        Contact Us
    </div>
</section>
<section class="">

    <div class="grid md:grid-cols-2 mt-8 w-full md:w-2/3 mx-auto gap-8">
        <div class="flex flex-col md:col-span-2 justify-center items-center text-center border p-8">
            <i class="bi-geo-alt-fill text-teal-700 text-2xl"></i>
            <h2 class="text-xl">Our Address</h2>
            <p class="">Govt Higher Secondary School Chak Bedi, Pakpattan</p>
        </div>
        <div class="flex flex-col justify-center items-center border p-8">
            <i class="bi-envelope-at-fill text-teal-700 text-2xl"></i>
            <h2 class="text-xl">Email Us</h2>
            <p class="">principal.ghsschakbedi@gmail.com</p>
        </div>
        <div class="flex flex-col justify-center items-center border p-8">
            <i class="bi-telephone-fill text-teal-700 text-2xl"></i>
            <h2 class="text-xl">Call Us</h2>
            <p class="">+92 300 8754001</p>
        </div>
    </div>
</section>
<!-- map -->
<section class="mt-16">
    <div class="overflow-x-hidden">
        <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d6044.265479385004!2d73.49551048367726!3d30.485434912974124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1shigher%20secondary%20school%20near%20Chak%20Bedi!5e0!3m2!1sen!2s!4v1701884753529!5m2!1sen!2s" class="w-full" height="320" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>
<!-- footer -->
<x-footer></x-footer>
@endsection

@section('script')