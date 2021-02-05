@extends('comlayout')

@section('content')
<script>
  function checkbox_check() {
    var accept = document.getElementById("accept");
    var confirm = document.getElementById("confirm");
    if (accept.checked) {
      confirm.disabled = false;
    } else {
      confirm.disabled = true;
    }
  }
</script>
<form action="{{$url}}" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 box" style="text-align: center;"><a href="/comTop">トップ</a></div>
      <div class="col-sm-2 col-md-2 box" style="text-align: center;"><a href="/comProd">商品管理</a></div>
      <div class="col-sm-2 col-md-2 box" style="text-align: center;"><a href="/jobSearch">仕事管理</a></div>
      <div class="col-sm-2 col-md-2 box" style="text-align: center;"><a href="/comUser">ユーザ検索</a></div>
      <div class="col-sm-2 col-md-2 box" style="text-align: center;"><a href="/comEdit">法人情報編集</a></div>
    </div>
    <div class="row" style="height:50px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-10 col-md-10">
          <h1>{{$title}}</h1>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>会社名</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
          <input type="text" name="companyname" id="companyname" maxlength="20" style="width: 100%;" value="{{$companyname}}" {{$readonly}} required>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>住所</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
          <input type="text" name="postalcode"  onKeyUp="AjaxZip3.zip2addr(this,'','address','address');" value="{{$postalcode}}" {{$readonly}}><br>
          <input type="text" name="address" maxlength="100" style="width: 100%;" value="{{$address}}" readonly>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>電話番号</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
          <input type="text" name="tel" maxlength="100" style="width: 100%;" value="{{$tel}}" {{$readonly}} required>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>代表者名</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
          <input type="text" name="president" maxlength="100" style="width: 100%;" value="{{$president}}" {{$readonly}} required>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>ホームページURL</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
          <input type="text" name="hpurl" maxlength="100" style="width: 100%;" value="{{$hpurl}}" {{$readonly}}>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>担当者名</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
          <input type="text" name="contact" maxlength="100" style="width: 100%;" value="{{$contact}}" {{$readonly}} required>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>担当者電話番号</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
          <input type="text" name="contact_tel" maxlength="100" style="width: 100%;" value="{{$contact_tel}}" {{$readonly}}>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>担当者メールアドレス</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
          <input type="text" name="contact_email" maxlength="100" style="width: 100%;" value="{{$contact_email}}" {{$readonly}} required>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>請求書送付先住所<br><div style="font-size: 80%">入力がない場合は、会社住所に送付します</div></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
          <input type="text" name="send_postalcode"  onKeyUp="AjaxZip3.zip2addr(this,'','send_address','send_address');" value="{{$send_postalcode}}" {{$readonly}}><br>
          <input type="text" name="send_address" maxlength="100" style="width: 100%;" value="{{$send_address}}" {{$readonly}}>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>パスワード</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
          <input type="password" name="password" maxlength="20" style="width: 100%;" value="{{$password}}" {{$readonly}} required>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <br><br>
    <div class="row" style="{{$confirm}}">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-10 col-md-10">
          <h1>利用規約・免責事項</h1>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="{{$confirm}}">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-10 col-md-10">
          <textarea name="rules" style="width:100%;height:200px" readonly>{{$rules}}</textarea>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row" style="{{$confirm}}">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-4 col-md-4"></div>
      <div class="col-sm-5 col-md-5">
          <input type="checkbox" id="accept" name="accept" value="1" <?php echo ($accept==1) ? "checked='checked'" : "";?> onchange="checkbox_check();" {{$readonly}}>
          <label for="accept">同意する</label>
      </div>
      <div class="col-sm-2 col-md-2"></div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-3 col-md-3"><input class="btn btn-light" type="button" name="return" value="戻る" onclick="window.history.back(-1);return false;"></div>
      <div class="col-sm-3 col-md-3"></div>
      <div class="col-sm-3 col-md-3"><input class="btn btn-primary" type="submit" name="confirm" id="confirm" value="{{$button}}" {{$disabled}}></div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
</form>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection