@extends('comlayout')

@section('content')
<form action="comProd" method="POST">
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
      <div class="col-sm-10 col-md-10" style="font-weight: bold;"><h3>仕事一覧</h3></div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-10 col-md-10"></div>
      <div class="col-sm-2 col-md-2">
        <a class="btn btn-primary" href="/newJob" name="entry" style="width:100%;">新規登録</a>
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
                  <td>{{ explode(' ', $row->accept_from)[0] }}～{{explode(' ', $row->accept_to)[0] }}</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>{{ $row->reward }}</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" style="width:90%;"></td>
                  <td><a href="/jobDetail?id={{ $row->id }}" style="position:absoluete;right='20px'">詳細を見る</a></td>
                </tr>
              </table>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
</form>
@endsection