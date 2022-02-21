@extends('layouts.master')

@section('title')
{{ __('sentence.New Appointment') }}
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
   <div class="col-md-10">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.New Appointment') }}</h6>
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-md-4 col-sm-12">
                  <div class="form-group">
                     <label for="exampleInputEmail1">{{ __('sentence.Patient') }} </label>
                     <select class="form-control patient_name" id="patient_name">
                        <option>{{ __('sentence.Select Patient') }}</option>
                        @foreach($patients as $patient)
                        <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                        @endforeach
                     </select>
                     <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                  </div>
                  <div class="form-group">
                     <label for="exampleInputPassword1">{{ __('sentence.Date') }}</label>
                     <input type="text" class="form-control target" readonly="readonly" id="rdvdate">
                  </div>
               </div>
               <div class="col-md-8 col-sm-12">
                  <label for="date">{{ __('sentence.Available Times') }}</label> 
                  <hr>
                  <div class="row mb-2 myorders"></div>
                  <div class="alert alert-danger" role="alert" id="help-block">
                     {{ __('sentence.No date selected') }}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Appointment Modal-->
<div class="modal fade" id="RDVModalSubmit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('sentence.Are you sure of the date') }}</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <p><b>{{ __('sentence.Patient') }} :</b> <span id="patient_name"></span></p>
            <p><b>{{ __('sentence.Date') }} :</b> <span id="rdv_date"></span></p>
            <p><b>{{ __('sentence.Time Slot') }} :</b> <span id="rdv_time"></span></p>
         </div>
         <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('sentence.Cancel') }}</button>
            <a class="btn btn-primary text-white"
               onclick="event.preventDefault();
               document.getElementById('rdv-form').submit();">{{ __('sentence.Save') }}</a>
            <form id="rdv-form" action="{{ route('appointment.store') }}" method="POST" class="d-none">
               <input type="hidden" name="patient" id="patient_input">
               <input type="hidden" name="rdv_time_date" id="rdv_date_input">
               <input type="hidden" name="rdv_time_start" id="rdv_time_start_input">
               <input type="hidden" name="rdv_time_end" id="rdv_time_end_input">
               @csrf
            </form>
         </div>
      </div>
   </div>
</div>
@endsection

@section('header')

@endsection

@section('footer')

@endsection