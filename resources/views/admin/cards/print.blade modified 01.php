<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Cards</title>
    <link href="{{public_path('css/pdf_tw.css')}}" rel="stylesheet">
    <style>
        @page {
            margin: 10px;
        }

        .footer {
            position: fixed;
            bottom: 50px;
            left: 0px;
            right: 0px;
            background-color: white;
            height: 50px;
        }

        .page-break {
            page-break-after: always;
        }

        .data tr th,
        .data tr td {
            font-size: 12px;
            text-align: center;
            /* border-spacing: 40px;
            border: 0.5px solid; */
            /* margin: 20px */
        }

        .border {
            border: solid 1px;
        }
    </style>
</head>
@php
$roman = config('global.romans');
@endphp

<body>

    <main>
        <div class="custom-container">

            <!-- table header -->
            <div>
                <table class="w-full">
                    <tbody>
                        <tr class="text-xs">
                            <td class="text-left">Student Cards</td>
                            <td class="text-right">Printed on {{ now()->format('d-M-Y')}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @php $i=1; @endphp

            @php
            $i=0;
            $numOfCardsPerRow=3;
            @endphp

            <table class="table-auto w-full mt-2" cellspacing="0">
                <tbody class="data">
                    @foreach($students as $student)
                    @if($i%$numOfCardsPerRow==0)<tr class="text-sm">@endif
                        <td class="p-6">
                            <div class="border p-2">
                                <table>
                                    <tbody>

                                        <tr>

                                            <td class="text-left">

                                                <img src="{{public_path('images/logo/app_logo_transparent.png')}}" alt="logo" class="w-20">
                                            </td>
                                            <td>
                                                <p class="text-left text-xs">Govt. Higher Secondary School Chak Bedi, Pakpattan</p>
                                                <!-- <div class="text-left"></div>
                                                <div class="text-left"></div> -->
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p class="text-xs"> </p>
                                <!-- image box -->
                                <div class="border w-28 h-32 m-auto mt-4" style="color: #777"></div>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div id='qr' class="mt-6" style="margin-left:6px">{!! DNS2D::getBarcodeHTML($student->bform,'QRCODE',2,2) !!}</div>
                                            </td>
                                            <td>
                                                <div class="font-bold text-left pl-3 mt-4">
                                                    <div>{{ $student->name }}</div>
                                                    <div>{{ $student->section->roman() }} ({{ $student->rollno }})</div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- <div class="text-xs mt-2">2024</div> -->
                                <div class="font-bold text-lg mt-2"></div>

                                <div class="flex flex-col m-auto mt-2">

                                    <p class="text-xs mt-3">Valid up to: March 2026</p>


                                </div>
                            </div>
                        </td>

                        @if($i%$numOfCardsPerRow==$numOfCardsPerRow-1)
                    </tr>@endif
                    @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>

    </main>

    <script type="text/php">
        if (isset($pdf) ) {
            $x = 285;
            $y = 20;
            $text = "{PAGE_NUM} of {PAGE_COUNT}";
            $font = $fontMetrics->get_font("helvetica", "bold");
            $size = 6;
            $color = array(0,0,0);
            $word_space = 0.0;  //  default
            $char_space = 0.0;  //  default
            $angle = 0.0;   //  default
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script>

</body>

</html>