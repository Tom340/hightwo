@extends('userlayout')

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
      <div class="col-sm-2 col-md-2 box" style="text-align: center;"><a href="/userTop">トップ</a></div>
      <div class="col-sm-2 col-md-2 box" style="text-align: center;"><a href="/userSearchTop">商品検索</a></div>
      <div class="col-sm-2 col-md-2 box" style="text-align: center;"><a href="/userJobTop">仕事検索</a></div>
      <div class="col-sm-2 col-md-2 box" style="text-align: center;"><a href="/userEdit">会員情報編集</a></div>
    </div>
    <div class="row" style="height:50px"></div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-10 col-md-10">
          <h1>会員情報編集</h1>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>ニックネーム</li>
        </ul>
        <p>ニックネームは変更できません</p>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        <p>{{$nickname}}</p>
        <input type="hidden" name="nickname" value="{{$nickname}}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>メールアドレス</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
          <input type="text" name="email" maxlength="100" style="width: 100%;" value="{{$email}}" {{$readonly}}>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>生年月日</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
          <input type="text" name="year" minlength="4" maxlength="4" style="width: 30%;" value="{{$year}}" {{$readonly}}>年
          <input type="text" name="month" minlength="1" maxlength="2" style="width: 20%;" value="{{$month}}" {{$readonly}}>月
          <input type="text" name="day" minlength="1" maxlength="2" style="width: 20%;" value="{{$day}}" {{$readonly}}>日
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
          <label>〒<input type="text" name="postalcode"  onKeyUp="AjaxZip3.zip2addr(this,'','address','address');" value="{{$postalcode}}" {{$readonly}}></label><br>
          <input type="text" name="address" maxlength="100" style="width: 80%;" value="{{$address}}" readonly>(住所検索結果を反映)
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>業務経歴</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
          <input type="checkbox" id="jobkind1" name="jobkind[]" value="1" <?php if (!empty($job_kind)) { echo !is_bool(array_search('1', $job_kind)) ? "checked='checked'" : "";} ?> {{$readonly}}>
          <label for="jobkind1">営業・マーケティング</label><br>
          <input type="checkbox" id="jobkind2" name="jobkind[]" value="2" <?php if (!empty($job_kind)) { echo !is_bool(array_search('2', $job_kind)) ? "checked='checked'" : "";}?> {{$readonly}}>
          <label for="jobkind2">財務経理</label><br>
          <input type="checkbox" id="jobkind3" name="jobkind[]" value="3" <?php if (!empty($job_kind)) { echo !is_bool(array_search('3', $job_kind)) ? "checked='checked'" : "";} ?> {{$readonly}}>
          <label for="jobkind3">人事</label><br>
          <input type="checkbox" id="jobkind4" name="jobkind[]" value="4" <?php if (!empty($job_kind)) { echo !is_bool(array_search('4', $job_kind)) ? "checked='checked'" : "";} ?> {{$readonly}}>
          <label for="jobkind4">SWエンジニア</label><br>
          <input type="checkbox" id="jobkind5" name="jobkind[]" value="5" <?php if (!empty($job_kind)) { echo !is_bool(array_search('5', $job_kind)) ? "checked='checked'" : "";} ?> {{$readonly}}>
          <label for="jobkind5">HWエンジニア</label><br>
          <input type="checkbox" id="jobkind6" name="jobkind[]" value="6" <?php if (!empty($job_kind)) { echo !is_bool(array_search('6', $job_kind)) ? "checked='checked'" : "";} ?> {{$readonly}}>
          <label for="jobkind6">デザイナー</label><br>
          <input type="checkbox" id="jobkind7" name="jobkind[]" value="7" <?php if (!empty($job_kind)) { echo !is_bool(array_search('7', $job_kind)) ? "checked='checked'" : "";} ?> {{$readonly}}>
          <label for="jobkind7">建築設計</label><br>
          <input type="checkbox" id="jobkind8" name="jobkind[]" value="8" <?php if (!empty($job_kind)) { echo !is_bool(array_search('8', $job_kind)) ? "checked='checked'" : "";} ?> {{$readonly}}>
          <label for="jobkind8">品質管理</label><br>
          <input type="checkbox" id="jobkind9" name="jobkind[]" value="9" <?php if (!empty($job_kind)) { echo !is_bool(array_search('9', $job_kind)) ? "checked='checked'" : "";} ?> {{$readonly}}>
          <label for="jobkind9">データサイエンティスト</label><br>
          <input type="checkbox" id="jobkind10" name="jobkind[]" value="10" <?php if (!empty($job_kind)) { echo !is_bool(array_search('10', $job_kind)) ? "checked='checked'" : "";} ?> {{$readonly}}>
          <label for="jobkind10">研究開発</label><br>
          <input type="checkbox" id="jobkind11" name="jobkind[]" value="11" <?php if (!empty($job_kind)) { echo !is_bool(array_search('11', $job_kind)) ? "checked='checked'" : "";} ?> {{$readonly}}>
          <label for="jobkind11">その他</label><br>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>経歴詳細</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
          <textarea name="jobhist" style="width:100%;height:200px" {{$readonly}} required>{{$job_hist}}</textarea>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>オファー設定</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
          <input type="checkbox" id="offer" name="offer" value="1" <?php echo ($offering==1) ? "checked='checked'" : "";?> {{$readonly}}>
          <label for="offer">オファーを受ける</label>
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
