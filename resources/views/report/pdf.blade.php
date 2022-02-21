<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>{{$doctor->name}}</title>
</head>

<style>
   * { font-family: DejaVu Sans, sans-serif; }
  body {
      margin: 0;
      padding: 0;
   }
  table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      text-align: center;
      padding: 2px;
      font-size: 10px; 
  }
  h2,h4,h6 {
    margin: 2px 0;
  }
</style>
<body>
    
    <h6>Report generated on : {{ Carbon\Carbon::now()->format('d M Y - H:i:s') }}</h6>
    
    <h4 style="text-align: center; text-decoration: underline">{{$doctor->name}}</h4>
    
    <br>
    <h6>Xrays (Total Xrays - {{ $doctor_xrays->count() }})</h6>
    <table width="100%">
        <tr>
          <th width="7%">#</th>
          <th width="30%">{{ __('sentence.Patient Name') }}</th>
          <th width="30%">{{ __('sentence.Xray Name') }}</th>
          <th width="18%">{{ __('sentence.Date') }}</th>
          <th width="15%">{{ __('sentence.Amount') }}</th>
        </tr>
        @php
            $x = 0;
        @endphp
        @foreach($doctor_xrays as $xray)
        <tr>
          <td>{{ ++$x }}</td>
          <td>{{ $xray->patient_name }}</td>
          <td>{{ $xray->xray_name }}</td>
          <td>{{ Carbon\Carbon::parse($xray->date)->format('d M Y') }}</td>
          <td>{{ App\Setting::get_option('currency') }} {{ $xray->amount }}</td>
        </tr>
        @endforeach
        
        @if ($doctor_xrays->count())
        <tr>
          <td colspan="4" align="center"><strong>{{ __('sentence.Total') }}</strong></td>
          <td colspan="1" align="center">{{ App\Setting::get_option('currency') }} {{ $doctor->total_xray_amount }}</td>
        </tr>
        @else
        <tr>
          <td colspan="5" align="center">{{ __('sentence.No Xrays Available') }}</td>
        </tr>
        @endif
    </table>
    
    <br>
    <h6>Sonography (Total Sonography - {{ $doctor_sonography->count() }})</h6>
    <table width="100%">
        <tr>
          <th width="7%">#</th>
          <th width="30%">{{ __('sentence.Patient Name') }}</th>
          <th width="30%">{{ __('sentence.Sonography Name') }}</th>
          <th width="18%">{{ __('sentence.Date') }}</th>
          <th width="15%">{{ __('sentence.Amount') }}</th>
        </tr>
        @php
            $y = 0;
        @endphp
        @foreach($doctor_sonography as $sonography)
        <tr>
          <td>{{ ++$y }}</td>
          <td>{{ $sonography->patient_name }}</td>
          <td>{{ $sonography->sonography_name }}</td>
          <td>{{ Carbon\Carbon::parse($sonography->date)->format('d M Y') }}</td>
          <td>{{ App\Setting::get_option('currency') }} {{ $sonography->amount }}</td>
        </tr>
        @endforeach
        
        
        @if ($doctor_sonography->count())
        <tr>
          <td colspan="4" align="center"><strong>{{ __('sentence.Total') }}</strong></td>
          <td colspan="1" align="center">{{ App\Setting::get_option('currency') }} {{ $doctor->total_sonography_amount }}</td>
        </tr>
        
        @else
        <tr>
          <td colspan="5" align="center">{{ __('sentence.No Sonography Available') }}</td>
        </tr>
        @endif
    </table>
    
    <br>
    {{-- <h6>Blood Tests (Total Blood Tests - {{ $doctor_blood_tests->count() }})</h6>
    <table width="100%">
        <tr>
          <th width="7%">#</th>
          <th width="30%">{{ __('sentence.Patient Name') }}</th>
          <th width="30%">{{ __('sentence.Blood Test Name') }}</th>
          <th width="18%">{{ __('sentence.Date') }}</th>
          <th width="15%">{{ __('sentence.Amount') }}</th>
        </tr>
        @php
            $z = 0;
        @endphp
        @foreach($doctor_blood_tests as $blood_test)
        <tr>
          <td>{{ ++$z }}</td>
          <td>{{ $blood_test->patient_name }}</td>
          <td>{{ $blood_test->blood_test_name }}</td>
          <td>{{ Carbon\Carbon::parse($blood_test->date)->format('d M Y') }}</td>
          <td>{{ App\Setting::get_option('currency') }} {{ $blood_test->amount }}</td>
        </tr>
        @endforeach

        @if ($doctor_blood_tests->count())
        <tr>
          <td colspan="4" align="center"><strong>{{ __('sentence.Total') }}</strong></td>
          <td colspan="1" align="center">{{ App\Setting::get_option('currency') }} {{ $doctor->total_blood_test_amount }}</td>
        </tr>
        
        @else
        <tr>
          <td colspan="5" align="center">{{ __('sentence.No Blood Tests Available') }}</td>
        </tr>
        @endif
        
    </table> --}}

    <h6 style="text-align: right;">Total - {{ App\Setting::get_option('currency') }} {{$doctor->total_amount}} /-</h6>
</body>

</html>
