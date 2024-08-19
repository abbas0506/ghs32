@extends('layouts.admission')
@section('page-content')
<div class="container bg-slate-100">
    <!--welcome  -->
    <div class="flex items-center">
        <div class="flex-1">
            <div class="bread-crumb">
                <div>Admission Portal</div>
                <div>/</div>
                <div>Dashboard</div>
            </div>
        </div>
        <div class="text-slate-500">{{ today()->format('d/m/Y') }}</div>
    </div>
    <!-- pallets -->
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-3">
        <a href="{{ route('admission.applications.index') }}" class="pallet-box">
            <div class="flex-1 ">
                <div class="title">Applications</div>
                <div class="flex items-center">
                    <div class="h2 mr-8">{{ $applications->count() }}</div>
                    @if($numOfApplicationsToday)
                    <i class="bi-arrow-up text-green-700 text-sm"></i>
                    <p class="text-green-700 text-sm">{{ $numOfApplicationsToday }}</p>
                    @endif
                </div>
            </div>
            <div class="ico bg-teal-100">
                <i class="bi bi-person text-teal-600"></i>
            </div>
        </a>
        <a href="{{ route('admission.fee.index') }}" class="pallet-box">
            <div class="flex-1">
                <div class="title">Fee</div>
                <div class="flex items-center">
                    <div class="h2 mr-8"> {{ $applications->sum('fee_paid') }}</div>
                    @if($sumOfFeeToday>0)
                    <i class="bi-arrow-up text-green-700 text-sm"></i>
                    <p class="text-green-700 text-sm">{{ $sumOfFeeToday }}</p>
                    @endif
                </div>
            </div>
            <div class="ico bg-sky-100">
                <i class="bi bi-currency-rupee text-sky-600"></i>
            </div>
        </a>
        <a href="{{ route('admission.objections.index') }}" class="pallet-box">
            <div class="flex-1">
                <div class="title">Objections</div>
                <div class="flex items-center">
                    <div class="h2 mr-8"> {{ $applications->whereNotNull('objection')->count() }}</div>
                    @if($numOfObjectionsToday>0)
                    <i class="bi-arrow-up text-red-600 text-sm"></i>
                    <p class="text-red-600 text-sm">{{ $numOfObjectionsToday }}</p>
                    @endif
                </div>
            </div>
            <div class="ico bg-red-100">
                <i class="bi bi-question text-red-600"></i>
            </div>
        </a>
        <a href="{{ route('admission.high-achievers.index') }}" class="pallet-box">
            <div class="flex-1">
                <div class="title">High Achievers</div>
                <div class="flex items-center">
                    <div class="h2 mr-8"> {{ $applications->where('obtained','>=',1000)->count() }}</div>
                    @if($numOfHighAchieversToday)
                    <i class="bi-arrow-up text-green-700 text-sm"></i>
                    <p class="text-green-700 text-sm">{{ $numOfHighAchieversToday }}</p>
                    @endif
                </div>
            </div>
            <div class="ico bg-green-100">
                <i class="bi bi-hand-thumbs-up text-green-600"></i>
            </div>
        </a>


    </div>

    @php $sr=1; @endphp
    <div class="overflow-x-auto w-full mt-8">

        <table class="table-fixed borderless w-full">
            <thead>
                <tr class="border-b">
                    <th class="w-8">Sr</th>
                    <th class="w-40 text-left">Group</th>
                    <th class="w-16">Total</th>
                    <th class="w-12">Objectioned</th>
                    <th class="w-12">Finalized</th>
                </tr>
            </thead>
            <tbody>
                @foreach($groups as $group)
                <tr class="tr text-sm border-b">
                    <td>{{$sr++}}</td>
                    <td class="text-left">
                        <a href="{{ route('admission.group.applications.index',$group) }}" class="link">{{ $group->name }}</a>
                    </td>
                    <td>{{ $group->applications()->count() }} @if($group->applications()->today()->count()) <span class="text-green-600 text-xs pl-2">{{ $group->applications()->today()->count() }} <i class="bi-arrow-up"></i></span>@endif</td>
                    <td>{{ $group->applications()->objectioned()->count() }}</td>
                    <td>{{ $group->applications()->feepaid()->count() }} @if($group->applications()->feepaid()->recentlyPaid()->count())<span class="text-green-600 text-xs pl-2">{{ $group->applications()->today()->feepaid()->count() }} <i class="bi-arrow-up"></i></span>@endif</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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