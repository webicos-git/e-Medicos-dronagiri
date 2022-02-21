@extends('layouts.master')

@section('title')
{{ __('sentence.Edit Patient') }}
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
                  <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Edit Patient') }}</h6>
                </div>
                <div class="card-body">
                 <form method="post" action="{{ route('patient.store_edit') }}">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">{{ __('sentence.Full Name') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputEmail3" name="name" value="{{ $patient->name }}">
                        <input type="hidden" class="form-control" id="inputEmail3" name="id" value="{{ $patient->id }}">
                        {{ csrf_field() }}
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Referred Doctor') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <select class="form-control" name="doctor_id">
                          <option selected disabled>~ Select a doctor ~</option>

                          @if (!$patient->doctor_id)
                            <option selected value="0">None</option>
                          @else
                            <option value="0">None</option>
                          @endif

                          @foreach ($doctors as $doctor)
                              @if ($doctor->id === $patient->doctor_id)
                                <option selected value="{{$doctor->id}}">{{$doctor->name}}</option>
                                @continue
                              @endif
                              <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Birthday') }}</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="birthday" name="birthday"  value="{{ $patient->birthday }}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Phone') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputPassword3" name="phone" value="{{ $patient->phone }}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Gender') }}<font color="red">*</font></label>
                      <div class="col-sm-9">
                        <select class="form-control" name="gender">
                          <option value="{{ $patient->gender }}" selected="selected">{{ $patient->gender }}</option>
                          <option value="Male">{{ __('sentence.Male') }}</option>
                          <option value="Female">{{ __('sentence.Female') }}</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Marital Status') }}</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="marital_status">
                          <option value="{{ $patient->marital_status }}" selected="selected">{{ $patient->marital_status }}</option>
                          <option value="Single">{{ __('sentence.Single') }}</option>
                          <option value="Married">{{ __('sentence.Married') }}</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Blood Group') }}</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="blood">
                                            <option value="{{ $patient->blood }}" selected="selected">{{ $patient->blood }}</option>
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
                        <input type="text" class="form-control" id="inputPassword3" name="address" value="{{ $patient->address }}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Patient History') }}</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputPassword3" name="history" value="{{ $patient->history }}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Reason/Problem') }}</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputPassword3" name="reason" value="{{ $patient->reason }}">
                      </div>
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

@endsection
