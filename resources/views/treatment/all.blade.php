@extends('layouts.master')

@section('title')
{{ __('sentence.All Investigations') }}
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
<!-- DataTales Example -->
<div class="card shadow mb-4">
   <div class="card-header py-3">
      <div class="row">
         <div class="col-8">
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Investigations') }}</h6>
         </div>
         <div class="col-4">
            <a href="{{ route('investigation.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> {{ __('sentence.Add Investigation') }}</a>
         </div>
      </div>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>{{ __('sentence.Patient Name') }}</th>
                  <th>{{ __('sentence.Xrays') }}</th>
                  <th>{{ __('sentence.Sonography') }}</th>
                  <th>{{ __('sentence.Blood Tests') }}</th>

               </tr>
            </thead>
            <tbody>
               @foreach($patients as $patient)
               <tr>
                  <td>{{ $patient->id }}</td>
                  <td><a href="{{ url('patient/view/'.$patient->id) }}"> {{ $patient->name }} </a></td>
                  <td>{{ $patient->xray_count }}</td>
                  <td>{{ $patient->sonography_count }}</td>
                  <td>{{ $patient->blood_test_count }}</td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection