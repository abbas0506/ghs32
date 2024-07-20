@extends('layouts.library')
@section('page-content')
<div class="custom-container">
    <h2>QRCodes <i class="bi bi-qr-code"></i></h2>
    <div class="bread-crumb">
        <a href="{{url('library')}}">Dashoboard</a>
        <div>/</div>
        <div>QRCodes</div>
        <div>/</div>
        <div>index</div>
    </div>

    <div class="mt-16">
        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="border rounded border-dashed shadow-lg">

                <h2 class="py-2 bg-slate-50 text-center">Books <span class="text-xs font-normal text-slate-600">(choose a rack)</span></h2>

                <div class="grid grid-cols-4 md:grid-cols-4 gap-2 p-4 text-sm text-center">
                    @foreach($book_racks as $book_rack)
                    <a href="{{route('library.book_racks.show',$book_rack)}}" class="link">{{$book_rack->label}}</a>
                    @endforeach
                </div>
            </div>

            <!-- classes -->
            <div class="border rounded border-dashed shadow-lg">
                <h2 class="py-2 bg-slate-50 text-center">Students <span class="text-xs font-normal text-slate-600">(choose a class)</span></h2>
                <div class="grid grid-cols-3 md:grid-cols-3 gap-2 p-4 text-sm text-center">
                    @foreach($classes as $clas)
                    <a href="{{route('library.classes.show',$clas)}}" class="link">{{$clas->grade->roman_name}}-{{$clas->section_label}}</a>
                    @endforeach
                </div>
            </div>

            <!-- Teachers -->
            <div class="border flex flex-col rounded border-dashed shadow-lg">
                <h2 class="py-2 bg-slate-50 text-center">Teachers</h2>
                <div class="flex flex-col flex-1 justify-center items-center">
                    <h1 class="">{{$teachers->count()}}</h1>
                    <a href="{{route('library.qrcodes.teachers.preview')}}" target="_blank"><i class="bi bi-qr-code"></i></a>
                </div>
            </div>

        </div>




    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
    function search(event) {
        var searchtext = event.target.value.toLowerCase();
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
</script>

@endsection