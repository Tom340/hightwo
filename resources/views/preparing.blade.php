@extends('layout')

@section('content')
<form action="/password" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-8 col-md-8">
          <h1>画面作成中</h1>
      </div>
      <div class="col-sm-2 col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-8 col-md-8 box">
        現在、作成中の画面です。
      </div>
    </div>
</form>
@endsection