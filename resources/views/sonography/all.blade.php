@extends('layouts.master')

@section('title')
{{ __('sentence.All Sonography') }}
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
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.All Sonography') }}</h6>
         </div>
         <div class="col-4">
            <a href="{{ route('sonography.create') }}" class="btn btn-primary float-right"><i class="fa fa-plus"></i> {{ __('sentence.Add Sonography') }}</a>
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
               @foreach($sonographies as $sonography)
               <tr>
                  <td>{{ $sonography->id }}</td>
                  <td>{{ $sonography->name }}</td>
                  <td>{{ App\Setting::get_option('currency') }} {{ $sonography->amount }}</td>
                  <td>{{ $sonography->description }}</td>
                  <td class="text-center">
                     <a href="{{ url('sonography/edit/'.$sonography->id) }}" class="btn btn-warning btn-circle btn-sm"><i class="fa fa-pen"></i></a>
                     <a href="{{ url('sonography/delete/'.$sonography->id) }}" class="btn btn-danger btn-circle btn-sm"><i class="fas fa-trash"></i></a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection