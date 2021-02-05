<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="images/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>{{$title}}</title>
    </head>
    <body>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-1 col-md-1"><a href="/"><img src="images/logo.png" width="145px" height="56px" alt="logo"></a></div>
          <div class="col-sm-11 col-md-11"></div>
        </div>
        <hr>
        @yield('content')
        <hr>
        <div class="row bg5 line">
          <div class="col-sm-2 col-md-2"></div>
          <div class="col-sm-10 col-md-10">
            <ul>
              <li class="footer"><a href="/">トップ</a></li>
              <li class="footer"><a href="/#3point">サービス内容</a></li>
              <li class="footer"><a href="/contact">お問い合わせ</a></li>
              <li class="footer"><a href="/login">ログイン</a></li>
              <li class="footer"><a href="/privacypolicy">プライバシーポリシー</a></li>
              <li class="footer"><a href="/rules">利用規約・免責事項</a></li>
              <li class="footer"><a href="https://hightwo.co.jp/">運営会社</a></li>
            </ul>
          </div>
        </div>
        <div class="row bg6">
          <div class="col-sm-12 col-md-12" style="text-align:center;color:white;">copyright © 2020 threeK All Rights Reserved.</div>
        </div>
        <br><br>
      </div>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>
