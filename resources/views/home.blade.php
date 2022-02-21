@extends('layouts.master')

@section('title')
{{ __('sentence.Dashboard') }}
@endsection

@section('content')
<div class="row">
   <!-- Earnings (Monthly) Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('sentence.New Appointments') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_appointments_today->count() }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Earnings (Annual) Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('sentence.Total Appointments') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_appointments }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-calendar fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Tasks Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">{{ __('sentence.New Patients') }}</div>
                  <div class="row no-gutters align-items-center">
                     <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $total_patients_today->count() }}</div>
                     </div>
                  </div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-user-plus fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Pending Requests Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">{{ __('sentence.All Patients') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_patients }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <!-- Earnings (Monthly) Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('sentence.Total Xrays') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_xrays }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-pills fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Earnings (Annual) Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('sentence.Total Sonography') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_sonography }}</div>
               </div>
               <div class="col-auto">
                  <i class="fa fa-wallet fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Tasks Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-secondary shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">{{ __('sentence.Total Blood Tests') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_blood_test }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-syringe fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Pending Requests Card Example -->
   <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
         <div class="card-body">
            <div class="row no-gutters align-items-center">
               <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">{{ __('sentence.Payments this month') }}</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Setting::get_option('currency') }} {{ $total_payments_month }}</div>
               </div>
               <div class="col-auto">
                  <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

{{-- <div class="alert alert-warning">
   @if ($upcoming_appointments->count())
   <h6>Upcoming Appointments</h6>
   <ul>
      @foreach ($upcoming_appointments as $appointment)
      <li>{{ $appointment->Patient->name }} on  {{ $appointment->date->format('d M Y') }} between {{ $appointment->time_start }} - {{ $appointment->time_end }}</li>
      @endforeach
   </ul>
   @else
   <h6>No Appointments for next 3 days</h6>
   @endif
</div> --}}

{{-- <div class="row">
   <div class="col">
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <div class="row">
               <div class="col-8">
                  <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.Appointment List') }} | {{ Today()->format('d M Y') }}</h6>
               </div>
               <div class="col-4">
                  <a href="{{ route('appointment.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> {{ __('sentence.New Appointment') }}</a>
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        <th class="text-center">ID</th>
                        <th>{{ __('sentence.Patient Name') }}</th>
                        <th>{{ __('sentence.Date') }}</th>
                        <th>{{ __('sentence.Time Slot') }}</th>
                        <th class="text-center">{{ __('sentence.Status') }}</th>
                        <th class="text-center">{{ __('sentence.Created at') }}</th>
                        <th class="text-center">{{ __('sentence.Actions') }}</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($total_appointments_today as $appointment)
                     <tr>
                        <td class="text-center">{{ $appointment->id }}</td>
                        <td><a href="{{ url('patient/view/'.$appointment->patient_id) }}"> {{ $appointment->Patient->name }} </a></td>
                        <td> {{ $appointment->date->format('d M Y') }} </td>
                        <td> {{ $appointment->time_start }} - {{ $appointment->time_end }}</td>
                        <td class="text-center">
                           @if($appointment->visited == 0)
                           <a href="#" class="btn btn-warning btn-icon-split btn-sm">
                           <span class="icon text-white-50">
                           <i class="fas fa-hourglass-start"></i>
                           </span>
                           <span class="text">{{ __('sentence.Not Yet Visited') }}</span>
                           </a>
                           @elseif($appointment->visited == 1)
                           <a href="#" class="btn btn-success btn-icon-split btn-sm">
                           <span class="icon text-white-50">
                           <i class="fas fa-check"></i>
                           </span>
                           <span class="text">{{ __('sentence.Visited') }}</span>
                           </a>
                           @else
                           <a href="#" class="btn btn-danger btn-icon-split btn-sm">
                           <span class="icon text-white-50">
                           <i class="fas fa-user-times"></i>
                           </span>
                           <span class="text">{{ __('sentence.Cancelled') }}</span>
                           </a>
                           @endif
                        </td>
                        <td class="text-center">{{ $appointment->created_at->format('d M Y H:i') }}</td>
                        <td align="center">
                           <a data-rdv_id="{{ $appointment->id }}" data-rdv_date="{{ $appointment->date->format('d M Y') }}" data-rdv_time_start="{{ $appointment->time_start }}" data-rdv_time_end="{{ $appointment->time_end }}" data-patient_name="{{ $appointment->Patient->name }}" class="btn btn-success btn-circle btn-sm text-white" data-toggle="modal" data-target="#EDITRDVModal"><i class="fas fa-check"></i></a>
                           <a href="{{ url('appointment/delete/'.$appointment->id) }}" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>                      
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div> --}}

<div class="row">
   <div class="col">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <div class="row">
               <div class="col-8">
                  <h6 class="m-0 font-weight-bold text-primary w-75 p-2">
                     {{ __('sentence.Daily Patient Report') }} | {{ Today()->format('d M Y') }} |
                     <span class="ml-3">
                        Generate Report:
                        <a href="{{ url('home/pdf/'.$date) }}" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-print"></i></a>
                     </span>
                  </h6>
               </div>
               <div class="col-4">
                  <a href="{{ route('patient.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> {{ __('sentence.New Patient') }}</a>
               </div>
            </div>
         </div>
         <div class="card-body">

            <div class="card mb-3">
               <div class="card-header">
                  <div class="row">
                     <div class="col-9">
                        <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Filters') }}</h6>
                     </div>
                  </div>
               </div>
      
               <div class="card-body">
                  <form method="post" action="{{ route('home.filter_daily_patients') }}">
                     <div class="row">
                     
                        <div class="col-3">
                           <input class="form-control" type="date" name="date" value="{{ $date }}">
                           {{ csrf_field() }}
                        </div>
         
   
                        <div class="col-1">
                           <button type="submit" class="form-control btn btn-sm btn-primary">
                              Search
                           </button>
                        </div>
                        <div class="col-1">
                           <a class="form-control btn btn-sm btn-danger" href="{{ route('home') }}">
                              Reset
                           </a>
                        </div>
                        
                     </div>
                  </form>
               </div>
            </div>
      
            <div class="table-responsive">
               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                     <tr>
                        <th class="text-center">#</th>
                        <th>{{ __('sentence.Date') }}</th>
                        <th>{{ __('sentence.Patient Name') }}</th>
                        <th>{{ __('sentence.Referred Doctor') }}</th>
                        <th>{{ __('sentence.Investigations') }}</th>
                        <th>{{ __('sentence.Amount') }}</th>
                        <th>{{ __('sentence.Payment Mode') }}</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($total_patients_today as $i => $patient)
                        <tr>
                           <td>{{ $i+1 }}</td>
                           <td>{{ Carbon\Carbon::parse($patient->date)->format('d M Y H:i') }}</td>
                           <td><a href="{{ url('patient/view/'.$patient->patient_id) }}"> {{ $patient->patient_name }} </a></td>
                           <td><a href="{{ url('doctor/view/'.$patient->doctor_id) }}"> {{ $patient->doctor_name }} </a></td>
                           <td>{{ $patient->investigations }}</td>
                           <td>{{ App\Setting::get_option('currency') }} {{ $patient->amount }}</td>
                           <td>{{ $patient->payment_mode }}</td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- EDIT Appointment Modal-->
<div class="modal fade" id="EDITRDVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('sentence.You are about to modify an appointment') }}</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
         </div>
         <div class="modal-body">
            <p><b>{{ __('sentence.Patient') }} :</b> <span id="patient_name"></span></p>
            <p><b>{{ __('sentence.Date') }} :</b> <span id="rdv_date"></span></p>
            <p><b>{{ __('sentence.Time Slot') }} :</b> <span id="rdv_time"></span></p>
            <p><b>{{ __('sentence.Time Slot') }} :</b> <span id="rdv_time"></span></p>
         </div>
         <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('sentence.Close') }}</button>
            <a class="btn btn-primary text-white" onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();">{{ __('sentence.Confirm Appointment') }}</a>
            <form id="rdv-form-confirm" action="{{ route('appointment.store_edit') }}" method="POST" class="d-none">
               <input type="hidden" name="rdv_id" id="rdv_id">
               <input type="hidden" name="rdv_status" value="1">
               @csrf
            </form>
            <a class="btn btn-primary text-white" onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();">{{ __('sentence.Cancel Appointment') }}</a>
            <form id="rdv-form-cancel" action="{{ route('appointment.store_edit') }}" method="POST" class="d-none">
               <input type="hidden" name="rdv_id" id="rdv_id2">
               <input type="hidden" name="rdv_status" value="2">
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