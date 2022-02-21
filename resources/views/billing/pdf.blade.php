<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>e-Medicos - Invoice</title>
</head>

<style>
   * { font-family: DejaVu Sans, sans-serif; }
   body {
      margin: 0;
      padding: 0;
      font-size: 10px;
   }
   table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
      text-align: center;
      padding: 2px;
      font-size: 10px;
   }
   h2,h4,h5 {
      margin: 2px 0;
   }
   @page { margin-top: 120px; margin-bottom: 120px}
   header { 
      position: fixed; 
      left: 0px; 
      top: -90px;
      right: 0px; 
      height: 150px; 
      text-align: center; 
   }
   footer { 
      position: fixed; 
      left: 0px; 
      bottom: -145px; 
      right: 0px; 
      height: 150px;
      text-align: center; 
   }
</style>

<body>
   <script type="text/php">
      if ( isset($pdf) ) {
          $y = $pdf->get_height() - 20; 
          $x = $pdf->get_width() - 15 - 50;
          $pdf->page_text($x, $y, "Page No: {1} of {1}", '', 8, array(0,0,0));
      }
  </script> 

  <header style="width: 100%; margin-top: 0px; margin-bottom: 15px;">
      <img src="{{ public_path('img/dd-logo.png') }}" alt="Doctor Logo" width="75%" height="110">
  </header>
  
   <footer>
      <p>
         Shop No. 1, Shreyas CHS, Opp. Veer  Savarkar  Maidan, Anand Nagar Junction
         <br>
         Uran – 400702, Dist - Raigad
      </p>
   </footer>


   <p>
      <b>{{ __('sentence.Date') }} :</b> {{ $billing->created_at->format('d-m-Y') }}<br>
      <b>{{ __('sentence.OPD Number') }} :</b> {{ $billing->opd_no }}<br>
      <b>{{ __('sentence.PAN Number') }} :</b> {{ env('PAN_NUMBER') }}<br>
      <b>{{ __('sentence.Patient Name') }} :</b> {{ $billing->Patient->name }}
   </p>

   <h2 style="text-align: center">{{ __('sentence.Invoice') }}</h2>

   <table width="100%">
      <tr>
         <th width="10%">#</th>
         <th width="50%">{{ __('sentence.Investigations') }}</th>
         <th width="20%">Paid/Balance</th>
         <th width="20%">{{ __('sentence.Amount') }}</th>
      </tr>
      @forelse ($billing_items as $key => $billing_item)
      <tr>
         <td>{{ $key+1 }}</td>
         <td>{{ $billing_item->invoice_title }}</td>
         <td>{{ $billing_item->invoice_status }}</td>
         <td>{{ App\Setting::get_option('currency') }} {{ $billing_item->invoice_amount }}</td>
      </tr>
      @empty
      <tr>
         <td colspan="3">{{ __('sentence.Empty Invoice') }}</td>
      </tr>
      @endforelse
      @empty(!$billing_item)
      <tr>
         <td colspan="3"><strong>Balance</strong></td>
         <td colspan="1">
            <strong>
               {{ App\Setting::get_option('currency') }} {{ $amount_balance }}
            </strong>
         </td>
      </tr>
      <tr>
         <td colspan="3"><strong>Paid</strong></td>
         <td colspan="1">
            <strong>
               {{ App\Setting::get_option('currency') }} {{ $amount_paid }}
            </strong>
         </td>
      </tr>
      <tr>
         <td colspan="3"><strong>{{ __('sentence.Total') }}</strong></td>
         <td colspan="1">
            <strong>
               {{ App\Setting::get_option('currency') }} {{ $billing_items->sum('invoice_amount') }}
            </strong>
         </td>
      </tr>
      @endempty
   </table>

   <p style="text-align: right; margin-top: 120px; font-weight: bold;">
      Authorized Signature
   </p>
</body>

</html>