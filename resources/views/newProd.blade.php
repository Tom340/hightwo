@extends('comlayout')

@section('content')
<script>
  function checkPDF() {
    var browse = document.getElementById('browse');
    if (browse.value.length==0) return true; 
    var pos = browse.value.lastIndexOf('.');
    if (pos === -1) {
      alert("PDFファイルを指定してください")
      browse.value="";
      return false;
    }
    var ext = browse.value.slice(pos + 1);
    if (ext != "pdf") {
      alert("PDFファイルを指定してください")
      browse.value="";
      return false;
    }
    return true;
  }
</script>
<form action="newProd" method="POST" enctype="multipart/form-data">
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
          <h3>{{$title}}</h3>
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
          <input type="text" name="product" maxlength="20" style="width: 100%;" value="{{ $product }}" {{$readonly}} required>
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
        <ul>
          <li>
            <select name="category" {{$readonly}} required>
              <option value="">選択してください</option>
            @foreach ($category as $row)
              <option value="{{ $row->id }}" <?php echo ($row->id==$category_sel) ? "selected" : "";?>>{{ $row->category }}</option>
            @endforeach
            </select>
          </li>
        </ul>
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
        <textarea name="detail" style="width:100%;height:200px" {{$readonly}} required>{{ $detail }}</textarea>
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
        <textarea name="restrictions" style="width:100%;height:200px" {{$readonly}}>{{ $restrictions }}</textarea>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-1 col-md-1"></div>
      <div class="col-sm-3 col-md-3 box even">
        <ul>
          <li>カタログ</li>
        </ul>
        <p>pdf形式で5MB以内にしてください</p>
      </div>
      <div class="col-sm-7 col-md-7 box even">
        <ul>
          <li>
            <input type="text" name="catalog" maxlength="100" style="width: 100%;" value="{{ $catalog }}" {{$readonly}}>
          </li>
          <li>
            <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
            <input type="file" name="browse" id="browse" accept="application/pdf" value="参照" onchange="checkPDF();">
          </li>
        </ul>
      </div>
      <div class="col-sm-1 col-md-1"></div>
    </div>
    <div class="row">
      <div class="col-sm-2 col-md-2"></div>
      <div class="col-sm-3 col-md-3"><input class="btn btn-light" type="button" name="return" value="戻る" onclick="window.history.back(-1);return false;"></div>
      <div class="col-sm-3 col-md-3"></div>
      <div class="col-sm-3 col-md-3"><input class="btn btn-primary" type="submit" name="confirm" value="{{$button}}"></div>
      <div class="col-sm-1 col-md-1"></div>
      <input type="hidden" id="prod" name="prod" value="{{$prod}}">
    </div>
</form>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection