@extends('layout')

@section('content')
<script>
  function checkPass() {
    var pass1 = document.getElementById("pass1");
    var pass2 = document.getElementById("pass2");
    if (pass1.value != pass2.value) {
      alert("パスワードが一致しません。再度入力してください。");
      return false;
    } else {
      return true;
    }
  }
</script>
<form action="{{ $url }}" method="POST" onSubmit="checkPass();">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $id }}">
    <input type="hidden" name="key" value="{{ $key }}">
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
        <ul>
          <li>新しいパスワードを入力してください。</li>
        </ul>
        <input type="password" name="pass1" id="pass1" maxlength="100" style="width: 60%;" value="">
        <ul>
          <li>もう一度パスワードを入力してください。</li>
        </ul>
        <input type="password" name="pass2" id="pass2" maxlength="100" style="width: 60%;" value="">
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-8 col-md-8" style="height: 80px;">
        <input class="btn btn-primary" type="submit" name="confirm" value="再設定" style="position:absolute;right: 10px;bottom:10px;">
      </div>
    </div>
</form>
@endsection