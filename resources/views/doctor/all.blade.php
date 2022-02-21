@extends('layouts.master')

@section('title')
{{ __('sentence.All Doctors') }}
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
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Doctors') }}</h6>
         </div>
         <div class="col-4">
            <a href="{{ route('doctor.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> {{ __('sentence.Add Doctor') }}</a>
         </div>
      </div>
   </div>
   <div class="card-body">
      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>{{ __('sentence.Name') }}</th>
                  <th>{{ __('sentence.Phone No') }}</th>
                  <th>{{ __('sentence.Clinic Name') }}</th>
                  <th class="text-center">{{ __('sentence.Actions') }}</th>
               </tr>
            </thead>
            <tbody>
               @foreach($doctors as $doctor)
               <tr>
                  <td>{{ $doctor->id }}</td>
                  <td><a href="{{ url('doctor/view/'.$doctor->id) }}"> {{ $doctor->name }} </a></td>
                  <td>{{ $doctor->phone ? $doctor->phone : '-' }}</td>
                  <td>{{ $doctor->clinic_name ? $doctor->clinic_name : '-' }}</td>
                  <td class="text-center">
                     <a href="{{ url('doctor/edit/'.$doctor->id) }}" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                     {{-- <a href="{{ url('doctor/delete/'.$doctor->id) }}" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a> --}}
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection