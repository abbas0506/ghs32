@extends('layouts.basic')

@section('header')
<x-header></x-header>
@endsection

@section('body')
<section>

    <div class="bg-teal-800 text-teal-50 mt-16 px-5 md:px-24 text-xl py-6">New Application</div>
    <div class="container px-5 md:px-60">
        <div>
            <ul class="list-none text-right">
                <li class="text-red-600 font-bold">اہم ہدایات</li>
                <li>
                    عزیز طلبا، دیے گئے فارم کو احتیاط سے پر کریں، غلط ڈیٹا کی صورت میں آپکا ایڈمشن کینسل بھی ہو سکتا ہے جس کی تمام تر ذمہ داری آپ پر ہوگی
                </li>
                <li>فارم سبمٹ کرنے سے پہلے خاص طور پر اپنا ب فارم نمبر اور میٹرک کے مارکس ضرور چیک کر لیں</li>
            </ul>

        </div>

        <!-- page message -->
        @if($errors->any())
        <x-message :errors='$errors'></x-message>
        @else
        <x-message></x-message>
        @endif

        <form action="{{url('apply')}}" method="post" class="mt-8" onsubmit="return validate(event)">
            @csrf
            <h2>Choose your desired group</h2>
            <div class="grid gap-y-2 mt-3">
                @foreach($groups as $group)
                <div>
                    <input type="checkbox" id='group_id' name="group_id" value="{{ $group->id }}" class="chk-group rounded mr-2">
                    <label for="group_id">{{ $group->name }} ({{ $group->subjects_list }})</label>
                </div>
                @endforeach
            </div>
            <div class="mt-8 md:w-1/2">
                <label for="">Passing Year (میٹرک کب پاس کیا؟)</label>
                <select name="pass_year" id="" class="custom-input">
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024" selected>2024</option>
                </select>
            </div>
            <!-- student info -->
            <div class="grid md:grid-cols-2 gap-4 mt-8">
                <div class="md:col-span-2">
                    <label for="">Your Name (میٹرک کے رزلٹ کارڈ کے مطابق)</label>
                    <input type="text" name="name" class="custom-input" placeholder="Your name" required>
                </div>
                <div class="md:col-span-2">
                    <label for="">Father name</label>
                    <input type="text" name="father" class="custom-input" placeholder="Father name" required>
                </div>
                <div>
                    <label for="">BForm (ب فارم)</label>
                    <input type="text" name="bform" class="custom-input" pattern="\d{13}" placeholder="B Form wituout dashes" required>
                </div>
                <div>
                    <label for="">Phone No</label>
                    <input type="text" name="phone" class="custom-input" placeholder="phone no">
                </div>
                <div>
                    <label for="">Board Name</label>
                    <select name="bise_name" id="" class="custom-input">
                        <option value="sahiwal">Sahiwal Board</option>
                        <option value="other">Other Board</option>
                    </select>
                </div>
                <div>
                    <label for="">Matric Roll No.</label>
                    <input type="number" name="rollno" class="custom-input" placeholder="Roll number" min='0' required>
                </div>
                <div>
                    <label for="">Obtanied Marks</label>
                    <input type="number" name="obtained" id='obtained' class="custom-input" placeholder="Obtained marks" min='0' required>
                </div>
                <div>
                    <label for="">Total Marks</label>
                    <select name="total" id="total" class="custom-input">
                        <option value="1100">1100</option>
                        <option value="1200" selected>1200</option>
                    </select>
                </div>

            </div>
            <div class="text-center mt-8">
                <button class="btn-teal rounded py-3">Submit Application</button>

            </div>
        </form>
    </div>


</section>

<!-- footer -->
<x-footer></x-footer>
@endsection

@section('script')
<script type="module">
    $(document).ready(function() {
        $('.chk-group').click(function() {
            // Uncheck all checkboxes
            $('.chk-group').prop('checked', false);
            // Check the clicked checkbox
            $(this).prop('checked', true);
        });
    });
</script>
<script>
    function validate(event) {
        var validated = true;
        var group_checked = false;
        $('.chk-group').each(function() {
            if ($(this).is(':checked'))
                group_checked = true;
        });

        if (!group_checked) {
            event.preventDefault();
            Swal.fire({
                title: "Warning",
                text: "Please, select a group",
                icon: "warning",
                showConfirmButton: false,
                timer: 1500

            });
        }
        // if (group_checked) {
        //     // then compare obtained and total marks
        //     var obtainded = $('#obtained').val()
        //     var total = $('#total').val()
        //     if (obtainded > total) {
        //         validated = false
        //         Swal.fire({
        //             title: "Warning",
        //             text: "Obtained marks wrong",
        //             icon: "warning",
        //             showConfirmButton: false,
        //             timer: 1500

        //         });
        //     } else {
        //         validated = false
        //         Swal.fire({
        //             title: "Warning",
        //             text: "Please check a group",
        //             icon: "warning",
        //             showConfirmButton: false,
        //             timer: 1500

        //         });
        //     }
        // }
        return validated;
        // return false;

    }
</script>
@endsection