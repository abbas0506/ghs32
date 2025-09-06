@extends('layouts.admin')
@section('page-content')

<div class="custom-container">
    <h1>Section: {{ $section->fullName() }}</h1>
    <div class="bread-crumb">
        <a href="{{url('admin')}}">Dashoboard</a>
        <div>/</div>
        <a href="{{route('admin.sections.index')}}">Sections</a>
        <div>/</div>
        <div>{{$section->fullName()}}</div>
    </div>

    <!-- search -->
    <!-- <div class="flex justify-between items-center flex-wrap gap-6 mt-12"> -->
    <div class="flex relative w-full md:w-1/3">
        <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full" oninput="search(event)">
        <i class="bx bx-search absolute top-2 right-2"></i>
    </div>
    <div class="flex justify-center items-center gap-3 flex-wrap mt-5">
        <a href="{{ route('admin.section.students.create', $section)}}"><i class="bi bi-person-add text-teal-600"></i></a>
        <a href="{{ route('admin.sections.import',$section)}}" class=""><i class="bi bi-file-earmark-plus text-teal-600"></i></a>
        <a href="{{ route('admin.sections.export',$section)}}" class=""><i class="bi bi-arrow-right-square text-teal-600"></i></a>
        <a href="{{ route('admin.section.lecture.allocations.index',[$section,0]) }}" class=""><i class="bi-clock text-teal-600"></i></a>
        <a href="{{ route('admin.section.cards.index',$section) }}" class=""><i class="bi-person-badge text-indigo-600"></i></a>
        <a href="{{ route('admin.sections.clean',$section) }}" class=""><i class="bx bx-recycle text-orange-600"></i></a>
    </div>

    <!-- </div> -->

    <!-- page message -->
    @if($errors->any())
    <x-message :errors='$errors'></x-message>
    @else
    <x-message></x-message>
    @endif

    <div class="overflow-x-auto bg-white w-full mt-8">

        <table class="table-auto borderless w-full">
            <thead>
                <tr>
                    <th class="w-10">#</th>
                    <th class="w-48 text-left">Name</th>
                    <th class="w-48 text-left">Father</th>
                    <th class="w-24">Group</th>
                    <th class="w-24">Photo</th>

                </tr>
            </thead>
            <tbody>
                @foreach($section->students->sortBy('rollno') as $student)
                <tr class="tr">
                    <td>{{$student->rollno}}</td>
                    <td class="text-left"><a href="{{route('admin.section.students.show', [$section, $student])}}" class="link">{{$student->name}}</a></td>
                    <td class="text-left">{{$student->father_name}}</td>
                    <td>{{$student->group->name}}</td>
                    <td><img src="{{ asset('storage/' . $student->photo) }}" alt="photo" class="rounded mx-auto w-8 h-8"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
<script>
    function search(event) {
        var searchtext = event.target.value.toLowerCase();
        var str = 0;
        $('.tr').each(function() {
            if (!(
                    $(this).children().eq(0).prop('outerText').toLowerCase().includes(searchtext) ||
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