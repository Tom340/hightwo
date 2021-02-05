@extends('userlayout')

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
<form action="userJob" method="POST" onsubmit="return check()">
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
      <div class="col-sm-10 col-md-10" style="font-weight: bold;"><h3>仕事検索</h3></div>
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
      <div class="col-sm-2 col-md-2">活かせる経験</div>
      <div class="col-sm-7 col-md-7">
        @foreach ($skills as $row)
          <input type="checkbox" id="skill{{$row->id}}" name="skill[]" value="{{$row->id}}" {{$readonly}}>
          <label for="skill{{$row->id}}">{{$row->skill}}</label>
        @endforeach
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
          @foreach ($job as $row)
          <tr class="box">
            <td>
              <table style="width:100%;">
                <tr>
                  <td colspan="3">{{ $row->title }}</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td rowspan="2">{{ $row->detail }}</td>
                  <td rowspan="2">
                    <?php 
                    $skillary = explode(",",$row->skill);
                    foreach ($skillary as $skill) {
                      foreach ($skills as $row2) {
                        if ($skill==$row2->id) {
                          echo $row2->skill."<br>";
                        }
                      }
                    }
                    ?>
                  </td>
                  <td>{{ str_replace('-','/',explode(' ', $row->accept_from)[0]) }}～{{str_replace('-','/',explode(' ', $row->accept_to)[0]) }}</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>{{ number_format($row->reward) }}円</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" style="width:90%;"></td>
                  <td><a href="/userJobDetail?id={{ $row->id }}" style="position:absoluete;right='20px'">詳細を見る</a></td>
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
            <?php if (count($job)>0) { ?>
            <div class="d-flex justify-content-center">
                {{ $job->links() }}
            </div>
            <?php } ?>
          </li>
        </ul>
      </div>
    </div>
</form>
@endsection