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
                                <div><img src="{{public_path('images/logo/school_logo.png')}}" alt="" width="32px" height="32px"></div>
                                <p class="text-xs mt-2">Govt. Higher Secondary School Chak Bedi, Pakpattan</p>

                                <div class="w-24 h-24 m-auto mt-3">
                                    @if ($application->photo)
                                    <img src="{{ public_path('storage/' . $application->photo) }}"
                                        style="width:80px; height:80px; border-radius:50%; border:1px solid #333; object-fit:cover;">
                                    @else
                                    <span style="color: #999;">No Photo</span>
                                    @endif
                                </div>
                                <div class="font-bold" style="color:blue">{{ $application->name }}</div>
                                <div class="text-md mt-2">Grade {{ $application->grade }}, {{ $application->group->name }}</div>
                                <div class="text-xs mt-1">{{ date('Y') }}-{{date('y')+1}}</div>
                                <table width="100%" style="margin-top: 24px;">
                                    <tr>
                                        <!-- QR Code on Left -->
                                        <td style="text-align: left;">
                                            {!! DNS2D::getBarcodeHTML($application->bform, 'QRCODE', 2, 2) !!}
                                        </td>

                                        <!-- Signature on Right -->
                                        <td style="text-align: right; padding-right:8px">
                                            <div style="text-align: center; display: inline-block;">
                                                <img src="{{public_path('images/principal/sign.png')}}" alt="" width="32px" height="32px">
                                                <span style="display: block; border-top: 1px solid #000; width: 80px; margin-top: 5px;"></span>
                                                <span>Principal</span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
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