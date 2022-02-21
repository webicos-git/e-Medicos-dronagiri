@extends('layouts.master')

@section('title')
{{ $patient->name }}
@endsection

@section('content')

    <div class="row justify-content-center">
      <div class="col">
        <div class="card shadow mb-4">
                
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 col-sm-6">
                      <center><img src="{{ asset('img/patient-icon.png') }}" class="img-profile rounded-circle img-fluid"></center>
                       <h4 class="text-center"><b>{{ $patient->name }}</b></h4>
                            <hr>
                            @isset($patient->referred_doctor)
                            <p><b>{{ __('sentence.Referred Doctor') }} :</b> {{ $patient->referred_doctor }}</p>
                            @endisset

                            @isset($patient->birthday)
                            <p><b>{{ __('sentence.Age') }} :</b> {{ $patient->birthday }} ({{ \Carbon\Carbon::parse($patient->birthday)->age }} Years)</p>
                            @endisset

                            @isset($patient->gender)
                            <p><b>{{ __('sentence.Gender') }} :</b> {{ __('sentence.'.$patient->gender) }}</p> 
                            @endisset

                            @isset($patient->phone)
                            <p><b>{{ __('sentence.Phone') }} :</b> {{ $patient->phone }}</p>
                            @endisset

                            @isset($patient->address)
                            <p><b>{{ __('sentence.Address') }} :</b> {{ $patient->address }}</p>
                            @endisset
                    </div>
                    <div class="col-md-8 col-sm-6">
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="Profile" aria-selected="true">{{ __('sentence.Medical Info') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="appointements-tab" data-toggle="tab" href="#appointements" role="tab" aria-controls="appointements" aria-selected="false">{{ __('sentence.Appointment List') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="Billing-tab" data-toggle="tab" href="#Billing" role="tab" aria-controls="Billing" aria-selected="false">{{ __('sentence.Billing') }}</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                           
                           <div class="mt-4"></div>

                            @isset($patient->reason)
                            <p><b>{{ __('sentence.Reason') }} :</b> {{ $patient->reason }}</p>
                            @endisset

                            @isset($patient->history)
                            <p><b>{{ __('sentence.History') }} :</b> {{ $patient->history }}</p>
                            @endisset

                            @isset($patient->blood)
                            <p><b>{{ __('sentence.Blood Group') }} :</b> {{ $patient->blood }}</p>
                            @endisset

                          
                        </div>
                        <div class="tab-pane fade" id="appointements" role="tabpanel" aria-labelledby="appointements-tab">
                          <table class="table">
                            <tr>
                              <td align="center">Id</td>
                              <td align="center">{{ __('sentence.Date') }}</td>
                              <td align="center">{{ __('sentence.Time Slot') }}</td>
                              <td align="center">{{ __('sentence.Status') }}</td>
                              <td align="center">{{ __('sentence.Actions') }}</td>
                            </tr>
                            @forelse($appointments as $appointment)
                            <tr>
                              <td align="center">{{ $appointment->id }} </td>
                              <td align="center">{{ $appointment->date->format('d M Y') }} </td>
                              <td align="center">{{ $appointment->time_start }} - {{ $appointment->time_end }} </td>
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
                              <td align="center">
                                <a 
                                  data-rdv_id="{{ $appointment->id }}" 
                                  data-rdv_date="{{ $appointment->date->format('d M Y') }}" 
                                  data-rdv_time_start="{{ $appointment->time_start }}" 
                                  data-rdv_time_end="{{ $appointment->time_end }}" 
                                  data-patient_name="{{ $appointment->Patient->name }}"
                                  data-patient_history="{{ $appointment->Patient->history }}"
                                  data-patient_reason="{{ $appointment->Patient->reason }}"
                                  data-note="{{ $appointment->note }}"
                                  class="btn btn-success btn-circle btn-sm text-white" 
                                  data-toggle="modal" 
                                  data-target="#EDITRDVModal"
                                ><i class="fas fa-check"></i></a>

                              <a 
                                data-rdv_id="{{ $appointment->id }}" 
                                data-rdv_date="{{ $appointment->date->format('d M Y') }}" 
                                data-rdv_time_start="{{ $appointment->time_start }}" 
                                data-rdv_time_end="{{ $appointment->time_end }}" 
                                data-patient_name="{{ $appointment->Patient->name }}"
                                data-patient_history="{{ $appointment->Patient->history }}"
                                data-patient_reason="{{ $appointment->Patient->reason }}"
                                data-note="{{ $appointment->note }}"
                                data-image="{{ $appointment->image }}"

                                class="btn btn-warning btn-circle btn-sm text-white" 
                                data-toggle="modal" 
                                data-target="#VIEWRDVModal"
                              ><i class="fas fa-eye"></i></a>
                         
                                <a href="{{ url('appointment/delete/'.$appointment->id) }}" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                              </td>
                            </tr>
                            @empty
                            <tr>
                              <td colspan="5" align="center">{{ __('sentence.No appointment available') }}</td>
                            </tr>
                            @endforelse
                          </table>
                        </div>

                        <div class="tab-pane fade" id="Billing" role="tabpanel" aria-labelledby="Billing-tab">
                          <table class="table">
                            <tr>
                              <th>{{ __('sentence.Reference') }}</th>
                              <th>{{ __('sentence.Date') }}</th>
                              <th>{{ __('sentence.Amount') }}</th>
                              <th>{{ __('sentence.Status') }}</th>
                              <th>{{ __('sentence.Actions') }}</th>
                            </tr>
                            @forelse($invoices as $invoice)
                            <tr>
                              <td>{{ $invoice->reference }}</td>
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
                            @empty
                            <tr>
                            </tr>
                              <td colspan="6" align="center">{{ __('sentence.No Invoices Available') }}</td>
                            @endforelse
                          </table>
                        </div>
                      </div>
                    
                    </div>
                  </div>
                </div>
              </div>
      </div>
    </div>

  <!-- Appointment Modal-->
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
                     <textarea name="note" id="note" rows="5" style="width: 100%"></textarea>
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

 <!-- View Modal-->
 <div class="modal fade" id="VIEWRDVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
        <div class="modal-header">
           <h5 class="modal-title" id="exampleModalLabel">{{ __('sentence.Patient appointment details') }}</h5>
           <button class="close" type="button" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">×</span>
           </button>
        </div>
        <div class="modal-body">
              <p><b>{{ __('sentence.Patient') }} :</b> <span id="patient_name"></span></p>
              <p><b>{{ __('sentence.Date') }} :</b> <span id="rdv_date"></span></p>
              <p><b>{{ __('sentence.Time Slot') }} :</b> <span id="rdv_time"></span></p>
              <p><b>{{ __('sentence.Patient History') }} :</b> <span id="patient_history"></span></p>
              <p><b>{{ __('sentence.Reason/Problem') }} :</b> <span id="patient_reason"></span></p>
              <p><b>{{ __("sentence.Doctor's Note") }} :</b> <span id="note"></span></p>
              <p>
                  <b>{{ __('sentence.Image') }} :</b>  <br/>
                  <img src="" id="image" width="400" height="300">
              </p>
        </div>
        <div class="modal-footer">
           <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">{{ __('sentence.Close') }}</button>
        </div>
     </div>
  </div>
</div>


@endsection


@section('footer')

@endsection