<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Cards</title>
    <link href="{{public_path('css/pdf_tw.css')}}" rel="stylesheet">
    <style>
        @page {
            margin: 50px 80px;
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
            padding-left: 4px;
            padding-right: 4px;
            /* text-align: left; */
        }

        .border {
            border: solid 0.1px;
        }
    </style>
</head>
@php
$roman = config('global.romans');
@endphp

<body>

    <main>
        <div class="container">
            <!-- front page ... section gazzet -->

            @foreach($section->students as $student)
            @if(($loop->index+1)%2==0)
            <div class="mt-20"></div>
            @endif
            <div class="w-1/2 mx-auto">
                <div class="relative">
                    <div class="absolute"><img alt="logo" src="{{public_path('/images/logo/school_logo.png')}}" class="w-16"></div>
                </div>
                <table class="w-full">
                    <tbody>
                        <tr>
                            <td class="text-center text-lg font-bold">Report Card - {{ $test->title }}</td>
                        </tr>
                        <tr>
                            <td class="text-center text-sm font-bold">Govt Higher Secondary School Chak Bedi, Pakpattan</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <table class="table-auto w-full mt-4" cellspacing="0">
                <thead>
                    <tr>
                        <th class="w-24 "></th>
                        <th class="w-6"></th>
                        <th class=""></th>
                    </tr>
                </thead>
                <tbody class="data">

                    <tr>
                        <td class="text-left">Student</td>
                        <td>:</td>
                        <td class="text-left">{{ $student->name }}</td>
                    </tr>
                    <tr>
                        <td class="text-left">Father</td>
                        <td>:</td>
                        <td class="text-left">{{ $student->father }}</td>
                    </tr>
                    <tr>
                        <td class="text-left">Class</td>
                        <td>:</td>
                        <td class="text-left">{{ $section->roman() }}</td>
                    </tr>
                    <tr>
                        <td class="text-left">Roll No.</td>
                        <td>:</td>
                        <td class="text-left">{{ $student->rollno }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table-auto w-full mt-4" cellspacing="0">
                <thead class="data">
                    <tr class="border">
                        <th>Sr</th>
                        <th>Subject</th>
                        <th>Total</th>
                        <th>Marks</th>
                        <th>%</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="data">

                    @php
                    $obtained=$student->results()->test($test->id)->get()->sum('obtained_marks');
                    $total=0;
                    @endphp
                    @foreach($student->results()->test($test->id)->get() as $result)
                    @php
                    $percentage=round( $result->obtained_marks/$result->testAllocation->total_marks*100,0);
                    @endphp
                    <tr class="border">
                        <td>{{ $loop->index+1 }}</td>
                        <td class="text-left">{{ $result->testAllocation->allocation->subject->name }}</td>
                        <td>{{ $result->testAllocation->total_marks }}</td>
                        <td>{{ $result->obtained_marks }}</td>
                        <td>{{ $percentage }} %</td>
                        <td>@if($percentage>=33) P @else F @enidf</td>
                    </tr>
                    @php
                    $total+=$result->testAllocation->total_marks;
                    @endphp
                    @endforeach
                    <tr>
                        <td colspan="5" style="padding-top:16px">
                            @if($total!=0)
                            <span class="font-bold">Overall Marks:</span> {{ $obtained }} / {{ $total }} = {{ round($obtained/$total*100,2) }} % <span class="text-white">-------</span> <span class="font-bold"> Class Position:</span> {{ $student->testRank($sortedResult) }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="pt-4 text-left"></td>
                    </tr>

                    <tr>
                        <td colspan="5">
                            <div class="p-4 text-left" style="border:solid 0.1px">Comments:</div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="w-full mt-10">
                <thead>
                    <tr>
                        <th class="w-32"></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="w-32"></th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <tr>
                        <td>
                            <div class="pt-2" style="border-top:solid 0.1px">Parents</div>
                        </td>
                        <td colspan="3"></td>
                        <td>
                            <div class="pt-2" style="border-top:solid 0.1px">Principal</div>
                        </td>
                    </tr>
                </tbody>
            </table>
            @if(($loop->index+1)%2==0 && !$loop->last)
            <div class="page-break"></div>
            @endif
            @endforeach
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