@extends('layouts.basic')
@section('body')
<style>
    .main::before {
        background: url("{{asset('/images/bg/office.png')}}") no-repeat center center/cover;
        content: "";
        position: absolute;
        top: 0px;
        left: 0px;
        width: 100%;
        height: 100%;
        z-index: -1;
        opacity: 0.8;
    }
</style>

<div class="main flex flex-col items-center justify-center p-5 h-screen w-screen">
    <div class="flex flex-col justify-between items-center w-full md:w-2/3 lg:w-1/3 py-4 px-8 h-[80vh] relative z-20 rounded bg-white opacity-80">
        <div class="w-full">
            <img class="w-36 md:w-40 mx-auto" alt="logo" src="{{asset('images/logo/school_logo.png')}}">
        </div>
        <div class="w-full">

            <!-- page message -->
            @if($errors->any())
            <x-message :errors='$errors'></x-message>
            @else
            <x-message></x-message>
            @endif

            <form action="{{url('login')}}" method="post" class="w-full mt-1">
                @csrf
                <div class="flex flex-col w-full items-start">
                    <div class="flex items-center w-full relative">
                        <i class="bi bi-person absolute left-2 text-slate-600"></i>
                        <input type="text" id="login_id" name="login_id" class="w-full custom-input px-8" placeholder="Login id">
                    </div>
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
                <a href="">Forgot Password?</a>
            </div>
        </div>
        <div class="text-center text-xs">
            Dont have an account?<a href="" class="font-bold ml-2">Signup</a>
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