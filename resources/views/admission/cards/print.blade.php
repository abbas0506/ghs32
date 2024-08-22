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

            <!-- <div class="w-1/2 mx-auto">
                <div class="relative">
                    <div class="absolute"><img alt="logo" src="{{public_path('/images/logo/school_logo.png')}}" class="w-16"></div>
                </div>
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td class="text-center text-xl font-bold">Student Cards </td>
                        </tr>
                        <tr>
                            <td class="text-center text-sm">Govt. Higher Secondary School Chak Bedi, Pakpattan</td>
                        </tr>
                    </tbody>
                </table>
            </div> -->

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
                    @foreach($applications as $application)
                    @if($i%$numOfCardsPerRow==0)<tr class="text-sm">@endif
                        <td class="p-6">
                            <div class="border p-2">
                                <div class="font-semibold mt-1">{{ $application->name }}</div>
                                <div class="border w-20 h-20 m-auto mt-3"></div>
                                <div class="text-xs mt-2">Session 2024-26</div>
                                <div class="font-bold text-lg mt-1">{{ $application->group->name }}</div>
                                <div class="flex flex-col m-auto mt-2">
                                    <div id='qr' style="margin-left:76px">{!! DNS2D::getBarcodeHTML($application->bform,'QRCODE',2,2) !!}</div>
                                    <p class="text-xs mt-2">Valid up to: August 2026</p>
                                    <p class="text-xs mt-2">Govt. Higher Secondary School Chak Bedi, Pakpattan</p>

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