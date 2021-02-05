@extends('comlayout')

@section('content')
<form action="newJob" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-2 col-md-2 box" style="text-align: center;"><a href="/comTop">トップ</a></div>
      <div class="col-sm-2 col-md-2 box" style="text-align: center;"><a href="/comProd">商品管理</a></div>
      <div class="col-sm-2 col-md-2 box" style="text-align: center;"><a href="/jobSearch">仕事管理</a></div>
      <div class="col-sm-2 col-md-2 box" style="text-align: center;"><a href="/comUser">ユーザ検索</a></div>
      <div class="col-sm-2 col-md-2 box" style="text-align: center;"><a href="/comEdit">法人情報編集</a></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-10 col-md-10">
          <h3>{{ $title }}</h3>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>タイトル</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
          <input type="text" name="title" id="title" maxlength="20" style="width: 100%;" value="{{$job_title}}" {{$readonly}} required>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>応募受付期間</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
          <input type="text" name="from" maxlength="10" style="width: 200px;" value="{{ explode(' ', $from)[0] }}" {{$readonly}}>～
          <input type="text" name="to" maxlength="10" style="width: 200px;" value="{{explode(' ', $to)[0] }}" {{$readonly}}>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>報酬</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
          <input type="text" name="reward" maxlength="100" style="width: 100%;" value="{{$reward}}" {{$readonly}}>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>仕事詳細</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
          <input type="text" name="detail" maxlength="100" style="width: 100%;" value="{{$detail}}" {{$readonly}}>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>マッチングするスキル</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        @foreach ($category as $row)
          <input type="checkbox" id="jobkind{{$row->id}}" name="jobkind[]" value="{{$row->id}}" <?php if (!empty($skill)) { echo !is_bool(array_search($row->id, $skill)) ? "checked='checked'" : "";} ?> {{$readonly}}>
          <label for="jobkind{{$row->id}}">{{$row->skill}}</label><br>
        @endforeach
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-3 col-md-3"><input class="btn btn-light" type="button" name="return" value="戻る" onclick="window.history.back(-1);return false;"></div>
      <div class="col-sm-3 col-md-3"></div>
      <div class="col-sm-3 col-md-3"><input class="btn btn-primary" type="submit" name="confirm" value="{{$button}}"></div>
      <div class="col-sm-1 col-md-1"></div>
      <input type="hidden" id="jobid" name="jobid" value="{{$jobid}}">
    </div>
</form>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection