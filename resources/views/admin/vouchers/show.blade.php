@extends('layouts.admin')
@section('page-content')
    <h2>
        Voucher # {{ $voucher->id }}</h2>
    <div class="bread-crumb">
        <a href="/">Home</a>
        <div>/</div>
        <a href="{{ route('admin.vouchers.index') }}">Vouchers</a>
        <div>/</div>
        <div>Edit</div>
    </div>

    <div class="grid md:grid-cols-3 md:w-4/5 mx-auto mt-6 bg-white md:p-8 p-4 rounded border">
        <div class="md:col-span-2 text-slate-400 text-sm">
            Removing voucher is a destructive activity.
            It will destory all fee info against this voucher.
            Remove only if you are sure!
        </div>
        <div class="text-right">
            <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST" id='del_form{{ $voucher->id }}'>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-red rounded px-5 py-2" onclick="delme('{{ $voucher->id }}')">
                    <i class="bi-trash3 text-white"></i> Remove
                </button>
            </form>
        </div>
    </div>

    <!-- message -->
    <div class="md:w-3/4 mx-auto">
        @if ($errors->any())
            <x-message :errors='$errors'></x-message>
        @else
            <x-message></x-message>
        @endif
    </div>

    {{-- voucher info --}}
    <div class="md:w-4/5 mx-auto bg-white md:p-8 p-4 rounded border mt-3">
        <h2> <i class="bi-receipt text-slate-500"></i> Voucher Info</h2>
        <form action="{{ route('admin.vouchers.update', $voucher) }}" method='post' class="w-full grid gap-6"
            onsubmit="return validate(event)">
            @csrf
            @method('PUT')
            <div class="grid md:grid-cols-2 gap-2">
                <div class="md:col-span-2">
                    <label>Voucher Title</label>
                    <input type="text" name='name' class="custom-input" placeholder="For example: December Fee"
                        value="{{ $voucher->name }}" required>
                </div>
                <div class="">
                    <label>Amount (Rs.)</label>
                    <input type="number" name='amount' class="custom-input text-center" placeholder="Amount"
                        value="{{ $voucher->amount }}" required>
                </div>
                <div>
                    <label>Due Date</label>
                    <input type="date" name='due_date' class="custom-input text-center" placeholder="Due date"
                        value="{{ optional($voucher->due_date)->format('Y-m-d') }}" required>
                </div>
            </div>
            <div class="text-right">

                <button type="submmit" class="btn-blue rounded py-2 px-5">Update</button>
            </div>
        </form>
    </div>

    {{-- voucher papers --}}
    <div class="md:w-4/5 mx-auto bg-white md:p-8 p-4 rounded border mt-3">
        <h2 class="mb-4"><i class="bi-people-fill text-slate-500"></i> Voucher Payers</h2>
        <table class="table-auto borderless w-full">
            <thead>
                <tr>
                    <th class="w-2/3">Class</th>
                    <th><i class="bi-people"></i></th>
                    <th><i class="bi-gear"></i></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sections as $section)
                    <tr class="tr">
                        <td>{{ $section->fullName() }}</td>
                        <td>{{ $voucher->students->where('section_id', $section->id)->count() }}</td>
                        <td><a href="{{ route('admin.voucher.section.payers.index', [$voucher, $section]) }}">
                                <i class="bx bx-pencil text-green-600"></i>
                            </a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

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

    <script>
        function delme(formid) {

            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    //submit corresponding form
                    $('#del_form' + formid).submit();
                }
            });
        }
    </script>
@endsection
