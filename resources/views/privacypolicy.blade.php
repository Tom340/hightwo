@extends('layout')

@section('content')
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-10 col-md-10">
          <h1>{{$title}}</h1>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-10 col-md-10">
          <textarea name="rules" style="width:100%;height:800px" readonly>{{$text}}</textarea>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
@endsection