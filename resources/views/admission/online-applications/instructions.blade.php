@extends('layouts.basic')

@section('header')
<x-header></x-header>
@endsection

@section('body')
<section>

    <head>
        <meta charset="UTF-8">
        <title>Instructions</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- TailwindCSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Google Nastaliq Font -->
        <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu&display=swap" rel="stylesheet">

        <style>
            .nastaliq {
                font-family: 'Noto Nastaliq Urdu', serif;
            }
        </style>
    </head>

    <div class="bg-cover bg-center min-h-screen flex flex-col nastaliq">
        <!-- Instructions Box -->
        <div dir="rtl" class="pt-24 w-full lg:w-2/3  mx-auto bg-white bg-opacity-90 rounded-xl shadow-xl p-6 mt-10">
            <!-- Heading -->
            <div class="text-right">
                <h1 class="text-xl font-bold text-teal-700 drop-shadow-lg">داخلہ فارم پُر کرنے سے متعلقہ ہدایات</h1>
            </div>
            <ul class="space-y-4 text-sm justify-end text-gray-800 leading-relaxed mt-8">
                <li class="flex items-end">
                    <span class="text-blue-600 text-xl ml-2">👈</span>
                    براہ کرم تمام خانوں کو مکمل اور درست طریقے سے پُر کریں۔

                </li>
                <li class="flex items-center">
                    <span class="text-blue-600 text-xl ml-2">👈</span>
                    غلط معلومات فراہم کرنے پر درخواست مسترد کی جا سکتی ہے۔
                </li>
                <li class="flex items-center">
                    <span class="text-blue-600 text-xl ml-2">👈</span>
                    تمام ضروری دستاویزات کو اسکین کرکے اپ لوڈ کریں۔
                </li>
                <li class="flex items-center">
                    <span class="text-blue-600 text-xl ml-2">👈</span>
                    فارم جمع کروانے کے بعد تبدیلی ممکن نہیں ہوگی۔
                </li>
            </ul>


            <div class="text-right mt-12">
                <h1 class="text-xl font-bold text-teal-700 drop-shadow-lg">داخلہ شیڈول</h1>
            </div>
            <div class="overflow-x-auto mt-6">
                <table class="table-auto w-full text-right border border-gray-300 rounded-lg overflow-hidden">
                    <tbody class="text-gray-800">
                        <tr class="border-t">
                            <td class="px-4 py-2 border font-semibold text-red-600"> اپلائی کرنے کی آخری تاریخ </td>
                            <td class="px-4 py-2 border font-semibold text-red-600">Aug 20, 2025</td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-4 py-2 border">کاغذات کی جانچ پڑتال، داخلہ لسٹیں </td>
                            <td class="px-4 py-2 border">Aug 22, 2025</td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-4 py-2 border">فیس جمع کروانے کی آخری تاریخ</td>
                            <td class="px-4 py-2 border">Aug 23, 2025</td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-4 py-2 border">استقبالیہ تقریب ، کلاسز کا آغاز</td>
                            <td class="px-4 py-2 border">Aug 25, 2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- Buttons -->
    <div class="flex justify-center space-x-4 my-10">
        <a href="/" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded shadow">
            Cancel
        </a>
        <a href="{{url('apply')}}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded shadow">
            Start Applying
        </a>
    </div>

</section>
<!-- Popup Modal -->
<div id="popupModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-96 relative p-6 mx-4">
        <!-- Close Button -->
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-lg">
            &times;
        </button>

        <!-- Modal Content -->
        <div class="text-center mt-4 mb-6">
            <h2 class="text-2xl font-bold text-green-800">Welcome!</h2>
            <p class="text-sm text-gray-600 mt-2">Join Us — Admissions 2025 Are Open</p>
        </div>


        <!-- Last date -->
        <div class="flex justify-center">
            <h2 class="text-red-600 font-bold text-md">Last Date to Apply: Aug 20, 2025</h2>
        </div>
    </div>
</div>

<!-- footer -->
<x-footer></x-footer>
@endsection

@section('script')

<script type="module">
    $(document).ready(function() {
        $('#popupModal').removeClass('hidden');
        $('.chk-group').click(function() {
            // Uncheck all checkboxes
            $('.chk-group').prop('checked', false);
            // Check the clicked checkbox
            $(this).prop('checked', true);
        });
    });
</script>
<script>
    function closeModal() {
        $('#popupModal').addClass('hidden');
    }
</script>
@endsection