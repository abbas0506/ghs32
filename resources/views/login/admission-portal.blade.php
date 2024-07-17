@extends('layouts.basic')
@section('body')
<div class=" bg-white flex flex-col items-center justify-center p-5 h-screen w-screen">
    <div class="w-full sm:w-1/2 lg:w-1/4">
        <img class="w-36 md:w-40 mx-auto" alt="logo" src="{{asset('images/logo/app_logo_transparent.png')}}">
        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <form action="{{url('login')}}" method="post" class="w-full mt-1">
            @csrf
            <input type="text" name="login_id" class="hidden" value="admission@ghsscb.edu.pk">
            <h2 class="text-center w-full">Welcome to Admission Portal</h2>
            <p for="" class="text-center w-full">admission@ghss.edu.pk</p>

            <div class="flex flex-col w-full items-start">

                <div class="flex items-center w-full mt-3 relative">
                    <i class="bi bi-key absolute left-2 text-slate-600 -rotate-[45deg]"></i>
                    <input type="password" id="password" name="password" class="w-full custom-input px-8" placeholder="Password">
                    <!-- eye -->
                    <i class="bi bi-eye-slash absolute right-2 eye-slash"></i>
                    <i class="bi bi-eye absolute right-2 eye hidden"></i>
                </div>

                <button type="submit" class="w-full mt-6 btn-indigo p-2">Login</button>
            </div>
        </form>

        <div class="text-center mt-6 text-slate-600 text-sm">
            <a href="{{url('/')}}" class="">Cancel & Go back to home page</a>
        </div>
    </div>

</div>

</div>
@endsection
@section('script')
<script type="module">
    $(document).ready(function() {
        $('.bi-eye-slash').click(function() {
            $('#password').prop({
                type: "text"
            });
            $('.eye-slash').hide()
            $('.eye').show();
        })
        $('.bi-eye').click(function() {
            $('#password').prop({
                type: "password"
            });
            $('.eye-slash').show()
            $('.eye').hide();
        })

        $(window).click(function() {
            $('.modal').hide()
        });

        $('.modal').click(function(event) {
            event.stopPropagation();
        });
    });
</script>

@endsection