@extends('layout')

@section('content')
<form action="{{$url}}" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-10 col-md-10 login"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-10 col-md-10 login"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 login">
        <ul>
          <li>メールアドレス</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 login">
          <input type="text" name="email" maxlength="100" style="width: 100%;" value="">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 login">
        <ul>
          <li>パスワード</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 login">
          <input type="password" name="password" maxlength="20" style="width: 100%;" value="">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-10 col-md-10 login"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 login"></div>
      <div class="col-sm-3 col-md-3 login">
        <ul>
          <li>
            <input class="btn btn-primary" type="submit" name="confirm" value="ログイン">
          </li>
        </ul>
      </div>
      <div class="col-sm-1 col-md-1 login"></div>
      <div class="col-sm-3 col-md-3 login">
        <ul>
          <li>
            <input class="btn btn-light" type="button" name="return" value="キャンセル" OnClick="javascript:history.back();">
          </li>
        </ul>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-7 col-md-7 login"></div>
      <div class="col-sm-3 col-md-3 login">
        <ul>
          <li>
            <a href="#">パスワードを忘れた</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-10 col-md-10 login"></div>
    </div>
</form>
@endsection