@extends('layout')

@section('content')
<form action="/password" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-8 col-md-8">
          <h1>パスワード再設定</h1>
      </div>
      <div class="col-sm-2 col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-8 col-md-8 box">
        ご登録いただいたメールアドレスを入力してください。<br>
        メールアドレス宛にパスワード変更ページのURLが記載されたメールを送信します。<br><br>
        <ul>
          <li>メールアドレス</li>
          <li></li>
          <li style="width: 80%;"><input type="text" name="email" maxlength="100" style="width: 100%;" value=""></li>
        </ul><br><br>
        <input class="btn btn-primary" type="submit" name="confirm" value="再設定メール送信" style="position:absolute;right: 10px;bottom:10px;">
      </div>
    </div>
</form>
@endsection