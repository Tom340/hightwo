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
<form action="userSearch" method="POST" onsubmit="return check()">
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
      <div class="col-sm-10 col-md-10" style="font-weight: bold;"><h3>商品検索</h3></div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-10 col-md-10">
        <ul>
          <li>
            <select name="category">
              <option value="">選択してください</option>
            @foreach ($category as $row)
              <option value="{{ $row->id }}">{{ $row->category }}</option>
            @endforeach
            </select>
          </li>
          <li>
            <input type="text" name="search" id ="search" placeholder="キーワードを入力してください" size="90%" style="width:100%;" value="{{$search}}">
          </li>
          <li>
            <input type="submit" name="submit" value="検索" style="border-radius: 5px;">
          </li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-10 col-md-10"></div>
        <table style="width:90%; margin: 20px">
          @foreach ($product as $row)
          <tr class="box">
            <td>
              <table style="width:100%;">
                <tr>
                  <td colspan="4">{{ $row->name }}</td>
                </tr>
                <tr>
                  <td colspan="4">{{ $row->category }}</td>
                </tr>
                <tr>
                  <td colspan="4">{{ $row->company }}</td>
                </tr>
                <tr>
                  <td colspan="3" style="width:90%;"></td>
                  <td><a href="/prodDetail?id={{ $row->id }}" style="position:absoluete;right='20px'">詳細を見る</a></td>
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
            <?php if (count($product)>0) { ?>
            <div class="d-flex justify-content-center">
                {{ $product->links() }}
            </div>
            <?php } ?>
          </li>
        </ul>
      </div>
    </div>
</form>
@endsection