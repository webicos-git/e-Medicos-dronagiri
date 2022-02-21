@extends('layouts.master')

@section('title')
{{ __('sentence.Billing List') }}
@endsection

@section('content')

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
<!-- DataTables  -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
         <div class="col-8">
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.Billing List') }}</h6>
         </div>
         {{-- <div class="col-4">
            <a href="{{ route('billing.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> {{ __('sentence.Create Invoice') }}</a>
         </div> --}}
      </div>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>{{ __('sentence.Patient') }}</th>
                  <th>{{ __('sentence.OPD Number') }}</th>
                  <th>{{ __('sentence.Date') }}</th>
                  <th>{{ __('sentence.Amount') }}</th>
                  <th>{{ __('sentence.Status') }}</th>
                  <th>{{ __('sentence.Actions') }}</th>
               </tr>
            </thead>
            <tbody>
               @foreach($invoices as $invoice)
               <tr>
                  <td>{{ $invoice->id }}</td>
                  <td><a href="{{ url('patient/view/'.$invoice->patient_id) }}"> {{ $invoice->Patient->name }} </a></td>
                  <td>{{ $invoice->opd_no }}</td>
                  <td>{{ $invoice->created_at->format('d M Y') }}</td>
                  <td>{{ App\Setting::get_option('currency') }} {{ $invoice->Items->sum('invoice_amount')}}</td>
                  <td>
                     @if($invoice->payment_status == 'Unpaid')
                     <a href="{{ url('billing/edit/'.$invoice->id) }}" class="btn btn-danger btn-icon-split btn-sm">
                     <span class="icon text-white-50">
                     <i class="fas fa-hourglass-start"></i>
                     </span>
                     <span class="text">{{ __('sentence.Unpaid') }}</span>
                     </a>
                     @elseif($invoice->payment_status == 'Paid')
                     <a href="{{ url('billing/edit/'.$invoice->id) }}" class="btn btn-success btn-icon-split btn-sm">
                     <span class="icon text-white-50">
                     <i class="fas fa-check"></i>
                     </span>
                     <span class="text">{{ __('sentence.Paid') }}</span>
                     </a>
                     @else
                     <a href="{{ url('billing/edit/'.$invoice->id) }}" class="btn btn-warning btn-icon-split btn-sm">
                     <span class="icon text-white-50">
                     <i class="fas fa-user-times"></i>
                     </span>
                     <span class="text">{{ $invoice->payment_status }}</span>
                     </a>
                     @endif
                  </td>
                  <td>
                     <a href="{{ url('billing/view/'.$invoice->id) }}" class="btn btn-success btn-circle btn-sm"><i class="fa fa-eye"></i></a>
                     <a href="{{ url('billing/pdf/'.$invoice->id) }}" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-print"></i></a>
                     <a href="{{ url('billing/delete/'.$invoice->id) }}" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                     <a href="{{ url('billing/edit/'.$invoice->id) }}" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection