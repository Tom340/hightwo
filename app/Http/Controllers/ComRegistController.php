<?php

namespace App\Http\Controllers;

use App\ComRegist;
use App\Site;
use App\Category;
use App\News;
use App\product;
use App\Skill;
use App\job;
use Illuminate\Http\Request;
use DB;
use Log;

class ComRegistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        @session_start();

        $site = new Site;
        $rules="";
        $results = $site->where('title','利用規約・免責事項')->get();
        foreach ($results as $row) {
            $rules=$row['content'];
            break;
        }

        $_SESSION['id'] = '';
        return view('comRegist')->with([
            'rules' => $rules,
            'readonly' => '',
            'companyname' => '',
            'postalcode' => '',
            'address' => '',
            'tel' => '',
            'president' => '',
            'hpurl' => '',
            'contact' => '',
            'contact_tel' => '',
            'contact_email' => '',
            'send_postalcode' => '',
            'send_address' => '',
            'password' => '',
            'accept' => '',
            'button' => '確認',
            'url' => 'comRegist',
            'onsubmit' => '',
            'confirm' => '',
            'disabled' => 'disabled',
            'title' => '法人登録'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function top()
    {
        @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        if ($_SESSION['user']!='com') {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }        
        
        $news = new News;
        $results = $news->where('type','2')->orderBy('entried_at', 'DESC')->take(10)->get();

        return view('comTop')->with([
        'name' => $_SESSION['name'],
        'news' => $results,
        'title' => '法人トップ'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product(Request $request)
    {
        @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        
        $id = $_SESSION['id'];
        $all_prod = DB::select("SELECT MstProduct.id,MstProduct.name,MstCategory.category,MstCom.name as company FROM MstProduct left join MstCategory on MstProduct.category = MstCategory.id left join MstCom on MstProduct.company = MstCom.id where company = ".$id);

        $per_page = 30;
        $page_num = isset($request->page) ? $request->page : 1;
        $product = array_slice($all_prod, ($page_num-1) * $per_page, $per_page);

        $pager= new \Illuminate\Pagination\LengthAwarePaginator(
            $product, // ページ番号で指定された表示するレコード配列
            count($all_prod), // 検索結果の全レコード総数
            $per_page, // 1ページ当りの表示数
            $page_num, // 表示するページ
            ['path' => $request->url()] // ページャーのリンク先のURLを指定
        );

        return view('comSearch')->with([
        'name' => $_SESSION['name'],
        'product' => $pager,
        'title' => '商品一覧'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prodEdit()
    {
        @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        
        $id = request('id');
        $category = new Category;
        $results = $category->orderBy('id', 'ASC')->get();
        $product = DB::select("SELECT MstProduct.*,MstCategory.category FROM MstProduct left join MstCategory on MstProduct.category = MstCategory.id WHERE MstProduct.id = ".$id);
        $_SESSION['newProd'] = 1;
        foreach($product as $row) {
            return view('prodEdit')->with([
            'name' => $_SESSION['name'],
            'category' => $results,
            'product' => $row,
            'readonly' => 'disabled="disabled"',
            'button' => '編集',
            'id' => $id,
            'title' => '商品詳細'
            ]);
            break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newProd(Request $request)
    {
        @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        
        $prod = request('id');
        
        $id = $_SESSION['id'];
        $category = new Category;
        $results = $category->orderBy('id', 'ASC')->get();

        if ($prod == '0') {
            return view('newProd')->with([
            'name' => $_SESSION['name'],
            'category' => $results,
            'category_sel' => '',
            'product' => '',
            'detail' => '',
            'restrictions' => '',
            'catalog' => '',
            'readonly' => '',
            'button' => '確認',
            'title' => '商品情報登録',
            'prod' => $prod
            ]);
        } else {
            $product = DB::select("SELECT MstProduct.* FROM MstProduct WHERE MstProduct.id = ".$prod);
            foreach($product as $row) {
                return view('newProd')->with([
                'name' => $_SESSION['name'],
                'category' => $results,
                'category_sel' => $row->category,
                'product' => $row->name,
                'detail' => $row->detail,
                'restrictions' => $row->restrictions,
                'catalog' => $row->catalog,
                'readonly' => '',
                'button' => '確認',
                'title' => '商品情報編集',
                'prod' => $prod
                ]);
                break;
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmProd(Request $request)
    {
        @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        
        $prod = request('prod');
        $id = $_SESSION['id'];
        $category = new Category;
        $results = $category->orderBy('id', 'ASC')->get();
        
        $cat = request('category');
        $product = request('product');
        $detail = request('detail');
        $restrictions = request('restrictions');
        $catalog = request('catalog');
        $file = $request->browse;
        if ($file) {
            $filename = $file->getClientOriginalName();
            $file->storeAs("public/".$id,$filename);
        }
        
        $_SESSION['category'] = $cat;
        $_SESSION['product'] = $product;
        $_SESSION['detail'] = $detail;
        $_SESSION['restrictions'] = $restrictions;
        $_SESSION['catalog'] = null;
        if ($file) {
            $_SESSION['catalog'] = $file->getClientOriginalName();
        } else {
            $_SESSION['catalog'] = $catalog;
        }
        $catalog  = $_SESSION['catalog'];
        $_SESSION['browse'] = $file;

        if ($prod == '0') {
            return view('newProdRegist')->with([
            'name' => $_SESSION['name'],
            'category' => $results,
            'category_sel' => $cat,
            'product' => $product,
            'detail' => $detail,
            'restrictions' => $restrictions,
            'catalog' => $catalog,
            'readonly' => 'disabled="disabled"',
            'button' => '登録',
            'title' => '商品情報登録',
            'prod' => $prod
            ]);
        } else {
            return view('newProdRegist')->with([
            'name' => $_SESSION['name'],
            'category' => $results,
            'category_sel' => $cat,
            'product' => $product,
            'detail' => $detail,
            'restrictions' => $restrictions,
            'catalog' => $catalog,
            'readonly' => 'disabled="disabled"',
            'button' => '更新',
            'title' => '商品情報編集',
            'prod' => $prod
            ]);
        }
    }

    public function registProd(Request $request)
    {
        @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        
        $prod = request('prod');
        $id = $_SESSION['id'];

        $cat = request('category');
        $detail = request('detail');
        $restrictions = request('restrictions');
        $catalog = request('catalog');

        $product = null;
        if ($prod == "0") {
            $product = new product;
        } else {
            $product = product::findOrFail($prod);
        }
        $product->fill([
            'name' => $_SESSION['name'],
            'category' => $cat,
            'detail' => $detail,
            'restrictions' => $restrictions,
            'catalog' => $catalog,
            'company' => $id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $product->save();
        if ($prod == "0") {
            echo "<script>alert('商品情報を新規登録しました。');location.href='/comProd';</script>";
        } else {
            echo "<script>alert('商品情報を更新しました。');location.href='/comProd';</script>";
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jobSearch()
    {
        @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        
        $id = $_SESSION['id'];
        $product = DB::select("SELECT jobs.* FROM jobs where company = ".$id);

        return view('jobSearch')->with([
        'name' => $_SESSION['name'],
        'job' => $product,
        'title' => '仕事一覧'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newJob()
    {
        @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        
        $skills = new Skill;
        $results = $skills->orderBy('id', 'ASC')->get();

        $jobid = request('id');
        if (!isset($jobid)) {
            $jobid = 0;
        }
        $id = $_SESSION['id'];
        $jobs = DB::select("SELECT * FROM jobs where company = ".$id." and id = ".$jobid);
        $title = "";
        $from = "";
        $to = "";
        $reward = "";
        $detail = "";
        $skill[] = "";
        foreach($jobs as $job) {
            $jobid = $job->id;
            $title = $job->title;
            $from = $job->accept_from;
            $to = $job->accept_to;
            $reward = $job->reward;
            $detail = $job->detail;
            $skill = explode(",", $job->skill);
            break;
        }
        $_SESSION['newJob'] = 1;
        if ($jobid == 0) {
            return view('newJob')->with([
            'name' => $_SESSION['name'],
            'job_title' => $title,
            'from' => $from,
            'to' => $to,
            'reward' => $reward,
            'detail' => $detail,
            'skill' => $skill,
            'category' => $results,
            'button' => '確認',
            'readonly' => '',
            'title' => '仕事登録',
            'jobid' => $jobid
            ]);
        } else {
            return view('newJob')->with([
            'name' => $_SESSION['name'],
            'job_title' => $title,
            'from' => $from,
            'to' => $to,
            'reward' => $reward,
            'detail' => $detail,
            'skill' => $skill,
            'category' => $results,
            'button' => '確認',
            'readonly' => '',
            'title' => '仕事編集',
            'jobid' => $jobid
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jobConfirm(Request $request)
    {
        @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        
        $id = $_SESSION['id'];
        if ($_SESSION['newJob'] == 1) {
            $_SESSION['newJob'] = 2;
            $skill = new Skill;
            $results = $skill->orderBy('id', 'ASC')->get();
            
            $jobid = request('jobid');
            $title = request('title');
            $from = request('from');
            $to = request('to');
            $reward = request('reward');
            $detail = request('detail');
            $skill = request('jobkind');

            $_SESSION['jobid'] = $jobid;
            $_SESSION['title'] = $title;
            $_SESSION['from'] = $from;
            $_SESSION['to'] = $to;
            $_SESSION['reward'] = $reward;
            $_SESSION['detail'] = $detail;
            $_SESSION['skill'] = $skill;
    
            return view('newJob')->with([
                'name' => $_SESSION['name'],
                'job_title' => $title,
                'from' => $from,
                'to' => $to,
                'reward' => $reward,
                'detail' => $detail,
                'skill' => $skill,
                'category' => $results,
                'button' => '登録',
                'readonly' => 'disabled="disabled"',
                'title' => '仕事登録',
                'jobid' => $jobid
            ]);
        } else {
            $jobs = null;
            if ($_SESSION['jobid'] == 0) {
                $jobs = new job;
            } else { 
                $jobs = job::findOrFail($_SESSION['jobid']);
            }
            $jobs->fill([
                'title' => $_SESSION['title'],
                'detail' => $_SESSION['detail'] ,
                'accept_from' => $_SESSION['from'],
                'accept_to' => $_SESSION['to'],
                'reward' => $_SESSION['reward'],
                'skill' => implode(',',$_SESSION['skill']) ,
                'display' => '0',
                'company' => $id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $jobs->save();
            if ($_SESSION['jobid'] == 0) {
                echo "<script>alert('仕事情報を新規登録しました。');location.href='/jobSearch';</script>";
            } else {
                echo "<script>alert('仕事情報を更新しました。');location.href='/jobSearch';</script>";
            }
        }
    }

    public function jobDetail(Request $request)
    {
       @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        
        $skills = new Skill;
        $results = $skills->orderBy('id', 'ASC')->get();
        
        $job = new job;
        $jobs =$job->where('id', $request->id)->get();
        foreach ($jobs as $row) {
            return view('jobDetail')->with([
                'name' => $_SESSION['name'],
                'skills' => $results,
                'job' => $row,
                'button' => '編集',
                'title' => '仕事詳細'
            ]);
            break;
        }
    }

    public function jobEdit(Request $request)
    {
       @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        
        $skills = new Skill;
        $results = $skills->orderBy('id', 'ASC')->get();
        
        $job = new job;
        $jobs =$job->where('id', $request->id)->get();
        foreach ($jobs as $row) {
            return view('newJob')->with([
                'name' => $_SESSION['name'],
                'skills' => $results,
                'job' => $row,
                'button' => '編集',
                'title' => '仕事登録'
            ]);
            break;
        }
    }
    
    public function userSearch(Request $request)
    {
       @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        $skills = new Skill;
        $results = $skills->orderBy('id', 'ASC')->get();
        
        $search = $request->search;
        $offering = $request->offer;

        $sql = "SELECT * FROM MstUser";
        if ($search == "") {
            $sql .= " where id=0";
        } else if ($offering != "") {
            $sql .= " where offering = '1'";
        }
        $all_user = DB::select($sql);

        $per_page = 30;
        $page_num = isset($request->page) ? $request->page : 1;
        $user = array_slice($all_user, ($page_num-1) * $per_page, $per_page);

        $pager= new \Illuminate\Pagination\LengthAwarePaginator(
            $user, // ページ番号で指定された表示するレコード配列
            count($all_user), // 検索結果の全レコード総数
            $per_page, // 1ページ当りの表示数
            $page_num, // 表示するページ
            ['path' => $request->url()] // ページャーのリンク先のURLを指定
        );

        return view('comUserSearch')->with([
            'name' => $_SESSION['name'],
            'skills' => $results,
            'user' => $pager,
            'search' => $search,
            'pager' => $pager,
            'title' => 'ユーザ検索・結果一覧'
        ]);
    }

    public function userDetail(Request $request)
    {
       @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        $skills = new Skill;
        $results = $skills->orderBy('id', 'ASC')->get();
        
        $id = $request->id;
        $sql = "SELECT * FROM MstUser where id=".$id;
        $user = DB::select($sql);

        foreach($user as $row) {
            return view('comUserDetail')->with([
                'name' => $_SESSION['name'],
                'skills' => $results,
                'user' => $row,
                'title' => 'ユーザ詳細'
            ]);
            break;
        }
    }

    public function userOffer(Request $request)
    {
       @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        $id = request('id');
        $sql = "SELECT * FROM MstUser where id=".$id;
        $user = DB::select($sql);

        foreach ($user as $row) {
            mb_language("Japanese"); 
            mb_internal_encoding("UTF-8");
            
            $to = $row->email;
            $subject = "[Threek]企業からのオファーがありました";
            //メール送信
            $site = new Site;
            $results = $site->where('title','オファーメール本文')->get();
            $message = "";
            foreach ($results as $row2) {
                $message=$row2['content'];
                break;
            }
            $message = str_replace('$company',$_SESSION['name'],$message);
            $results = $site->where('title','送信元メールアドレス')->get();
            $from = "";
            foreach ($results as $row2) {
                $from=$row2['content'];
                break;
            }
            $additional_headers = "From: ".$from;
            if (mb_send_mail($to, $subject, $message, $additional_headers)) {
                // 応募件数のカウントアップ
                $regist = ComRegist::findOrFail($_SESSION['id']);
                $regist->count_offer++;
                $regist->save();
            }
            
            echo "<script>alert('オファーを受け付けました。');location.href='/comUser';</script>";
            break;
        }

        return view('comUserDetail')->with([
            'name' => $_SESSION['name'],
            'skills' => $results,
            'user' => $pager,
            'search' => $search,
            'pager' => $pager,
            'button' => 'オファーする',
            'title' => 'ユーザ詳細'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        @session_start();
        
        $id = "";
        if ($_SESSION['id']) {
            // ログイン済み
            $id = $_SESSION['id'];
        }
        
        $companyname = $_SESSION['companyname'];
        $postalcode = str_replace("-","",$_SESSION['postalcode']);
        $address = $_SESSION['address'];
        $tel = $_SESSION['tel'];
        $president = $_SESSION['president'];
        $hpurl = $_SESSION['hpurl'];
        $contact = $_SESSION['contact'];
        $contact_tel = $_SESSION['contact_tel'];
        $contact_email = $_SESSION['contact_email'];
        $send_postalcode = str_replace("-","",$_SESSION['send_postalcode']);
        $send_address = $_SESSION['send_address'];
        $password = $_SESSION['password'];
        $accept = $_SESSION['accept'];

        // トークンの作成
        $bytes = openssl_random_pseudo_bytes(16);
        $token = bin2hex($bytes);

        $regist = null;
        if ($id == "") {
            $regist = new ComRegist;
        } else {
            $regist = ComRegist::findOrFail($id);
        }
        $regist->fill([
            'name' => $companyname,
            'postalcode' => $postalcode,
            'address' => $address,
            'company_tel' => $tel,
            'president' => $president,
            'url' => $hpurl,
            'contact' => $contact,
            'contact_tel' => $contact_tel,
            'contact_email' => $contact_email,
            'send_postalcode' => $send_postalcode,
            'send_address' => $send_address,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'accept' => $accept,
            'token' => $token,
            'tokenlimit' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $regist->save();

        if ($id == "") {
            mb_language("Japanese"); 
            mb_internal_encoding("UTF-8");
            
            //メール送信
            $site = new Site;
            $to = $contact_email;
            $subject = "[Threek]仮登録確認メール";
            $message = "";
            $results = $site->where('title','仮登録メール本文')->get();
            foreach ($results as $row) {
                $message=$row['content'];
                break;
            }
            $message = str_replace('$email',$contact_email,$message);
            $message = str_replace('$tokenurl','comtoken',$message);
            $message = str_replace('$token',$token,$message);
            $results = $site->where('title','送信元メールアドレス')->get();
            $from = "";
            foreach ($results as $row) {
                $from=$row['content'];
                break;
            }
            $additional_headers = "From: ".$from;
            mb_send_mail($to, $subject, $message, $additional_headers);
    
            echo "<script>alert('仮登録のメールを送信しました。\\n\\nメール本文にあるURLをクリックし、24時間以内に本登録を行ってください。');location.href='/';</script>";
        } else {
            echo "<script>alert('会社情報を更新しました。');location.href='/comTop';</script>";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ComRegist  $comRegist
     * @return \Illuminate\Http\Response
     */
    public function show(ComRegist $comRegist)
    {
        @session_start();
        $site = new Site;
        $results = $site->where('title','利用規約・免責事項')->get();
        foreach ($results as $row) {
            $rules=$row['content'];
            break;
        }

        $companyname = request('companyname');
        $postalcode = request('postalcode');
        $address = request('address');
        $tel = request('tel');
        $president = request('president');
        $hpurl = request('hpurl');
        $contact = request('contact');
        $contact_tel = request('contact_tel');
        $contact_email = request('contact_email');
        $send_postalcode = request('send_postalcode');
        $send_address = request('send_address');
        $password = request('password');
        $accept = request('accept');
        
        $_SESSION['companyname'] = $companyname;
        $_SESSION['postalcode'] = $postalcode;
        $_SESSION['address'] = $address;
        $_SESSION['tel'] = $tel;
        $_SESSION['president'] = $president;
        $_SESSION['hpurl'] = $hpurl;
        $_SESSION['contact'] = $contact;
        $_SESSION['contact_tel'] = $contact_tel;
        $_SESSION['contact_email'] = $contact_email;
        $_SESSION['send_postalcode'] = $send_postalcode;
        $_SESSION['send_address'] = $send_address;
        $_SESSION['password'] = $password;
        $_SESSION['accept'] = $accept;

        if ($_SESSION['id']) {
            // ログイン済み
            return view('comRegist')->with([
                'rules' => $rules,
                'readonly' => 'disabled="disabled"',
                'companyname' => $companyname,
                'postalcode' => $postalcode,
                'address' => $address,
                'tel' => $tel,
                'president' => $president,
                'hpurl' => $hpurl,
                'contact' => $contact,
                'contact_tel' => $contact_tel,
                'contact_email' => $contact_email,
                'send_postalcode' => $send_postalcode,
                'send_address' => $send_address,
                'password' => $password,
                'accept' => $accept,
                'button' => '保存',
                'url' => 'comRegistTemp',
                'onsubmit' => '',
                'confirm' => 'display:none',
                'disabled' => '',
                'title' => '法人登録'
            ]);
        } else {
            return view('comRegist')->with([
                'rules' => $rules,
                'readonly' => 'disabled="disabled"',
                'companyname' => $companyname,
                'postalcode' => $postalcode,
                'address' => $address,
                'tel' => $tel,
                'president' => $president,
                'hpurl' => $hpurl,
                'contact' => $contact,
                'contact_tel' => $contact_tel,
                'contact_email' => $contact_email,
                'send_postalcode' => $send_postalcode,
                'send_address' => $send_address,
                'password' => $password,
                'accept' => $accept,
                'button' => '仮登録',
                'url' => 'comRegistTemp',
                'onsubmit' => '',
                'confirm' => 'display:none',
                'disabled' => '',
                'title' => '法人登録'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ComRegist  $comRegist
     * @return \Illuminate\Http\Response
     */
    public function edit(ComRegist $comRegist)
    {
        @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }

        $id = $_SESSION['id'];
        $site = new Site;
        $results = $site->where('title','利用規約・免責事項')->get();
        foreach ($results as $row) {
            $rules=$row['content'];
            break;
        }

        $id = $_SESSION['id'];
        $regist = ComRegist::findOrFail($id);

        $companyname = $regist->name;
        $postalcode = $regist->postalcode;
        $address = $regist->address;
        $tel = $regist->company_tel;
        $president = $regist->president;
        $hpurl = $regist->url;
        $contact = $regist->contact;
        $contact_tel = $regist->contact_tel;
        $contact_email = $regist->contact_email;
        $send_postalcode = $regist->send_postalcode;
        $send_address = $regist->send_address;
        $password = ''; //$regist->password;
        $accept = $regist->accept;

        return view('comEdit')->with([
            'name' => $regist->name,
            'rules' => $rules,
            'readonly' => '',
            'companyname' => $companyname,
            'postalcode' => $postalcode,
            'address' => $address,
            'tel' => $tel,
            'president' => $president,
            'hpurl' => $hpurl,
            'contact' => $contact,
            'contact_tel' => $contact_tel,
            'contact_email' => $contact_email,
            'send_postalcode' => $send_postalcode,
            'send_address' => $send_address,
            'password' => '',
            'accept' => $accept,
            'button' => '確認',
            'url' => 'comRegist',
            'disabled' => '',
            'confirm' => 'display:none;',
            'title' => '法人情報編集'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ComRegist  $comRegist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComRegist $comRegist)
    {
        $id=0;
        $token = $_GET['key'];
        $regist = new ComRegist;
        $results = $regist->where('token',$token)->get();
        if (count($results)==0) {
            // 登録なし
            echo "<script>alert('有効なURLではありません');location.href='/';</script>";
            exit;
        }
        foreach ($results as $row) {
            $email_verified=$row['email_verified'];
            $tokenlimit=$row['tokenlimit'];
            $id=$row['id'];
            break;
        }
        if ($email_verified) {
            // 登録済み
            echo "<script>alert('既に登録が完了しています');location.href='/';</script>";
            exit;
        }
        $datetime = explode(' ', $tokenlimit);
        
        $date = mktime(substr($datetime[1],0,2), substr($datetime[1],3,2), substr($datetime[1],6,2), substr($datetime[0],5,2), substr($datetime[0],8,2), substr($datetime[0],0,4)) + 24 * 60 * 60;
        $now = time();
        if ($date >= $now) {
            // 正常登録
            $regist = ComRegist::findOrFail($id);
            $regist->email_verified = now();
            $regist->save();

            @session_start();
            $_SESSION['email'] = $regist->contact_email;
            $_SESSION['id'] = $id;
            $_SESSION['name'] = $regist->name;
            $_SESSION['user'] = 'com'; // 法人

            $msg="";
            $site = new Site;
            $results = $site->where('title','本登録完了')->get();
            foreach ($results as $row) {
                $msg=$row['content'];
                break;
            }
            echo "<script>alert('".$msg."');location.href='/comTop';</script>";
        } else {
            // 仮登録24時間オーバー
            echo "<script>alert('URLの有効期限切れです。再度登録し直してください。');location.href='/comRegist';</script>";
            exit;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ComRegist  $comRegist
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComRegist $comRegist)
    {
        //
    }
    
    public function password()
    {
        $id=0;
        $token = $_GET['key'];
        $regist = new ComRegist;
        $results = $regist->where('token',$token)->get();
        foreach ($results as $row) {
            $id=$row['id'];
            break;
        }
        return view('passReset')->with([
            'key' => $token,
            'id' => $id,
            'url' => '/comPass',
            'title' => 'パスワード再設定'
        ]);
    }

    public function passReset()
    {
        $id=0;
        $token = $_POST['key'];
        $id = $_POST['id'];
        $regist = ComRegist::findOrFail($id);
        $regist->password = password_hash(request('pass1'), PASSWORD_DEFAULT);
        $regist->save();
        return view('passComp')->with([
            'title' => 'パスワード再設定'
        ]);
    }

}
