<?php

namespace App\Http\Controllers;

use App\UserRegist;
use App\Site;
use App\News;
use App\Category;
use App\product;
use App\Skill;
use App\job;
use App\ComRegist;
use Illuminate\Http\Request;
use App\Http\Requests\userRegistRequest;
use Log;
use DB;

class UserRegistController extends Controller
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

        $_SESSION['id'] = "";
        return view('userRegist')->with([
            'rules' => $rules,
            'readonly' => '',
            'nickname' => '',
            'email' => '',
            'year' => '',
            'month' => '',
            'day' => '',
            'postalcode' => '',
            'address' => '',
            'job_kind' => [''],
            'job_hist' => '',
            'offering' => '',
            'password' => '',
            'accept' => '',
            'button' => '確認',
            'url' => 'userRegist',
            'confirm' => '',
            'disabled' => 'disabled',
            'title' => '会員登録'
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
            exit;
        }
        if ($_SESSION['user']!='user') {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
            exit;
        }        
        $nickname = $_SESSION['nickname'];
        $news = new News;
        $results = $news->where('type','1')->orderBy('entried_at', 'DESC')->take(10)->get();

        return view('userTop')->with([
        'nickname' => $nickname,
        'news' => $results,
        'title' => '会員トップ'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        
        $nickname = $_SESSION['nickname'];
        $category = new Category;
        $results = $category->orderBy('id', 'ASC')->get();
        $product=[];
        $all_prod=[];

        $per_page = 30;
        $page_num = isset($request->page) ? $request->page : 1;
        $pager= new \Illuminate\Pagination\LengthAwarePaginator(
            $product, // ページ番号で指定された表示するレコード配列
            count($all_prod), // 検索結果の全レコード総数
            $per_page, // 1ページ当りの表示数
            $page_num, // 表示するページ
            ['path' => $request->url()] // ページャーのリンク先のURLを指定
        );

        return view('userProdSearch')->with([
        'nickname' => $nickname,
        'category' => $results,
        'product' => $product,
        'search' => '',
        'pager' => $pager,
        'title' => '商品検索・結果一覧'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchResult(Request $request)
    {
        @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        $search = request('search');
        $cat = request('category');
        $nickname = $_SESSION['nickname'];
        $category = new Category;
        $results = $category->orderBy('id', 'ASC')->get();
        $sql = "SELECT MstProduct.id,MstProduct.name,MstCategory.category,MstCom.name as company FROM MstProduct left join MstCategory on MstProduct.category = MstCategory.id left join MstCom on MstProduct.company = MstCom.id WHERE detail like '%".$search."%' and MstProduct.display=0 ";
        if ($cat != "") {
            $sql .= "and MstProduct.category = '".$cat."'";
        }
        $all_prod = DB::select($sql);

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

        return view('userProdSearch')->with([
        'nickname' => $nickname,
        'category' => $results,
        'product' => $pager,
        'search' => $search,
        'pager' => $pager,
        'title' => '商品検索・結果一覧'
        ]);
    }

    public function userJob(Request $request)
    {
        @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        $search = request('search');
        $skills = new Skill;
        $results = $skills->orderBy('id', 'ASC')->get();
        $sql = "SELECT * FROM jobs where display='0'";
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $sql .= " and id=0";
        } else {
            $sql .= " and detail like '%".$search."%'";
        }
        $all_jobs = DB::select($sql);

        $per_page = 30;
        $page_num = isset($request->page) ? $request->page : 1;
        $jobs = array_slice($all_jobs, ($page_num-1) * $per_page, $per_page);

        $pager= new \Illuminate\Pagination\LengthAwarePaginator(
            $jobs, // ページ番号で指定された表示するレコード配列
            count($all_jobs), // 検索結果の全レコード総数
            $per_page, // 1ページ当りの表示数
            $page_num, // 表示するページ
            ['path' => $request->url()] // ページャーのリンク先のURLを指定
        );

        return view('userJob')->with([
        'nickname' => $_SESSION['nickname'],
        'skills' => $results,
        'job' => $pager,
        'search' => $search,
        'pager' => $pager,
        'readonly' => '',
        'title' => '仕事検索・結果一覧'
        ]);
    }

    public function userJobDetail(Request $request)
    {
        @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        
        $skills = new Skill;
        $results = $skills->orderBy('id', 'ASC')->get();
        
        $jobs = DB::select("SELECT jobs.*,MstCom.name as company_name,MstCom.address as company_addr,MstCom.url as company_url FROM jobs left join MstCom on jobs.company=MstCom.id where jobs.id=".$request->id);
        foreach ($jobs as $row) {
            return view('userJobDetail')->with([
                'id' => $_SESSION['id'],
                'nickname' => $_SESSION['nickname'],
                'skills' => $results,
                'job' => $row,
                'button' => '応募する',
                'title' => '仕事詳細'
            ]);
            break;
        }
    }

    public function entryJob(Request $request)
    {
       @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        
        $id = request('id');
        $jobs = DB::select("SELECT jobs.*,MstCom.name as company_name,MstCom.address as company_addr,MstCom.url as company_url,MstCom.contact_email FROM jobs left join MstCom on jobs.company=MstCom.id where jobs.id=".$id);
        foreach ($jobs as $row) {
            mb_language("Japanese"); 
            mb_internal_encoding("UTF-8");
            
            $to = $row->contact_email;
            $subject = "[Threek]ユーザからの応募がありました";
            //メール送信
            $site = new Site;
            $results = $site->where('title','応募メール本文')->get();
            $message = "";
            foreach ($results as $row2) {
                $message=$row2['content'];
                break;
            }
            $message = str_replace('$title',$row->title,$message);
            $message = str_replace('$nickname',$_SESSION['nickname'],$message);
            $results = $site->where('title','送信元メールアドレス')->get();
            $from = "";
            foreach ($results as $row2) {
                $from=$row2['content'];
                break;
            }
            $additional_headers = "From: ".$from;
            if (mb_send_mail($to, $subject, $message, $additional_headers)) {
                // 応募件数のカウントアップ
                $regist = ComRegist::findOrFail($row->company);
                $regist->count_apply++;
                $regist->save();
            }
            
            echo "<script>alert('応募を受け付けました。');location.href='/userJobTop';</script>";
            break;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function prodDetail()
    {
        @session_start();
        if (!isset($_SESSION['id'])) {
            echo "<script>alert('ログインしてください');location.href='/login';</script>";
        }
        
        $id = request('id');
        $comid = request('comid');
        $nickname = $_SESSION['nickname'];
        $category = new Category;
        $results = $category->orderBy('id', 'ASC')->get();
        $product = DB::select("SELECT MstProduct.*,MstCategory.category,MstCom.name as company_name,MstCom.address as company_addr, MstCom.url as company_url FROM MstProduct left join MstCategory on MstProduct.category = MstCategory.id left join MstCom on MstProduct.company = MstCom.id WHERE MstProduct.id = ".$id);
        foreach($product as $row) {
            return view('prodDetail')->with([
            'nickname' => $nickname,
            'category' => $results,
            'product' => $row,
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
    public function create()
    {
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
        $nickname = $_SESSION['nickname'];
        $email = $_SESSION['email'];
        $year = $_SESSION['year'];
        $month = $_SESSION['month'];
        $day = $_SESSION['day'];
        $postalcode = str_replace("-","",$_SESSION['postalcode']);
        $address = $_SESSION['address'];
        $jobArray = $_SESSION['jobkind'];
        $job_hist = $_SESSION['jobhist'];
        $offering = $_SESSION['offer'];
        $password = $_SESSION['password'];
        $accept = $_SESSION['accept'];
        $job_kind = "";

        // トークンの作成
        $bytes = openssl_random_pseudo_bytes(16);
        $token = bin2hex($bytes);

        if (is_array($jobArray)) {
            $job_kind = implode(",", $jobArray);
        }

        $regist = null;
        if ($id == "") {
            $regist = new UserRegist;
        } else {
            $regist = UserRegist::findOrFail($id);
        }
        $regist->fill([
            'nick_name' => $nickname,
            'email' => $email,
            'birthday' => $year."-".$month."-".$day,
            'postalcode' => $postalcode,
            'address' => $address,
            'job_kind' => $job_kind,
            'job_hist' => $job_hist,
            'offering' => $offering,
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
            $to = $email;
            $subject = "[Threek]仮登録確認メール";
            $message = "";
            $results = $site->where('title','仮登録メール本文')->get();
            foreach ($results as $row) {
                $message=$row['content'];
                break;
            }
            $message = str_replace('$email',$email,$message);
            $message = str_replace('$tokenurl','usertoken',$message);
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
            echo "<script>alert('ユーザ情報を更新しました。');location.href='/userTop';</script>";
        }
        //Log::debug('Send a mail: '.$to." ".$subject." ".$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserRegist  $userRegist
     * @return \Illuminate\Http\Response
     */
    public function show(userRegistRequest $request)
    {
        @session_start();
        $site = new Site;
        $results = $site->where('title','利用規約・免責事項')->get();
        foreach ($results as $row) {
            $rules=$row['content'];
            break;
        }

        $nickname = request('nickname');
        $email = request('email');
        $year = request('year');
        $month =  request('month');
        $day = request('day');
        $postalcode = request('postalcode');
        $address = request('address');
        $job_kind = "";
        $jobArray = request('jobkind');
        $job_hist = request('jobhist');
        $offering = request('offer');
        $password = request('password');
        $accept = request('accept');
        $readonly = "readonly";
        
        $_SESSION['nickname'] = $nickname;
        $_SESSION['email'] = $email;
        $_SESSION['year'] = $year;
        $_SESSION['month'] = $month;
        $_SESSION['day'] = $day;
        $_SESSION['postalcode'] = $postalcode;
        $_SESSION['address'] = $address;
        $_SESSION['jobkind'] = $jobArray;
        $_SESSION['jobhist'] = $job_hist;
        $_SESSION['offer'] = $offering;
        $_SESSION['password'] = $password;
        $_SESSION['accept'] = $accept;

        if ($_SESSION['id']) {
            // ログイン済み
            return view('userRegist')->with([
                'rules' => $rules,
                'readonly' => 'disabled="disabled"',
                'nickname' => $nickname,
                'email' => $email,
                'year' => $year,
                'month' => $month,
                'day' => $day,
                'postalcode' => $postalcode,
                'address' => $address,
                'job_kind' => $jobArray,
                'job_hist' => $job_hist,
                'offering' => $offering,
                'password' => $password,
                'accept' => $accept,
                'button' => '保存',
                'url' => 'userRegistTemp',
                'confirm' => 'display:none',
                'disabled' => '',
                'title' => '会員仮登録'
            ]);
        } else {
            return view('userRegist')->with([
                'rules' => $rules,
                'readonly' => 'disabled="disabled"',
                'nickname' => $nickname,
                'email' => $email,
                'year' => $year,
                'month' => $month,
                'day' => $day,
                'postalcode' => $postalcode,
                'address' => $address,
                'job_kind' => $jobArray,
                'job_hist' => $job_hist,
                'offering' => $offering,
                'password' => $password,
                'accept' => $accept,
                'button' => '仮登録',
                'url' => 'userRegistTemp',
                'confirm' => 'display:none',
                'disabled' => '',
                'title' => '会員仮登録'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserRegist  $userRegist
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRegist $userRegist)
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

        $regist = UserRegist::findOrFail($id);

        $nickname = $regist->nick_name;
        $email = $regist->email;
        $year = substr($regist->birthday, 0,4);
        $month = substr($regist->birthday, 5,2);
        $day = substr($regist->birthday, 8,2);
        $postalcode = $regist->postalcode;
        $address = $regist->address;
        $job_kind = explode(",", $regist->job_kind);
        $job_hist = $regist->job_hist;
        $offering = $regist->offering;
        $password = ''; //$regist->password;
        $accept = $regist->accept;

        return view('userEdit')->with([
            'nickname' => $nickname,
            'rules' => $rules,
            'readonly' => '',
            'email' => $email,
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'postalcode' => $postalcode,
            'address' => $address,
            'job_kind' => $job_kind,
            'job_hist' => $job_hist,
            'offering' => $offering,
            'password' => '',
            'accept' => $accept,
            'button' => '確認',
            'url' => 'userRegist',
            'disabled' => '',
            'confirm' => 'display:none;',
            'title' => '会員情報編集'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserRegist  $userRegist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserRegist $userRegist)
    {
        $id=0;
        $token = $_GET['key'];
        $regist = new UserRegist;
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
            echo "<script>alert('既に登録が完了しています');location.href='login';</script>";
            exit;
        }
        $datetime = explode(' ', $tokenlimit);
        
        $date = mktime(substr($datetime[1],0,2), substr($datetime[1],3,2), substr($datetime[1],6,2), substr($datetime[0],5,2), substr($datetime[0],8,2), substr($datetime[0],0,4)) + 24 * 60 * 60;
        $now = time();
        if ($date >= $now) {
            // 正常登録
            $regist = UserRegist::findOrFail($id);
            $regist->email_verified = now();
            
            @session_start();
            $_SESSION['email'] = $regist->email;
            $_SESSION['id'] = $id;
            $_SESSION['nickname'] = $regist->nick_name;
            $_SESSION['user'] = 'user'; // 個人事業主
            $regist->save();

            $msg="";
            $site = new Site;
            $results = $site->where('title','本登録完了')->get();
            foreach ($results as $row) {
                $msg=$row['content'];
                break;
            }
            echo "<script>alert('".$msg."');location.href='/userTop';</script>";
        } else {
            // 仮登録24時間オーバー
            echo "<script>alert('URLの有効期限切れです。再度登録し直してください。');location.href='/userRegist';</script>";
            exit;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserRegist  $userRegist
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserRegist $userRegist)
    {
        //
    }
    
    public function password()
    {
        $id=0;
        $token = $_GET['key'];
        $regist = new UserRegist;
        $results = $regist->where('token',$token)->get();
        foreach ($results as $row) {
            $id=$row['id'];
            break;
        }
        return view('passReset')->with([
            'key' => $token,
            'id' => $id,
            'url' => '/userPass',
            'title' => 'パスワード再設定'
        ]);
    }

    public function passReset()
    {
        $id=0;
        $token = $_POST['key'];
        $id = $_POST['id'];
        $regist = UserRegist::findOrFail($id);
        $regist->password = password_hash(request('pass1'), PASSWORD_DEFAULT);
        $regist->save();
        return view('passComp')->with([
            'title' => 'パスワード再設定完了'
        ]);
    }
}
