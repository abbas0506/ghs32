@extends('layouts.basic')

@section('header')
<x-header></x-header>
@endsection

@section('body')
<style>
    body {
        background-color: #f1f5f9;
    }

    .sticky-header {
        background-color: #0d9488;
    }

    @keyframes waveGlow {
        0% {
            box-shadow: 0 0 0px rgba(13, 148, 136, 0.6);
        }

        50% {
            box-shadow: 0 0 10px 4px rgba(13, 148, 136, 0.4);
        }

        100% {
            box-shadow: 0 0 0px rgba(13, 148, 136, 0.6);
        }
    }

    .fancy-focus:focus {
        border-color: #0d9488;
        /* teal-600 */
        background-color: transparent;
        animation: waveGlow 1s ease-in-out infinite;
        outline: none;
    }

    .photo-box {
        width: 150px;
        height: 150px;
        border: 2px dashed #ccc;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #aaa;
        font-size: 18px;
        margin-bottom: 10px;
        background-color: #f9f9f9;
        border-radius: 8px;
        position: relative;
        overflow: hidden;
    }

    .photo-upload-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .custom-file-upload {
        background-color: #007bff;
        color: white;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        text-align: center;
        transition: background-color 0.3s;
    }

    .custom-file-upload:hover {
        background-color: #0056b3;
    }

    input[type="file"] {
        display: none;
    }
</style>

<section>
    <div class="max-w-full m-5 md:mx-auto lg:w-2/3 rounded border shadow-lg p-5 md:p-16 mt-24 bg-white">
        <div class="text-teal-800  text-xl text-center font-bold text-decoration underline underline-offset-4">Admission Form</div>
        <div class="px-5">
            <!-- page message -->
            @if($errors->any())
            <x-message :errors='$errors'></x-message>
            @else
            <x-message></x-message>
            @endif

            <form action="{{url('apply')}}" method="post" class="mt-8 w-full" enctype="multipart/form-data">
                @csrf

                <div class="photo-upload-wrapper">
                    <!-- Placeholder Photo Box -->
                    <div class="photo-box" id="photoPreview">
                        Photo
                    </div>

                    <!-- Custom Upload Button -->
                    <label for="img" class="custom-file-upload">Upload Your Photo</label>
                    <input type="file" id="img" name="img" accept="image/*" onchange="previewSelectedPhoto(event)">
                </div>


                <h2 class="mt-8">Choose your desired group</h2>
                <div class="grid gap-y-2 mt-3">
                    @foreach($groups as $group)
                    <div>
                        <input type="checkbox" id='group_id_{{$group->id}}' name="group_id" value="{{ $group->id }}" class="chk-group rounded mr-2">
                        <label for="group_id_{{$group->id}}">{{ $group->name }} ({{ $group->subjects_list }})</label>
                    </div>
                    @endforeach
                </div>
                <div class="mt-8 md:w-1/2">
                    <label for="">Passing Year (میٹرک کب پاس کیا؟)</label>
                    <select name="pass_year" id="" class="custom-input fancy-focus">
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025" selected>2025</option>
                    </select>
                </div>
                <!-- student info -->
                <div class="grid md:grid-cols-2 gap-4 mt-8">
                    <div class="md:col-span-2">
                        <label for="">Student Name (میٹرک کے رزلٹ کارڈ کے مطابق)</label>
                        <input type="text" name="name" class="custom-input fancy-focus" placeholder="Student name" required>
                    </div>
                    <div class="md:col-span-2">
                        <label for="">Father name</label>
                        <input type="text" name="father" class="custom-input fancy-focus" placeholder="Father name" required>
                    </div>
                    <div>
                        <label for="">BForm (ب فارم)</label>
                        <input type="text" name="bform" id='bform' class="custom-input fancy-focus" placeholder="x x x x x - x x x x x x x - x" required>
                    </div>
                    <div>
                        <label for="">Phone No</label>
                        <input type="text" name="phone" id='phone' class="custom-input fancy-focus" placeholder="x x x x - x x x x x x x" required>
                    </div>
                    <div>
                        <label for="">Board Name</label>
                        <select name="bise_name" id="" class="custom-input fancy-focus">
                            <option value="sahiwal">Sahiwal Board</option>
                            <option value="other">Other Board</option>
                        </select>
                    </div>
                    <div>
                        <label for="">Matric Roll No.</label>
                        <input type="number" name="rollno" class="custom-input fancy-focus" placeholder="Roll number" min=0 required>
                    </div>
                    <div>
                        <label for="">Obtanied Marks</label>
                        <input type="number" name="obtained" id='obtained' class="custom-input fancy-focus" placeholder="Obtained marks" min='0' max='1200' required>
                    </div>
                    <div>
                        <label for="">Total Marks</label>
                        <select name="total" id="total" class="custom-input fancy-focus">
                            <option value="1100">1100</option>
                            <option value="1200" selected>1200</option>
                        </select>
                    </div>

                </div>
                <div class="flex  space-x-3 text-center mt-8">
                    <button class="btn-gray rounded py-3">Cancel</button>
                    <button class="btn-blue rounded py-3">Submit Application</button>

                </div>
            </form>
        </div>
    </div>

</section>

<!-- footer
<x-footer></x-footer> -->
@endsection

@section('script')

<script type="module">
    $(document).ready(function() {
        $('.chk-group').on('change', function() {
            $('.chk-group').not(this).prop('checked', false); // Uncheck all except clicked one
        });

        $('#bform').on('input', function() {
            let value = $(this).val().replace(/\D/g, '').substring(0, 13);
            let formatted = value;
            if (value.length > 5) formatted = value.substring(0, 5) + '-' + value.substring(5);
            if (value.length > 12) formatted = formatted.substring(0, 13) + '-' + value.substring(12);
            $(this).val(formatted);
        });

        // Auto-insert dash for Phone
        $('#phone').on('input', function() {
            let value = $(this).val().replace(/\D/g, '').substring(0, 12);
            let formatted = value;
            if (value.length > 4) formatted = value.substring(0, 4) + '-' + value.substring(4);
            $(this).val(formatted);
        });

        $('form').on('submit', function(e) {
            if (!$('.chk-group:checked').length) {
                Swal.fire({
                    title: "Warning",
                    text: "Please, select a group",
                    icon: "warning",
                    showConfirmButton: false,
                    timer: 1500

                });
                e.preventDefault();
            }
        });
    });
</script>
<script>
    function previewSelectedPhoto(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const photoBox = document.getElementById('photoPreview');
            photoBox.style.backgroundImage = `url('${reader.result}')`;
            photoBox.style.backgroundSize = 'cover';
            photoBox.style.backgroundPosition = 'center';
            photoBox.textContent = ''; // Remove "Photo" placeholder
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection