@extends('layouts.admin')
@section('page-content')

<div class="custom-container">
    <h2>Reset Password</h2>
    <div class="bread-crumb">
        <a href="/">Dashboard</a>
        <div>/</div>
        <a href="{{ route('admin.users.index') }}">Users</a>
        <div>/</div>
        <div>Reset Password</div>
    </div>

    <div class="content-section relative mt-8">

        <!-- close button  -->
        <a href="{{route('admin.users.index')}}" class="absolute top-2 right-2 p-2 hover:bg-slate-200 rounded"><i class="bi-x-lg"></i></a>

        <form action="{{route('admin.users.update', $user)}}" method="post" class="flex flex-col md:w-2/3 mx-auto mt-12" onsubmit="return validate(event)">
            @csrf
            @method('PATCH')

            <h2>User: {{ $user->login_id }}</h2>

            <!-- page message -->
            @if($errors->any())
            <x-message :errors='$errors'></x-message>
            @else
            <x-message></x-message>
            @endif

            <label for="" class="mt-6">Password</label>
            <input type="password" id="new" name="new" class="w-full custom-input" placeholder="------" required>

            <label for="" class="mt-3">Confirm Password</label>
            <input type="password" id="confirmpw" class="w-full custom-input" placeholder="------" required>

            <button type="submit" class="mt-6 btn-teal p-2 w-32">Update Now</button>

        </form>
    </div>

</div>
@endsection
@section('script')
<script lang="javascript">
    function validate(event) {
        var validated = true;
        if ($('#new').val() != $('#confirmpw').val()) {
            validated = false;
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Confirm password not matched',
                showConfirmButton: false,
                timer: 1500,
            })

        }

        return validated;
        // return false;

    }
</script>
@endsection