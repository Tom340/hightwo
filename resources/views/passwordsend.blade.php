@extends('layout')

@section('content')
<form action="/password" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-8 col-md-8">
          <h1>メール送信完了</h1>
      </div>
      <div class="col-sm-2 col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-8 col-md-8 box">
        パスワード再設定用のURLをご入力のメールアドレスに送信しました。<br>
        記載された内容に従って、パスワードの再設定を行なってください。 <br><br>
      </div>
    </div>
</form>
@endsection