@extends('comlayout')

@section('content')
<script>
function check(){
  var search = document.getElementById("search");
  if (search.value === "") {
    alert("検索条件を指定してください");
    return false;
  }
  return true;
}
</script>
<form action="comUser" method="POST" onsubmit="return check()">
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
      <div class="col-sm-10 col-md-10" style="font-weight: bold;"><h3>ユーザ検索</h3></div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2">フリーワード</div>
      <div class="col-sm-7 col-md-7">
        <input type="text" id="search" name="search" style="width:100%;" placeholder="フリーワードを入力してください">
      </div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2">業務経歴</div>
      <div class="col-sm-7 col-md-7">
        @foreach ($skills as $row)
          <input type="checkbox" id="skill{{$row->id}}" name="skill[]" value="{{$row->id}}">
          <label for="skill{{$row->id}}">{{$row->skill}}</label>
        @endforeach
      </div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2">オファー</div>
      <div class="col-sm-7 col-md-7">
        <input type="checkbox" id="offer" name="offer" value="1">
        <label for="offer">オファーを受け付けているユーザのみ表示</label>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-9 col-md-9"></div>
      <div class="col-sm-2 col-md-2">
        <input class="btn btn-primary"type="submit" name="confirm" value="検索">
      </div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-10 col-md-10"></div>
        <table style="width:90%; margin: 20px">
          @foreach ($user as $row)
          <tr class="box">
            <td>
              <table style="width:100%;">
                <tr>
                  <td colspan="3" style="width:90%;">{{ $row->nick_name }}</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td rowspan="2">{{ $row->job_hist }}</td>
                  <td rowspan="2">
                    <?php 
                    $skillary = explode(",",$row->job_kind);
                    foreach ($skillary as $skill) {
                      foreach ($skills as $row2) {
                        if ($skill==$row2->id) {
                          echo $row2->skill."<br>";
                        }
                      }
                    }
                    ?>
                  </td>
                  <td><?php echo ($row->offering) ? "オファー受付中" : ""?></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3"></td>
                  <td><a href="/comUserDetail?id={{ $row->id }}" style="position:absoluete;right='20px'">詳細を見る</a></td>
                </tr>
              </table>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <ul>
          <li>
            <?php if (count($user)>0) { ?>
            <div class="d-flex justify-content-center">
                {{ $user->links() }}
            </div>
            <?php } ?>
          </li>
        </ul>
      </div>
    </div>
</form>
@endsection