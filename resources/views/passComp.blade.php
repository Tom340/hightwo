@extends('layout')

@section('content')
<form action="/password" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-8 col-md-8">
          <h1>パスワード再設定完了</h1>
      </div>
      <div class="col-sm-2 col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-8 col-md-8 box">
        パスワードの再設定が完了しました。<br>
        新しいパスワードでログインしてください。 <br><br>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-10 col-md-10"></div>
      <div class="col-sm-2 col-md-2">
        <a class="btn btn-primary" href="/login" name="entry" style="width:100%;">ログインへ</a>
      </div>
    </div>
</form>
@endsection