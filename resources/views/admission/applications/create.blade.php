@extends('layouts.basic')

@section('header')
<x-header></x-header>
@endsection

@section('body')
<section>

    <div class="bg-teal-800 text-teal-50 mt-16 px-5 md:px-24 text-xl py-6">New Application</div>
    <div class="container px-5 md:px-60">
        <div class="rounded border border-red-600 border-dotted p-5">
            <h3 class="text-red-600">Important Instructions</h3>
            <ul class="text-sm mt-3 list-disc list-outside pl-4">
                <li>Apply only if you have passed your matriculation examination</li>
                <li>Matric before 2022 is not acceptable as study gap must be less than or equal to two years</li>
                <li>In case of other board, NOC from your previous board will be required at the time of admission</li>
                <li>Choose Pre Engineering or ICS only if you are strong in mathametics</li>
                <li>After applying online, you need to remain in contact with higher section for further procedure</li>
            </ul>
        </div>

        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <form action="{{route('applications.store')}}" method="post" class="mt-8">
            @csrf
            <h2>Choose your desired group</h2>
            <div class="grid gap-y-2 mt-3">
                @foreach($groups as $group)
                <div>
                    <input type="checkbox" id='group_id' name="group_id" value="{{ $group->id }}" class="rounded mr-2">
                    <label for="group_id">{{ $group->name }} ({{ $group->subjects_list }})</label>
                </div>
                @endforeach
            </div>
            <div class="mt-8">
                <label for="">Passing Year (When did you pass matric exam?)</label>
                <select name="pass_year" id="" class="custom-input">
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024" selected>2024</option>
                </select>
            </div>
            <!-- student info -->
            <div class="grid md:grid-cols-2 gap-4 mt-8">
                <div class="md:col-span-2">
                    <label for="">Your Name (as per matric certificate)</label>
                    <input type="text" name="name" class="custom-input" placeholder="Your name">
                </div>
                <div class="">
                    <label for="">Father name</label>
                    <input type="text" name="father" class="custom-input" placeholder="Father name">
                </div>
                <div>
                    <label for="">Phone No</label>
                    <input type="text" name="phone" class="custom-input" placeholder="Phone No.">
                </div>
                <div>
                    <label for="">Board Name</label>
                    <select name="bise_name" id="" class="custom-input">
                        <option value="sahiwal">Sahiwal Board</option>
                        <option value="other">Other Board</option>
                    </select>
                </div>
                <div>
                    <label for="">Matric Roll No.</label>
                    <input type="number" name="rollno" class="custom-input" placeholder="Roll number" min='0'>
                </div>
                <div>
                    <label for="">Obtanied Marks</label>
                    <input type="number" name="obtained" class="custom-input" placeholder="Obtained marks" min='0'>
                </div>
                <div>
                    <label for="">Total Marks</label>
                    <select name="total" id="" class="custom-input">
                        <option value="1100">1100</option>
                        <option value="1200" selected>1200</option>
                    </select>
                </div>

            </div>
            <div class="text-center mt-8">
                <button class="btn-teal rounded py-3">Submit Application</button>

            </div>
        </form>
    </div>


</section>

<!-- footer -->
<x-footer></x-footer>
@endsection