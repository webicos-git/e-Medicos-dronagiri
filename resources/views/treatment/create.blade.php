@extends('layouts.master')

@section('title')
{{ __('sentence.Add Investigation') }}
@endsection

@section('content')
<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Add Investigation') }}</h6>
         </div>
         <div class="card-body">
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
            <form method="post" action="{{ route('investigation.store') }}">
               <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Patient Name') }} <font color="red">*</font></label>
                  <div class="col-sm-9">
                    <select class="form-control" name="patient_id">
                     <option selected disabled>~ Select a Patient ~</option>

                     @foreach ($patients as $patient)
                        <option value="{{$patient->id}}">{{$patient->name}}</option>
                     @endforeach
                    </select>
                  </div>
                  {{ csrf_field() }}

               </div>

               <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-3 col-form-label">{{ __('sentence.Referred Doctor') }}<font color="red">*</font></label>
                  <div class="col-sm-9">
                    <select class="form-control" name="doctor_id">
                     <option selected disabled>~ Select a Doctor ~</option>

                     <option value="0">None</option>
                     @foreach ($doctors as $doctor)
                        <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                     @endforeach
                    </select>
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

               <button type="submit" class="btn btn-primary">{{ __('sentence.Save') }}</button>
            </form>
         </div>
      </div>
   </div>
</div>
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