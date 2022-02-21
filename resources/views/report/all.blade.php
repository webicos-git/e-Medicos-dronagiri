@extends('layouts.master')

@section('title')
{{ __('sentence.Report Generation') }}
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
            <h6 class="m-0 font-weight-bold text-primary w-75 p-2">{{ __('sentence.Report Generation') }}</h6>
         </div>
      </div>
   </div>
   <div class="card-body">
      
      <div class="card mb-3">
         <div class="card-header">
            <div class="row">
               <div class="col-9">
                  <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Filters') }}</h6>
               </div>
            </div>
         </div>

         <div class="card-body">
            <form method="post" action="{{ route('report.filter') }}">
               <div class="row">
               
                  <div class="col-2">
                     <select name="year" class="form-control">
                        <option selected disabled>~ Select a year ~</option>
                        
                        @isset($year)
                           <option selected value="{{ $year }}">{{ $year }}</option>
                        @endisset

                        @for ($i = date('Y') - 10; $i <= date('Y'); $i++)
                           <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                     </select>
                     {{ csrf_field() }}
                  </div>
   
                  <div class="col-2">
                     <select name="month" class="form-control">
                        <option selected disabled>~ Select a month ~</option>
                        
                        @isset($month)
                           <option selected value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 10)) }}</option>
                        @endisset
                        
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                     </select>
                  </div>
                  
                  <div class="col-2">
                     <select name="date" class="form-control">
                        <option selected disabled>~ Select a date ~</option>
                        @isset($date)
                           <option selected value="{{ $date }}">{{ $date }}</option>
                        @endisset
                        
                        @for ($i = 1; $i <= 31; $i++)
                           <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                     </select>
                  </div>

                  <div class="col-1">
                     <button type="submit" class="form-control btn btn-sm btn-primary">
                        Search
                     </button>
                  </div>
                  <div class="col-1">
                     <a class="form-control btn btn-sm btn-danger" href="{{ route('report.all') }}">
                        Reset
                     </a>
                  </div>
                  
               </div>
            </form>
         </div>
      </div>

      <div class="table-responsive">
         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
               <tr>
                  <th>#</th>
                  <th>{{ __('sentence.Doctor') }}</th>
                  <th>{{ __('sentence.Total Patients') }}</th>
                  <th>{{ __('sentence.Total Xrays') }}</th>
                  <th>{{ __('sentence.Total Sonography') }}</th>
                  <th>{{ __('sentence.Total Blood Tests') }}</th>
                  <th>{{ __('sentence.Total Amount') }}</th>
                  <th class="text-center">{{ __('sentence.Actions') }}</th>
               </tr>
            </thead>
            <tbody>
               @php
                  $no = 0;
               @endphp
               
               @foreach($doctors as $doctor)
               <tr>
                  <td>{{ ++$no }}</td>
                  <td><a href="{{ url('doctor/view/'.$doctor->id) }}"> {{ $doctor->name }} </a></td>
                  <td>{{ $doctor->patient_count }}</td>
                  <td>{{ $doctor->xray_count }}</td>
                  <td>{{ $doctor->sonography_count }}</td>
                  <td>{{ $doctor->blood_test_count }}</td>
                  <td>{{ App\Setting::get_option('currency') }} {{ $doctor->total_amount }}</td>
                  <td class="text-center">
                     <a href="{{ url('reports/pdf/'.$doctor->id) }}" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-print"></i></a>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection