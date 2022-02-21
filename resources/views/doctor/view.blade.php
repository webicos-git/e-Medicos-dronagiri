@extends('layouts.master')

@section('title')
{{ $doctor->name }}
@endsection

@section('content')

    <div class="row justify-content-center">
      <div class="col">
        <div class="card shadow mb-4">
                
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4 col-sm-6">
                      <center><img src="{{ asset('img/patient-icon.png') }}" class="img-profile rounded-circle img-fluid"></center>
                       <h4 class="text-center"><b>{{ $doctor->name }}</b></h4>
                            <hr>
                            @isset($doctor->clinic_name)
                            <p><b>{{ __('sentence.Clinic Name') }} :</b> {{ $doctor->clinic_name }}</p> 
                            @endisset

                            @isset($doctor->phone)
                            <p><b>{{ __('sentence.Phone') }} :</b> {{ $doctor->phone }}</p>
                            @endisset

                            @isset($doctor->address)
                            <p><b>{{ __('sentence.Address') }} :</b> {{ $doctor->address }}</p>
                            @endisset
                    </div>
                    <div class="col-md-8 col-sm-6">
                      <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="xray-tab" data-toggle="tab" href="#xray" role="tab" aria-controls="Xrays" aria-selected="true">{{ __('sentence.Xrays') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="sonography-tab" data-toggle="tab" href="#sonography" role="tab" aria-controls="sonography" aria-selected="false">{{ __('sentence.Sonography') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="blood-test-tab" data-toggle="tab" href="#blood-test" role="tab" aria-controls="blood-test" aria-selected="false">{{ __('sentence.Blood Tests') }}</a>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="xray" role="tabpanel" aria-labelledby="xray-tab">
                            <table class="table">
                                <tr>
                                  <th>ID</th>
                                  <th>{{ __('sentence.Patient Name') }}</th>
                                  <th>{{ __('sentence.Xray Name') }}</th>
                                  <th>{{ __('sentence.Amount') }}</th>
                                </tr>
                                @php
                                    $x = 0;
                                @endphp
                                @forelse($doctor_xrays as $xray)
                                <tr>
                                  <td>{{ ++$x }}</td>
                                  <td><a href="{{ url('patient/view/'.$xray->patient_id) }}"> {{ $xray->patient_name }} </a></td>
                                  <td>{{ $xray->xray_name }}</td>
                                  <td>{{ App\Setting::get_option('currency') }} {{ $xray->amount }}</td>
                                </tr>
                                @empty
                                <tr>
                                </tr>
                                  <td colspan="4" align="center">{{ __('sentence.No Xrays Available') }}</td>
                                @endforelse
                            </table>
                        </div>
                        <div class="tab-pane fade" id="sonography" role="tabpanel" aria-labelledby="sonography-tab">
                            <table class="table">
                                <tr>
                                  <th>ID</th>
                                  <th>{{ __('sentence.Patient Name') }}</th>
                                  <th>{{ __('sentence.Sonography Name') }}</th>
                                  <th>{{ __('sentence.Amount') }}</th>
                                </tr>
                                @php
                                    $y = 0;
                                @endphp
                                @forelse($doctor_sonography as $sonography)
                                <tr>
                                  <td>{{ ++$y }}</td>
                                  <td><a href="{{ url('patient/view/'.$sonography->patient_id) }}"> {{ $sonography->patient_name }} </a></td>
                                  <td>{{ $sonography->sonography_name }}</td>
                                  <td>{{ App\Setting::get_option('currency') }} {{ $sonography->amount }}</td>
                                </tr>
                                @empty
                                <tr>
                                </tr>
                                  <td colspan="4" align="center">{{ __('sentence.No Sonography Available') }}</td>
                                @endforelse
                            </table>
                        </div>

                        <div class="tab-pane fade" id="blood-test" role="tabpanel" aria-labelledby="blood-test-tab">
                            <table class="table">
                                <tr>
                                  <th>ID</th>
                                  <th>{{ __('sentence.Patient Name') }}</th>
                                  <th>{{ __('sentence.Blood Test Name') }}</th>
                                  <th>{{ __('sentence.Amount') }}</th>
                                </tr>
                                @php
                                    $z = 0;
                                @endphp
                                @forelse($doctor_blood_tests as $blood_test)
                                <tr>
                                  <td>{{ ++$z }}</td>
                                  <td><a href="{{ url('patient/view/'.$blood_test->patient_id) }}"> {{ $blood_test->patient_name }} </a></td>
                                  <td>{{ $blood_test->blood_test_name }}</td>
                                  <td>{{ App\Setting::get_option('currency') }} {{ $blood_test->amount }}</td>
                                </tr>
                                @empty
                                <tr>
                                </tr>
                                  <td colspan="4" align="center">{{ __('sentence.No Blood Tests Available') }}</td>
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