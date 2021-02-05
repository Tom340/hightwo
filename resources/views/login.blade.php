@extends('layout')

@section('content')
<form action="{{$url}}" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-8 col-md-8">
          <h1>ログイン</h1>
      </div>
      <div class="col-sm-2 col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-8 col-md-8 login"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-8 col-md-8 login"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-1 col-md-1 login"></div>
      <div class="col-sm-2 col-md-2 login">
        <ul>
          <li>メールアドレス</li>
        </ul>
      </div>
      <div class="col-sm-4 col-md-4 login">
          <input type="text" name="email" maxlength="100" style="width: 100%;" value="">
      </div>
      <div class="col-sm-1 col-md-1 login"></div>
      <div class="col-sm-2 col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-1 col-md-1 login"></div>
      <div class="col-sm-2 col-md-2 login">
        <ul>
          <li>パスワード</li>
        </ul>
      </div>
      <div class="col-sm-4 col-md-4 login">
          <input type="password" name="password" maxlength="20" style="width: 100%;" value="">
      </div>
      <div class="col-sm-1 col-md-1 login"></div>
      <div class="col-sm-2 col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-8 col-md-8 login"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-5 col-md-5 login"></div>
      <div class="col-sm-3 col-md-3 login">
        <ul>
          <li>
            <a href="/password">パスワードを忘れた方はコチラ</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-6 col-md-6 login"></div>
      <div class="col-sm-2 col-md-2 login">
        <ul>
          <li>
            <input class="btn btn-primary" type="submit" name="confirm" value="ログイン">
          </li>
        </ul>
      </div>
      <div class="col-sm2 col-md-2"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-8 col-md-8 login"></div>
    </div>
</form>
@endsection