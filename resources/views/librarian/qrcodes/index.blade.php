@extends('layouts.library')
@section('page-content')
<div class="custom-container">
    <h2>Specific Qr</h2>
    <div class="bread-crumb">
        <a href="{{url('library')}}">Dashoboard</a>
        <div>/</div>
        <div>Specific Qr</div>
    </div>

    <div class="flex h-80 justify-center items-center mt-8">
        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif


        <form action="{{route('library.qr.specific.create')}}" method="post" class="flex items-center justify-between gap-x-4 w-full md:w-1/2">
            @csrf
            <input type="text" name='qr' placeholder="Exact Qr Code" class="custom-input text-center">
            <button type="submit" class="btn-orange py-2"><i class="bi-qr-code"></i></button>
        </form>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    function search(event) {
        // var searchtext = event.target.value.toLowerCase();
        var searchtext = $('#searchby').val().toLowerCase();
        var str = 0;
        $('.tr').each(function() {
            if (!(
                    $(this).children().eq(1).prop('outerText').toLowerCase().includes(searchtext)
                )) {
                $(this).addClass('hidden');
            } else {
                $(this).removeClass('hidden');
            }
        });
    }

    function confirmDel(event) {
        event.preventDefault(); // prevent form submit
        var form = event.target; // storing the form

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                form.submit();
            }
        })
    }

    function toggleFilterSection() {
        $('#filterSection').slideToggle().delay(500);
    }
</script>
@endsection