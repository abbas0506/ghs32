@extends('layouts.basic')

@section('header')
<x-header></x-header>
@endsection

@section('body')
<style>
    body {
        background-color: #6d6d6d;
    }
</style>
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
        <div dir="rtl" class="pt-8 w-full lg:w-2/3  mx-auto bg-white bg-opacity-90 rounded-xl shadow-xl p-6 mt-10">
            <div class="text-right">
                <h1 class="text-xl font-bold text-teal-700 drop-shadow-lg">ضروری ہدایات</h1>
            </div>
            <ul class="space-y-4 text-sm justify-end text-gray-800 leading-relaxed mt-8">
                <li class="flex items-start">
                    <span class="text-blue-600 text-xl ml-2">👈</span>
                    فارم پُر کرنے سے پہلے آپکے پاس سکین شدہ یا کیمرہ سے لی گئی اپنی ایک تصویر ہونی چاہیے جس کا سائز ایک میگا بائٹ سے زیادہ نہ ہو، سائز زیادہ ہونیکی صورت میں اُسے کمپریس کریں۔ اس کیلیے آپ گوگل سے مدد لے سکتے ہیں
                <li class="flex items-start">
                    <span class="text-blue-600 text-xl ml-2">👈</span>
                    فارم سبمِٹ کرنے سے پہلے تسلی کرلیں کہ تمام معلومات درست ہیں کیونکہ فارم جمع کروانے کے بعد تبدیلی ممکن نہیں ہوگی
                </li>
                <li class="flex items-start">
                    <span class="text-blue-600 text-xl ml-2">👈</span>
                    فارم سبمِٹ کرنے بعد اگلا مرحلہ فیس جمع کراناہے۔ نیچے دیے گئے داخلہ شیڈول کے مطابق اوریجنل رزلٹ کاڈ کے ساتھ تشریف لائیں اوراپنی فیس جمع کروائیں۔
                </li>
                <li class="flex items-start">
                    <span class="text-blue-600 text-xl ml-2">👈</span>
                    ساہیوال بورڈ کی بجائے اگر کسی اور بورڈ سے میٹرک پاس کیا ہے تو اُس بورڈ سے این او سی فوری حاصل کریں (رجسٹریشن سے پہلے جمع کروانا لازمی ہے)
                </li>
                <li class="flex items-start">
                    <span class="text-blue-600 text-xl ml-2">👈</span>
                    سب سے اہم بات یہ کہ اپنا گروپ سوچ سمجھ کر منتخب کریں، آنیوالی زندگی میں آپکا یہ فیصلہ انتہائی اہمیت رکھتا ہے۔۔۔ آئی سی ایس یا پری انجینیرنگ کا انتخاب تبھی کریں جب آپ ریاضی میں بہت اچھے ہوں
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
                            <td class="px-4 py-2 border"> ڈیٹا ویری فکیشن اور فیس </td>
                            <td class="px-4 py-2 border">Aug 21, 2025</td>
                        </tr>
                        <tr class="border-t">
                            <td class="px-4 py-2 border">استقبالیہ تقریب ، کلاسز کا آغاز</td>
                            <td class="px-4 py-2 border">Aug 25, 2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Buttons -->
            <div dir='ltr' class="font-sans flex justify-center space-x-4 my-10">
                <a href="/" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded shadow">
                    Cancel
                </a>
                <a href="{{url('apply')}}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded shadow">
                    Start Applying
                </a>
            </div>

        </div>

    </div>


</section>
<!-- Popup Modal -->
<div id="popupModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl w-96 relative p-6 mx-4">
        <!-- Close Button -->
        <button onclick="closeModal()" class="absolute top-0 right-2 text-gray-500 hover:text-red-500 text-lg">
            &times;
        </button>

        <!-- Modal Content -->
        <div class="text-center mt-4 mb-6">
            <h2 class="text-2xl font-bold text-green-800">Welcome!</h2>
            <p class="text-sm text-gray-600 mt-2">We are excited to have you here</p>
        </div>


        <!-- Last date -->
        <div class="flex justify-center">
            <h2 class="text-red-600 font-bold text-md">Last Date : Aug 20, 2025</h2>
        </div>
    </div>
</div>

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