@extends('layouts.basic')

@section('header')
<x-header></x-header>
@endsection

@section('body')
<section>

    <div class="bg-teal-800 text-teal-50 text-center mt-16 px-5 md:px-24 text-xl py-6">Congratulation</div>
    <div class="container px-5 md:px-60">
        <div class="text-center">

            <i class="text-teal-800 bi-check-lg text-4xl"></i>
            <h2>Successfully submitted!</h2>
            <h2>Application No: {{ $application->rollno }}</h2>
            <p></p>
        </div>

        <div class="mt-8 text-right">
            <h2>غور سے پڑھیں</h2>
            <p>
                عزیز طالب علم ، آپکا داخلہ فارم موصول ہو چکا ہے، اب آپ سولہ اگست کو فیس کے ساتھ ایڈمشن آفس رابطہ کریں کسی قسم کے ڈاکیومنٹس ساتھ لانے کی ضرورت نہیں۔
                ڈاکیومنٹس داخلہ ہو جانے کے بعد ہی آپ سے لیے جائیں گے

            </p>
            <p>بیس اگست سے کلاسز کا آغاز ہو گا (ان شا ٗ اللہ)</p>

            <div class="text-center mt-8">
                <a href="{{ url('/') }}" class="btn-teal">اوکے، میں نے غور سے پڑھ لیا ہے</a>
            </div>
        </div>




    </div>


</section>

@endsection