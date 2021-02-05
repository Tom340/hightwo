@extends('comlayout')

@section('content')
<form action="newProd" method="POST">
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
          <h3>商品詳細</h3>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>商品名</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        <p style="width: 100%;">{{ $product->name }}</p>
        <input type="hidden" name="product" value="{{ $product->name }}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>商品カテゴリ</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
        <p style="width: 100%;">{{ $product->category }}</p>
        <input type="hidden" name="category" value="{{ $product->category }}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>商品詳細</li>
          <li><img src="images/required.png" width="40px" height="19px" alt="" class="req"></li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        <p nstyle="width: 100%;">{{ $product->detail }}</p>
        <input type="hidden" name="detail" value="{{ $product->detail }}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>制約事項</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
        <p style="width: 100%;">{{ $product->restrictions }}</p>
        <input type="hidden" name="restrictions" value="{{ $product->restrictions }}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>カタログ</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        <p tyle="width: 100%;">{{ $product->catalog }}</p>
        <input type="button" name="download" value="ダウンロード">
        <input type="hidden" name="catalog" value="{{ $product->catalog }}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>非表示設定</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
          <input type="checkbox" id="disp" name="disp" value="1" <?php echo ($product->display==1) ? "checked='checked'" : "";?>>
          <label for="disp">オン</label>
        <input type="hidden" name="display" value="{{ $product->display }}">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-3 col-md-3"><input class="btn btn-light" type="button" name="return" value="戻る" onclick="window.history.back(-1);return false;"></div>
      <div class="col-sm-3 col-md-3"></div>
      <div class="col-sm-2 col-md-2"><a class="btn btn-primary" href="/newProd?id={{ $product->id }}" name="entry" style="width:100%;">{{$button}}</a></div>
      <div class="col-sm-1 col-md-1"></div>
      <input type="hidden" id="id" name="id" value="{{$product->id}}">
    </div>
</form>
@endsection