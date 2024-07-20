<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Codes</title>
    <link href="{{public_path('css/pdf_tw.css')}}" rel="stylesheet">
    <style>
        @page {
            margin: 50px 80px 50px 50px;
        }

        .footer {
            position: fixed;
            bottom: 50px;
            left: 30px;
            right: 30px;
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
            /* padding-bottom: 2px; */
            border: 0.5px solid;
        }
    </style>
</head>

<body>
    <main>
        <div class="custom-container">

            <div class="w-1/2 mx-auto">
                <div class="relative">
                    <div class="absolute"><img alt="logo" src="{{public_path('/images/logo/school_logo.png')}}" class="w-16"></div>
                </div>
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td class="text-center text-xl font-bold">QR Codes </td>
                        </tr>
                        <tr>
                            <td class="text-center text-sm">Govt. Higher Secondary School Chak Bedi, Pakpattan</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- table header -->
            <div class="mt-8">
                <table class="w-full">
                    <tbody>
                        <tr class="text-xs">
                            <td class="text-left">Printed on {{ now()->format('d-M-Y')}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @php
            $i=0;
            $numOfQrPerRow=6;
            @endphp

            <table class="table-auto w-full mt-2">
                <tbody>
                    @php $copy_sr=''; @endphp
                    @foreach($books as $book)
                    @for($copy_sr=1; $copy_sr<=$book->num_of_copies;$copy_sr++)

                        @if($i%$numOfQrPerRow==0)<tr class="text-sm">@endif

                            <td class="py-2">
                                <div class="text-left">
                                    <div>{!! DNS2D::getBarcodeHTML($book->reference()."-".$copy_sr, 'QRCODE',4,4) !!}</div>
                                    <span class="text-xs pl-5">{{$book->reference()}}-{{$copy_sr}}</span>
                                </div>
                            </td>
                            @if($i%$numOfQrPerRow==$numOfQrPerRow-1)
                        </tr>@endif
                        @php $i++; @endphp
                        @endfor
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