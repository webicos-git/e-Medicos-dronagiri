@extends('layouts.master')

@section('title')
{{ __('sentence.Add Sonography') }}
@endsection

@section('content')
<div class="row justify-content-center">
   <div class="col-md-8">
      <div class="card shadow mb-4">
         <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Add Sonography') }}</h6>
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
            <form method="post" action="{{ route('sonography.store') }}">
               <div class="form-group">
                  <label for="exampleInputEmail1">Name *</label>
                  <input type="text" class="form-control" name="name" id="TradeName" aria-describedby="TradeName">
                  {{ csrf_field() }}
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Amount *</label>
                  <input type="text" class="form-control" name="amount" id="GenericName">
               </div>
               <div class="form-group">
                  <label for="exampleInputPassword1">Description</label>
                  <input type="text" class="form-control" name="description" id="GenericName">
               </div>
               <button type="submit" class="btn btn-primary">{{ __('sentence.Save') }}</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection