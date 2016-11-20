<!DOCTYPE html>
<html>
    <head>
        <title>Rota</title>


        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <h1>Rota</h1>
        <table class="rota">
            <thead class="rota-head">
                <tr>
                    <th>User</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
                </tr>
            </thead>
            <tbody class="rota-body">
            @foreach ($rota as $day)
                <tr class="rota-staff">
                    <td>{{$day->id}}</td>
                    <td>@if($day->shift[0]['start'] && $day->shift[0]['end']){{$day->shift[0]['start']}} - {{$day->shift[0]['end']}} @else Day Off @endif</td>
                    <td>@if($day->shift[1]['start'] && $day->shift[1]['end']){{$day->shift[1]['start']}} - {{$day->shift[1]['end']}} @else Day Off @endif</td>
                    <td>@if($day->shift[2]['start'] && $day->shift[2]['end']){{$day->shift[2]['start']}} - {{$day->shift[2]['end']}} @else Day Off @endif</td>
                    <td>@if($day->shift[3]['start'] && $day->shift[3]['end']){{$day->shift[3]['start']}} - {{$day->shift[3]['end']}} @else Day Off @endif</td>
                    <td>@if($day->shift[4]['start'] && $day->shift[4]['end']){{$day->shift[4]['start']}} - {{$day->shift[4]['end']}} @else Day Off @endif</td>
                    <td>@if($day->shift[5]['start'] && $day->shift[5]['end']){{$day->shift[5]['start']}} - {{$day->shift[5]['end']}} @else Day Off @endif</td>
                    <td>@if($day->shift[6]['start'] && $day->shift[6]['end']){{$day->shift[6]['start']}} - {{$day->shift[6]['end']}} @else Day Off @endif</td>
                </tr>
            @endforeach
                <tr class="rota-hours">
                    <td>Hours</td>
                    <td>{{$hpd['0']}}</td>
                    <td>{{$hpd['1']}}</td>
                    <td>{{$hpd['2']}}</td>
                    <td>{{$hpd['3']}}</td>
                    <td>{{$hpd['4']}}</td>
                    <td>{{$hpd['5']}}</td>
                    <td>{{$hpd['6']}}</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
