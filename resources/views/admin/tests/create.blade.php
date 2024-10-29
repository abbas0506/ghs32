@extends('layouts.admin')
@section('page-content')
<h2>New Test</h2>
<div class="bread-crumb">
    <a href="/">Home</a>
    <div>/</div>
    <a href="{{route('admin.tests.index')}}">Tests</a>
    <div>/</div>
    <div>New</div>
</div>

<div class="md:w-3/4 mx-auto mt-6 bg-white md:p-8 rounded">
    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif
    <form action="{{route('admin.tests.store')}}" method='post' class="w-full grid gap-6" onsubmit="return validate(event)">
        @csrf
        <div>
            <label>Test Title</label>
            <input type="text" name='title' class="custom-input" placeholder="test title" value="" required>
        </div>
        <div class="md:p-8 border rounded-lg">
            <h3 class="mb-4">Select grades for this test</h3>
            @foreach($grades as $grade)
            <div class="flex items-center odd:bg-slate-100 checkable-row px-4">
                <!-- <div class="flex flex-1 items-center justify-between space-x-2 pr-3"> -->
                <label for='grade{{$grade->id}}' class="flex-1 text-sm text-slate-800 hover:cursor-pointer py-2">{{ $grade->english_name }} </label>
                <!-- </div> -->
                <div class="text-base">
                    <input type="checkbox" id='grade{{$grade->id}}' name='grade_ids_array[]' class="custom-input w-4 h-4 rounded hidden" value="{{ $grade->id }}">
                    <i class="bx bx-check"></i>
                </div>
            </div>
            @endforeach
        </div>
        <button type="submmit" class="btn-teal rounded p-2 w-32 mt-3">Create Now</button>
    </form>

</div>
</div>
@endsection
@section('script')
<script type="module">
    $('.checkable-row input').change(function() {
        if ($(this).prop('checked'))
            $(this).parents('.checkable-row').addClass('active')
        else
            $(this).parents('.checkable-row').removeClass('active')
    })

    $('#check_all').change(function() {
        if ($(this).prop('checked')) {
            $('.checkable-row input').each(function() {
                $(this).prop('checked', true)
                $(this).parents('.checkable-row').addClass('active')
            })
        } else {
            $('.checkable-row input').each(function() {
                $(this).prop('checked', false)
                $(this).parents('.checkable-row').removeClass('active')
            })
        }
    })
</script>
@endsection