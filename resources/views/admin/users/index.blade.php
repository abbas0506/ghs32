@extends('layouts.admin')
@section('page-content')

<div class="custom-container">
    <h1>User Management</h1>
    <div class="bread-crumb">
        <a href="{{url('admin')}}">Dashoboard</a>
        <div>/</div>
        <div>Users</div>
        <div>/</div>
        <div>All</div>
    </div>
    <!-- search -->

    <div class="overflow-x-auto p-8 mt-8 bg-white rounded-sm">
        <div class="flex items-center justify-between mb-4">
            <div class="flex relative w-full md:w-1/3">
                <input type="text" id='searchby' placeholder="Search ..." class="custom-search w-full" oninput="search(event)">
                <i class="bx bx-search absolute top-2 right-2"></i>
            </div>
            <!-- <div class=""> -->
            <a href="{{route('admin.classes.create')}}" class="fixed w-12 h-12 bottom-4 right-4 rounded-full btn-blue flex items-center justify-center"><i class="bi bi-person-add text-xl"></i></a>
            <!-- </div> -->
        </div>
        <table class="table-fixed w-full text-sm">
            <thead>
                <tr>
                    <th class="w-16"><i class="bi bi-person-fill"></i></th>
                    <th class="w-32">Role</th>
                    <th class="w-16">Status</th>
                    <th class="w-16"><i class="bi-gear"></i></th>
                </tr>
            </thead>
            <tbody>

                @foreach($users as $user)
                @php $i=0; @endphp
                <tr class="text-sm">
                    <td class="text-left">{{$user->userable->name}}</td>
                    <td class="text-left">@foreach($user->roles as $role)
                        @if($i++!=0) | @endif
                        {{ $role->name }}
                        @endforeach
                    </td>
                    <td>{{$user->status}}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection