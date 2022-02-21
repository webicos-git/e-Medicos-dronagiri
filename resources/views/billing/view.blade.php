@extends('layouts.master')

@section('title')
{{ __('sentence.View billing') }}
@endsection

@section('content')
<div class="row">
   <div class="col">
      @if ($errors->any())
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      @if (session('success'))
      <div class="alert alert-success">
         {{ session('success') }}
      </div>
      @endif
   </div>
</div>
<div class="row justify-content-center">
   <div class="col">
      <div class="card shadow mb-4">
         <div class="card-body">
            <!-- ROW : Doctor informations -->
            <div class="row">
               <div class="col">
                  {!! clean(App\Setting::get_option('header_left')) !!}
               </div>
               <div class="col-md-3">
                  <p><b>{{ __('sentence.Date') }} :</b> {{ $billing->created_at->format('d-m-Y') }}<br>
                     <b>{{ __('sentence.Reference') }} :</b> {{ $billing->reference }}<br>
                     <b>{{ __('sentence.OPD Number') }} :</b> {{ $billing->opd_no }}<br>
                     <b>{{ __('sentence.Patient Name') }} :</b> {{ $billing->Patient->name }}
                  </p>
               </div>
            </div>
            <!-- END ROW : Doctor informations -->
            <!-- ROW : Medicines List -->
            <div class="row justify-content-center">
               <div class="col">
                  <h5 class="text-center"><b>{{ __('sentence.Invoice') }}</b></h5>
                  <br><br>
                  <table class="table">
                     <tr>
                        <th width="10%">#</th>
                        <th width="60%">{{ __('sentence.Investigations') }}</th>
                        <th width="15%">{{ __('sentence.Amount') }}</th>
                        <th width="15%">Paid/Balance</th>
                     </tr>
                     @forelse ($billing_items as $key => $billing_item)
                     <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $billing_item->invoice_title }}</td>
                        <td>{{ App\Setting::get_option('currency') }} {{ $billing_item->invoice_amount }}</td>
                        <td>{{ $billing_item->invoice_status }}</td>
                     </tr>
                     @empty
                     <tr>
                        <td colspan="3">{{ __('sentence.Empty Invoice') }}</td>
                     </tr>
                     @endforelse
                     @empty(!$billing_item)
                     <tr>
                        <td colspan="2"><strong>Balance</strong></td>
                        <td colspan="2"><strong>{{ App\Setting::get_option('currency') }} {{ $amount_balance }}</strong></td>
                     </tr>
                     <tr>
                        <td colspan="2"><strong>Paid</strong></td>
                        <td colspan="2"><strong>{{ App\Setting::get_option('currency') }} {{ $amount_paid }}</strong></td>
                     </tr>
                     <tr>
                        <td colspan="2"><strong>{{ __('sentence.Total') }}</strong></td>
                        <td colspan="2"><strong>{{ App\Setting::get_option('currency') }} {{ $billing_items->sum('invoice_amount') }}</strong></td>
                     </tr>
                     @endempty
                  </table>
                  <hr>
               </div>
            </div>
            <!-- ROW : Medicines List -->
            <div class="row justify-content-center">
               <div class="col">
                  <hr>
               </div>
            </div>
            <!-- END ROW : Medicines List -->
            <!-- ROW : Footer informations -->
            <div class="row">
               <div class="col">
                  <p>{!! clean(App\Setting::get_option('footer_left')) !!}</p>
               </div>
               <div class="col">
                  <p class="float-right">{!! clean(App\Setting::get_option('footer_right')) !!}</p>
               </div>
            </div>
            <!-- END ROW : Footer informations -->
         </div>
      </div>
   </div>
</div>
@endsection

@section('footer')

@endsection