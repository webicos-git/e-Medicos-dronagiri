@extends('layouts.master')

@section('title')
{{ __('sentence.All Patients') }}
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
<!-- DataTales  -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
         <div class="col-8">
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Appointments') }}</h6>
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
               @foreach($appointments as $appointment)
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
                     <a 
                        data-rdv_id="{{ $appointment->id }}" 
                        data-rdv_date="{{ $appointment->date->format('d M Y') }}" 
                        data-rdv_time_start="{{ $appointment->time_start }}" 
                        data-rdv_time_end="{{ $appointment->time_end }}" 
                        data-patient_name="{{ $appointment->Patient->name }}"
                        data-patient_history="{{ $appointment->Patient->history }}"
                        data-patient_reason="{{ $appointment->Patient->reason }}"
                        class="btn btn-success btn-circle btn-sm text-white" 
                        data-toggle="modal" 
                        data-target="#EDITRDVModal"
                     ><i class="fas fa-check"></i></a>

                     <a href="{{ url('appointment/delete/'.$appointment->id) }}" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
<!--EDIT Appointment Modal-->
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
            <form id="rdv-form-confirm" action="{{ route('appointment.store_edit') }}" method="POST" enctype="multipart/form-data">
               <p><b>{{ __('sentence.Patient') }} :</b> <span id="patient_name"></span></p>
               <p><b>{{ __('sentence.Date') }} :</b> <span id="rdv_date"></span></p>
               <p><b>{{ __('sentence.Time Slot') }} :</b> <span id="rdv_time"></span></p>
               <p><b>{{ __('sentence.Patient History') }} :</b> <span id="patient_history"></span></p>
               <p><b>{{ __('sentence.Reason/Problem') }} :</b> <span id="patient_reason"></span></p>

               
               <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-12 col-form-label">{{ __("sentence.Doctor's Note") }} <font color="red">*</font></label>
                  <div class="col-sm-12">
                    <textarea name="note" id="inputPassword3" rows="5" style="width: 100%"></textarea>
                  </div>
               </div>

               <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-12 col-form-label">{{ __('sentence.Image') }}</label>
                  <div class="col-sm-12">
                     <input type="file" class="form-control" id="inputPassword3" name="image">
                  </div>
               </div>

               <input type="hidden" name="rdv_id" id="rdv_id">
               <input type="hidden" name="rdv_status" value="1">
               @csrf
            </form>
            <a class="btn btn-sm btn-primary text-white float-right" onclick="event.preventDefault(); document.getElementById('rdv-form-confirm').submit();">{{ __('sentence.Confirm Appointment') }}</a>
         </div>
         <div class="modal-footer">
            <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">{{ __('sentence.Close') }}</button>
            
            <a class="btn btn-sm btn-danger text-white" onclick="event.preventDefault(); document.getElementById('rdv-form-cancel').submit();">{{ __('sentence.Cancel Appointment') }}</a>
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