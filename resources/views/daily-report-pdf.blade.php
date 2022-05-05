<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Daily Patient Report - {{ $date }}</title>
</head>

<style>
   * { font-family: DejaVu Sans, sans-serif; }
  body {
      margin: 0;
      padding: 0;
      font-size: 8px;
   }
  table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      text-align: center;
      padding: 2px 5px;
      font-size: 8px;
  }
  h2,h4,h5,h6,p {
      margin: 0;
   }
</style>
<body>
    
    <p>Report generated for : {{ $date }}</p>
    
    <p style="text-align: center; font-weight: bold">Daily Patient Report </p>

    <table id="dataTable" width="100%">
        <thead>
           <tr style="text-align: left;">
              <th width="5%">#</th>
              <th width="20%">{{ __('sentence.Patient Name') }}</th>
              <th width="17%">{{ __('sentence.Referred Doctor') }}</th>
              <th width="35%">{{ __('sentence.Investigations') }}</th>
              <th width="13%">{{ __('sentence.Payment Mode') }}</th>
              <th width="10%">{{ __('sentence.Amount') }}</th>
           </tr>
        </thead>
        <tbody>
           @foreach ($total_patients_today as $i => $patient)
              <tr>
                 <td>{{ $i+1 }}</td>
                 <td>{{ $patient->patient_name }}</td>
                 <td>{{ $patient->doctor_name }}</td>
                 <td style="text-align: left;">{{ $patient->investigations }}</td>
                 <td>{{ $patient->payment_mode }}</td>
                 <td>{{ App\Setting::get_option('currency') }} {{ $patient->amount }}</td>
              </tr>
           @endforeach
           @empty(!$total_patients_today)
           <tr>
               <td colspan="5"><strong>{{ __('sentence.Total') }}</strong></td>
               <td colspan="1">
                  <strong>
                     {{ App\Setting::get_option('currency') }} {{ $total_patients_today->sum('amount') }}
                  </strong>
               </td>
            </tr>
           @endempty
        </tbody>
     </table>
</body>

</html>
