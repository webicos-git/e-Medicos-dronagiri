@extends('layouts.master')

@section('title')
{{ __('sentence.All Blood Tests') }}
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
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Blood Tests') }}</h6>
         </div>
         <div class="col-4">
            <a href="{{ route('blood_test.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> {{ __('sentence.Add Blood Test') }}</a>
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
                  <th>{{ __('sentence.Amount') }}</th>
                  <th>{{ __('sentence.Description') }}</th>
                  <th class="text-center">{{ __('sentence.Actions') }}</th>
               </tr>
            </thead>
            <tbody>
               @foreach($blood_tests as $blood_test)
               <tr>
                  <td>{{ $blood_test->id }}</td>
                  <td>{{ $blood_test->name }}</td>
                  <td>{{ App\Setting::get_option('currency') }} {{ $blood_test->amount }}</td>
                  <td>{{ $blood_test->description }}</td>
                  <td class="text-center">
                     <a href="{{ url('blood_test/edit/'.$blood_test->id) }}" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                     <a href="{{ url('blood_test/delete/'.$blood_test->id) }}" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection