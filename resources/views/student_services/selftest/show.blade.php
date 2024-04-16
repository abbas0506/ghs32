@extends('layouts.basic')

@section('header')
<x-header></x-header>
@endsection

@section('body')
<style>
    .option label {
        cursor: pointer;
    }

    .bi-ckeck-lg {
        color: green;
        font-weight: bolder;
    }

    .bi-x {
        color: red;
        font-weight: bolder;
    }

    .answer i {
        display: none;
    }

    .answer.solved .accepted .bi-check-lg {
        display: block;
    }

    .answer.solved .rejected .bi-x {
        display: block;
    }

    .answer.solved .radio {
        display: none;
    }

    .answer.solved .correct label {
        background-color: #76D7C4;
        color: white;
    }

    .hero {
        background-image: linear-gradient(rgba(0, 100, 100, 1.0),
                rgba(128, 128, 128, 0));
        /* url("{{asset('/images/bg/exams1-01.svg')}}"); */
        background-position: top;
        background-repeat: no-repeat;
        background-size: contain;
        background-clip: border-box;
        position: relative;
    }
</style>
@php
$sr=1;
@endphp
<div class="hero h-[70vh] flex flex-col justify-center items-center overflow-auto">
    <!-- <div class="md:w-2/3 mx-auto text-center"> -->
    <!-- <img src="{{asset('/images/mini/quiz-0.png')}}" alt="" width="200"> -->
    <div class="text-4xl text-orange-200">Self Test</div>
    <h1 class="mt-4">{{$subject->name}} - {{$subject->grade->roman_name}}</h1>
    <h4 class="mt-2">Max Marks: 20 </h4>
    <!-- </div> -->

</div>
<div class="flex flex-col justify-center items-center overflow-auto">

    <div class="md:w-2/3 mx-auto flex flex-col gap-y-6 px-4">

        @foreach($questions as $question)
        <div class="flex flex-col items-start justify-start border border-dashed rounded  bg-white relative">
            <p class="w-8 font-semibold text-xs text-center text-slate-100 bg-teal-600">{{$sr++}}</p>
            <div class="pt-4 pb-8 px-8 md:px-16 w-full">
                <p class="font-semibold text-base text-gray-800">{{$question->question}}</p>
                <div class="divider my-4"></div>
                <div id='ans' class="answer flex flex-col mt-4 text-gray-600 gap-y-2">
                    <div class="option flex space-x-3 items-center @if($question->answer=='a') correct @endif">
                        <input type="radio" id='radioa-{{$question->id}}' class="radio">
                        <label for="radioa-{{$question->id}}" class="">{{$question->mcq->option_a}}</label>
                        <i class="bi-check-lg"></i>
                        <i class="bi-x"></i>
                    </div>

                    <div class="option flex space-x-3 items-center @if($question->answer=='b') correct @endif">
                        <input type="radio" id='radiob-{{$question->id}}' class="radio">
                        <label for="radiob-{{$question->id}}" class="">{{$question->mcq->option_b}}</label>
                        <i class="bi-check-lg"></i>
                        <i class="bi-x"></i>
                    </div>

                    <div class="option flex space-x-3 items-center @if($question->answer=='c') correct @endif">
                        <input type="radio" id='radioc-{{$question->id}}' class="radio">
                        <label for="radioc-{{$question->id}}" class="">{{$question->mcq->option_c}}</label>
                        <i class="bi-check-lg"></i>
                        <i class="bi-x"></i>
                    </div>
                    <div class="option flex space-x-3 items-center @if($question->answer=='d') correct @endif">
                        <input type="radio" id="radiod-{{$question->id}}" class="radio">
                        <label for="radiod-{{$question->id}}" class="">{{$question->mcq->option_d}}</label>
                        <i class="bi-check-lg"></i>
                        <i class="bi-x"></i>
                    </div>
                </div>

            </div>

        </div>
        @endforeach
        <button id='finishQuizButton' type="submit" class="fixed bottom-6 right-6 w-12 h-12 rounded-full btn-teal flex justify-center items-center"> <i class="bi-caret-right"></i></button>
    </div>
    <div class="my-8"></div>
    <input type="hidden" id="mcqs_count" value="{{ $questions->count() }}">
</div>

@endsection
@section('script')
<script type="module">
    $('.radio').change(function() {
        var selectedOption = $(this)
        $(this).parent().parent().children().find('.radio').each(function() {
            if ($(this) != selectedOption)
                $(this).prop('checked', false);
        })
        selectedOption.prop('checked', true)
    });

    $('#finishQuizButton').click(function() {
        var correctAnswers = 0;
        var unAnswered = $('#mcqs_count').val();;
        $('.answer').each(function() {
            $(this).children().find('.radio:checked').each(function() {
                unAnswered -= 1
                if ($(this).parent().hasClass('correct')) {
                    $(this).parent().addClass('accepted')
                    correctAnswers += 1;
                } else
                    $(this).parent().addClass('rejected')
            })
        })
        if (unAnswered > 0) {
            Swal.fire({
                icon: "warning",
                title: unAnswered + " questions left",
                text: "Please complete the quiz!",
            });
        } else {

            var text = '';
            if (correctAnswers < 10) text = "Best of luck for next time!"
            else if (correctAnswers < 15) text = "Good effort..."
            else if (correctAnswers < 18) text = "Outstanding marks!"
            else text = "Outstanding!"
            Swal.fire({
                icon: "success",
                title: "Your Score: " + correctAnswers,
                text: text,
            });
            // display correct asnswers
            $('.answer').each(function() {
                $(this).addClass('solved')
                $('#finishQuizButton').addClass('hidden');
            });
        }

    })
</script>
@endsection