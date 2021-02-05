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
          <h3>ユーザ詳細</h3>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>ニックネーム</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        <p style="width: 100%;">{{ $user->nick_name }}</p>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>メールアドレス</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
        <p tyle="width: 100%;">{{ $user->email }}</p>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>住所</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        <p style="width: 100%;">{{ $user->postalcode }}</p>
        <p style="width: 100%;">{{ $user->address }}</p>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>業務経歴</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
        <p style="width: 100%;">
          <?php 
          $skillary = explode(",",$user->job_kind);
          foreach ($skillary as $skill) {
            foreach ($skills as $row) {
              if ($skill==$row->id) {
                echo $row->skill."<br>";
              }
            }
          }
          ?>
          </p>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>経歴詳細</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        <p style="width: 100%;">{{ $user->job_hist }}</p>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-3 col-md-3"><input class="btn btn-light" type="button" name="return" value="戻る" onclick="window.history.back(-1);return false;"></div>
      <div class="col-sm-3 col-md-3"></div>
      <div class="col-sm-3 col-md-3"><?php if($user->offering) echo '<a class="btn btn-primary" href="/comOffer?id='.$user->id.'" name="entry" style="width:100%;">オファーする</a>'; ?></div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
</form>
@endsection