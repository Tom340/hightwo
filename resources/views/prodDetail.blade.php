@extends('userlayout')

@section('content')
<script>
  function pdfdownload(filename, id) {
    document.location.href="/public/storage/"+id+"/"+filename;
  }
</script>
<form action="newProd" method="POST">
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
          <h3>商品詳細</h3>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>商品名</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        <p name="product" style="width: 100%;">{{ $product->name }}</p>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>商品カテゴリ</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
        <p name="category" style="width: 100%;">{{ $product->category }}</p>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>商品詳細</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        <p name="detail" style="width: 100%;">{{ $product->detail }}</p>
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
        <p name="restrictions" style="width: 100%;">{{ $product->restrictions }}</p>
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
      <div class="col-sm-5 col-md-5 box even">
        <p name="catalog" style="width: 100%;">{{ $product->catalog }}</p>
      </div>
      <div class="col-sm-2 col-md-2 box even">
        <input type="button" name="download" value="ダウンロード" onclick="pdfdownload('{{ $product->catalog }}', {{ $product->company }});">
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>取扱会社名</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
        <p name="company_name" style="width: 100%;">{{ $product->company_name }}</p>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>会社住所</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        <p name="company_addr" style="width: 100%;">{{ $product->company_addr }}</p>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box odd">
        <ul>
          <li>ホームページURL</li>
        </ul>
      </div>
      <div class="col-sm-7 col-md-7 box odd">
        <p name="company_url" style="width: 100%;">{{ $product->company_url }}</p>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-3 col-md-3"><input class="btn btn-light" type="button" name="return" value="戻る" onclick="window.history.back(-1);window.history.back(-1);return false;"></div>
    </div>
</form>
@endsection