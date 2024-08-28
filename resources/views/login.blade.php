@extends('layouts.basic')
@section('body')
<div class="grid grid-cols-1 md:grid-cols-2 md:h-screen place-items-center bg-white p-5">
    <div>
        <img src="{{ url('images/small/key.png') }}" alt="signup" class="md:w-full">
    </div>
    <div class="grid place-items-center">
        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <form action="{{url('login')}}" method="post" class="w-full mt-1 text-center">
            @csrf
            <input type="text" name="login_id" class="hidden" value="admin@ghsscb.edu.pk">
            <h2 class="text-4xl font-bold">WELCOME</h2>
            <label for="">https://wwww.ghsscb.edu.pk</label>
            <select name="login_id" id="" class="custom-input mt-8">
                <option value="admin@ghsscb.edu.pk">Site Admin</option>
                <option value="admission@ghsscb.edu.pk">Admission Portal</option>
                <option value="library@ghsscb.edu.pk">Library Management</option>
            </select>


            <div class="flex flex-col w-full items-start">

                <div class="flex items-center w-full mt-3 relative">
                    <i class="bi bi-key absolute left-2 text-slate-600 -rotate-[45deg]"></i>
                    <input type="password" id="password" name="password" class="w-full custom-input px-8" placeholder="Password">
                    <!-- eye -->
                    <i class="bi bi-eye-slash absolute right-2 eye-slash"></i>
                    <i class="bi bi-eye absolute right-2 eye hidden"></i>
                </div>

                <button type="submit" class="w-full mt-6 btn-teal p-2">Login</button>
            </div>
        </form>

        <div class="text-center mt-6 text-slate-600 text-sm">
            <a href="{{url('/')}}" class="link">Back to home</a>
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

    });
</script>

@endsection