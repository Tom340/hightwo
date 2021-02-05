@extends('layout')

@section('content')
<script>
function getContent(obj) {
  var idx = obj.selectedIndex;
  var value = obj.options[idx].value; // 値
  if (value == "") return;

  var input = document.getElementById("newlabel");
  if (value == "新規作成") {
    input.style.visibility = "visible";
  } else {
    input.style.visibility = "hidden";
  }
  var ajax = new XMLHttpRequest();
  ajax.open("get", "siteget?title="+value);
  ajax.responseType = "json";
  ajax.send(); // 通信させます。
  ajax.addEventListener("load", function(){ // loadイベントを登録します。
      var json = this.response;
      document.getElementById("content").value = json['content'];
  }, false);
}
</script>
<div id="popup">
    <div>登録画面</div>
    <p>仮登録のメールを送信しました。</p>

    <p>メール本文にあるURLをクリックし、24時間以内に本登録を行ってください。</p>
    <input type="button" class="btn btn-primary" name="close" id="close" value="確認">
</div>        

<form action="admintop" method="POST" name="from">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-10 col-md-10">
          <h1>管理者編集画面</h1>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>編集項目選択</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
          <select name="itemselect" onchange="getContent(this);" style="width: 100%;">
            <option value="">選択してください</option>
            @foreach ($results as $row)
            <option value="{{$row->title}}">{{$row->title}}</option>
            @endforeach
            <option value="新規作成">新規作成</option>
          </select>
          <label name="newlabel" id="newlabel" style="visibility: hidden;">項目名<input type="text" name="new" id="new" value=""></label>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>編集内容</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
          <textarea name="content" id="content" style="width:100%;height:200px"></textarea>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-3 col-md-3"><input class="btn btn-light" type="button" name="return" value="戻る" onclick="window.history.back(-1);return false;"></div>
      <div class="col-sm-3 col-md-3"></div>
      <div class="col-sm-3 col-md-3"><input class="btn btn-primary" type="submit" name="confirm" value="保存"></div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
</form>
<script>
var input = document.getElementById("new");
input.style.display = none;
</script>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection