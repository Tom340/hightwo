@extends('layout')

@section('content')
<form action="contact" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-10 col-md-10">
          <h1>お問い合わせ</h1>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>お名前</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
          <input type="text" name="name" maxlength="20" style="width: 100%;" value="{{$name}}" {{$readonly}} required>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>会社名</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
          <input type="text" name="companyname" maxlength="20" style="width: 100%;" value="{{$companyname}}" {{$readonly}} required>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>メールアドレス</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
          <input type="text" name="email" maxlength="100" style="width: 100%;" value="{{$email}}" {{$readonly}}>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>件名</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
          <input type="text" name="subject" maxlength="100" style="width: 100%;" value="{{$subject}}" {{$readonly}}>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>お問い合わせ種類</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        <select name="contact_kind">
          <option value="">-------</option>
          <option value="サービスについて">サービスについて</option>
          <option value="改善・要望">改善・要望</option>
          <option value="その他">その他</option>
        </select>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>お問い合わせ内容</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
          <textarea name="detail" style="width:100%;height:200px" {{$readonly}}>{{$detail}}</textarea>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-8 col-md-8"></div>
      <div class="col-sm-3 col-md-3"><input class="btn btn-primary" type="submit" name="confirm" value="送信する"></div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
</form>
@endsection