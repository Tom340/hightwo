@extends('userlayout')

@section('content')
<script>
function send(){
  var search = document.getElementById("search");
  if (search.value === "") {
    alert("検索条件を指定してください");
    return false;
  }
  return true;
}
</script>
<form action="entryJob" method="POST" onsubmit="send();return false;">
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
          <h3>仕事詳細</h3>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-9 col-md-9"></div>
      <div class="col-sm-1 col-md-1">
        <p>仕事ID:{{ $job->id }}</p>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>タイトル</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        <p style="width: 100%;">{{ $job->title }}</p>
        <input type="hidden" name="title" value="{{ $job->title }}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>応募受付期間</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
        <p tyle="width: 100%;">{{ str_replace('-','/',explode(' ', $job->accept_from)[0]) }}～{{str_replace('-','/',explode(' ', $job->accept_to)[0]) }}</p>
        <input type="hidden" name="accept_from" value="{{ $job->accept_from }}">
        <input type="hidden" name="accept_to" value="{{ $job->accept_to }}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>報酬</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        <p style="width: 100%;">{{ number_format($job->reward) }}円</p>
        <input type="hidden" name="reward" value="{{ $job->reward }}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>仕事詳細</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
        <p style="width: 100%;">{{ $job->detail }}</p>
        <input type="hidden" name="detail" value="{{ $job->detail }}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>マッチングするスキル<li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        <p style="width: 100%;">
          <?php 
          $skillary = explode(",",$job->skill);
          foreach ($skillary as $skill) {
            foreach ($skills as $row) {
              if ($skill==$row->id) {
                echo $row->skill."<br>";
              }
            }
          }
          ?>
          </p>
        <input type="hidden" name="skill" value="{{ $job->skill }}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>掲載会社名<li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
        <p style="width: 100%;">{{ $job->company_name }}</p>
        <input type="hidden" name="company" value="{{ $job->company }}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>会社住所<li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        <p style="width: 100%;">{{ $job->company_addr }}</p>
        <input type="hidden" name="company_addr" value="{{ $job->company_addr }}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>ホームページURL<li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
        <p style="width: 100%;">{{ $job->company_url }}</p>
        <input type="hidden" name="company_url" value="{{ $job->company_url }}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-3 col-md-3"><input class="btn btn-light" type="button" name="return" value="戻る" onclick="window.history.back(-1);window.history.back(-1);return false;"></div>
      <div class="col-sm-3 col-md-3"></div>
      <div class="col-sm-3 col-md-3"><input class="btn btn-primary" type="submit" name="entry" value="{{$button}}"></div>
      <div class="col-sm-1 col-md-1"></div>
      <input type="hidden" name="id" value="{{ $job->id }}">
    </div>
</form>
@endsection