@extends('layouts.admission')
@section('page-content')
<!-- page title -->
<div class="flexrow row-mid-left txt-m bg-teal px-5 py-2 txt-white auto-col">
    <div class="mr-5">
        <span class='text-light'>Applications</span>
        <span class='bage badge-pill badge-success ml-2 p-0 px-2 txt-s'>{{$applications->count()}}</span>
    </div>
    <div class="mx-3 txt-s"><i data-feather='thermometer' class="feather-small mx-1"></i>{{$applications->where('group_id',1)->count()}}</div>
    <div class="mx-3 txt-s"><i data-feather='tool' class="feather-small mx-1"></i>{{$applications->where('group_id',2)->count()}}</div>
    <div class="mx-3 txt-s"><i data-feather='monitor' class="feather-small mx-1"></i>{{$applications->where('group_id',3)->count()}}</div>
    <div class="ml-5"><i data-feather='clock' class="feather-small mx-1"></i><span class="txt-s">{{now()->format('d-m-Y')}}</span>
        <span class="ml-3 txt-s">
            <i data-feather='users' class="feather-small"></i>
            {{$recentpayments->count()}}
        </span>
        <span class="txt-s mx-1">::</span>
        <span class="txt-s text-warning">Rs.{{$recentpayments->sum('fee')-$recentpayments->sum('concession')}}</span>

    </div>
</div>

<div class="flexrow my-4 mx-5">
    <input type="text" class='input-rounded' placeholder="Search" oninput="search(event)"><i data-feather='search' class="feather-small" style="position:relative; right:24; top:4px"></i>
    <div class="flexcol border-0 circular-25 centered bg-orange"><a href="{{route('applications.create')}}" class="text-light"><i data-feather='user-plus' class="feather-xsmall mx-1" style="position:relative; margin-left:5px; top:-2px"></i></a></div>
    <div class="ml-2">Create New</div>
</div>
<!-- display record save, del, update message if any -->
@if ($errors->any())
<div class="alert alert-danger mx-5">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
<br />
@elseif(session('success'))
<div class="alert alert-success mx-5">
    {{session('success')}}
</div>
<br />

@endif
<!-- page content -->
<div class="flex row pl-2 mx-5 mb-2 txt-b txt-grey">
    <div class="flexcol col-mid-left hw-10">Form </div>
    <div class="flexcol col-mid-left hw-30">Name </div>
    <div class="flexcol col-mid-left hw-15">Marks </div>
    <div class="flexcol col-mid-left hw-15">Group </div>
    <div class="flexcol col-mid-left hw-10">Scrutiny </div>
    <div class="flexcol col-center hw-10">Fee</div>

    <div class="flexcol col-mid-left hw-10"> <i data-feather='more-horizontal' class="feather-small mx-4"></i></div>
</div>

</div>



@endsection
@section('script')
<script lang="javascript">
    function delme(formid) {
        event.preventDefault();
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
                //submit corresponding form
                $('#deleteform' + formid).submit();
            }
        });
    }


    function payfee(formid, fee) {
        event.preventDefault();

        Swal.fire({
            title: 'Fee payment',
            text: "Have you recieved fee? Rs." + fee,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, recieved!'
        }).then((result) => {
            if (result.value) {
                //submit corresponding form
                $('#postfee' + formid).submit();
            }
        });
    }

    function search(event) {
        var searchtext = event.target.value.toLowerCase();
        var str = 0;
        $('.tr').each(function() {
            if (!(
                    $(this).children().eq(0).prop('outerText').toLowerCase().includes(searchtext) ||
                    $(this).children().eq(1).prop('outerText').toLowerCase().includes(searchtext) ||
                    $(this).children().eq(3).prop('outerText').toLowerCase().includes(searchtext)
                )) {
                $(this).addClass('hide');
            } else {
                $(this).removeClass('hide');
            }


        });
    }
</script>
@endsection