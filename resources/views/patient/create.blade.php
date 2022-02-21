@extends('layouts.master')

@section('title')
{{ __('sentence.New Patient') }}
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
                  

        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.New Patient') }}</h6>
                </div>
                <div class="card-body">
                 <form method="post" action="{{ route('patient.create') }}">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">{{ __('sentence.Full Name') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputEmail3" name="name">
                        {{ csrf_field() }}
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Referred Doctor') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <select class="form-control" name="doctor_id">
                          <option selected disabled>~ Select a doctor ~</option>

                          <option value="0">None</option>
                          @foreach ($doctors as $doctor)
                              <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Birthday') }}</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="birthday" name="birthday" autocomplete="off">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Phone') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputPassword3" name="phone">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Gender') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <select class="form-control" name="gender">
                          <option value="Male">{{ __('sentence.Male') }}</option>
                          <option value="Female">{{ __('sentence.Female') }}</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Marital Status') }}</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="marital_status">
                          <option value="Single">{{ __('sentence.Single') }}</option>
                          <option value="Married">{{ __('sentence.Married') }}</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Blood Group') }}</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="blood">
                                            <option value="Unknown">{{ __('sentence.Unknown') }}</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Address') }}</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputPassword3" name="address">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Patient History') }}</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputPassword3" name="history">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Reason/Problem') }}</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputPassword3" name="reason">
                      </div>
                    </div>

                    <label>{{ __('sentence.Investigations') }}</label>

                    <div class="form-group">
                      <fieldset class="xray_labels">
                         <div class="repeatable"></div>
                         <div class="form-group">
                            <a type="button" class="btn btn-sm btn-success add text-white" align="center"><i class='fa fa-plus'></i> {{ __('sentence.Add Xray') }}</a>
                         </div>
                      </fieldset>
                    </div>
    
                    <div class="form-group">
                      <fieldset class="sonography_labels">
                         <div class="repeatable"></div>
                         <div class="form-group">
                            <a type="button" class="btn btn-sm btn-success add text-white" align="center"><i class='fa fa-plus'></i> {{ __('sentence.Add Sonography') }}</a>
                         </div>
                      </fieldset>
                    </div>
    
                    <div class="form-group">
                      <fieldset class="blood_test_labels">
                         <div class="repeatable"></div>
                         <div class="form-group">
                            <a type="button" class="btn btn-sm btn-success add text-white" align="center"><i class='fa fa-plus'></i> {{ __('sentence.Add Blood Test') }}</a>
                         </div>
                      </fieldset>
                    </div>
    
                    <div class="form-group row">
                      <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary">{{ __('sentence.Save') }}</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            
        </div>

    </div>

@endsection

@section('header')

@endsection

@section('footer')

<script type="text/template" id="xray_labels">
  <div class="field-group row">
   <div class="col-md-6">
     <div class="form-group-custom mb-3">
        <select class="form-control" name="xray_id[]">
           <option selected disabled>~ Select an Xray ~</option>
           @foreach ($xrays as $xray)
              <option value="{{$xray->id}}">{{ $xray->name }}</option>
           @endforeach
        </select>
     </div>
  </div>
   <div class="col-md-2">
      <a type="button" class="btn btn-sm btn-danger text-white span-2 delete"><i class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
   </div>
  </div>
</script>

<script type="text/template" id="sonography_labels">
  <div class="field-group row">
   <div class="col-md-6">
     <div class="form-group-custom mb-3">
        <select class="form-control" name="sonography_id[]">
           <option selected disabled>~ Select a Sonography ~</option>
           @foreach ($sonographies as $sonography)
              <option value="{{$sonography->id}}">{{ $sonography->name }}</option>
           @endforeach
        </select>
     </div>
  </div>
   <div class="col-md-2">
      <a type="button" class="btn btn-sm btn-danger text-white span-2 delete"><i class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
   </div>
  </div>
</script>

<script type="text/template" id="blood_test_labels">
  <div class="field-group row">
   <div class="col-md-6">
     <div class="form-group-custom mb-3">
        <select class="form-control" name="blood_test_id[]">
           <option selected disabled>~ Select a Blood Test ~</option>
           @foreach ($blood_tests as $blood_test)
              <option value="{{$blood_test->id}}">{{ $blood_test->name }}</option>
           @endforeach
        </select>
     </div>
  </div>
   <div class="col-md-2">
      <a type="button" class="btn btn-sm btn-danger text-white span-2 delete"><i class="fa fa-times-circle"></i> {{ __('sentence.Remove') }}</a>
   </div>
  </div>
</script>
@endsection
