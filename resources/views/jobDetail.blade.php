@extends('comlayout')

@section('content')
<form action="jobEdit" method="POST">
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
          <h3>仕事詳細</h3>
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
        <p tyle="width: 100%;">{{explode(' ', $job->accept_from)[0] }} ～ {{explode(' ', $job->accept_to)[0] }}</p>
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
        <p style="width: 100%;">{{ $job->reward }}</p>
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
          <li>マッチングするスキルi>
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
          <li>非表示設定<li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
        <input type="checkbox" id="disp" name="disp" value="1" <?php echo ($job->display==1) ? "checked='checked'" : "";?>>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-3 col-md-3"><input class="btn btn-light" type="button" name="return" value="戻る" onclick="window.history.back(-1);return false;"></div>
      <div class="col-sm-3 col-md-3"></div>
      <div class="col-sm-3 col-md-3"><a class="btn btn-primary" href="/newJob?id={{ $job->id }}" name="entry" style="width:100%;">{{$button}}</a></div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
</form>
@endsection