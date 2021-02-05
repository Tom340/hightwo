<?php

namespace App\Http\Controllers;

use App\Site;
use App\AdminRegist;
use App\UserRegist;
use App\ComRegist;
use Illuminate\Http\Request;
use Log;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Adminlogin')->with([
            'url' => 'admin',
            'title' => '管理画面'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        @session_start();
        
        if (!isset($_SESSION['id'])) {
            echo "<script>location.href='/admin';</script>";
            exit;
        }
        if ($_SESSION['user'] != "admin") {
            echo "<script>location.href='/admin';</script>";
            exit;
        }
        $site = new Site;
        $results = $site->get();

        return view('AdminEdit')->with([
            'results' => $results,
            'title' => '管理画面'
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
        $item = request('title');

        $site = new Site;
        $results = $site->where('title',$item)->get();
        foreach ($results as $row) {
            echo json_encode( array("content"=>$row->content));
//            Log::debug('AdminRegist title: '.$item." content:".$row->content);
            break;
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
       @session_start();
        
        $email = request('email');
        $password = request('password');

        $pass=null;
        
        $user = new AdminRegist;
        $results = $user->where('email',$email)->get();
        $found=0;
        foreach ($results as $row) {
            $pass=$row['password'];
            $found=1;
            break;
        }
        if ($found) {
            // 本登録済み
            if (password_verify($password, $pass)) {
                // パスワード一致
                $_SESSION['id'] = $email;
                $_SESSION['user'] = 'admin'; // 管理者
                Log::debug('AdminRegist email: '.$email." login successfull.");
                echo "<script>location.href='/admintop';</script>";
            } else {
                echo "<script>alert('メールアドレスまたはパスワードが間違っています');</script>";
                Log::debug('AdminRegist email: '.$email." password: ".$password);
                echo "<script>location.href='/admin';</script>";
            }
        }   
        if (!$found) {
            echo "<script>alert('メールアドレスまたはパスワードが間違っています');</script>";
            Log::debug('Common email: '.$email." password: ".$password);
                echo "<script>location.href='/admin';</script>";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Site $site)
    {
        $item = request('itemselect');
        $content = request('content');
        
        if ($item == "新規作成") {
            $item = request('new');
            $site = new Site;
            $site->title = $item;
            $site->content = $content;
            $site->save();
        } else {
            $site = new Site;
            $results = $site->where('title',$item)->get();
            foreach ($results as $row) {
                $row->content = $content;
                $row->save();
            }
        }
        echo "<script>location.href='/admintop';</script>";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contact()
    {
        return view('contact')->with([
            'readonly' => '',
            'name' => '',
            'companyname' => '',
            'email' => '',
            'subject' => '',
            'detail' => '',
            'title' => 'お問い合わせ'
        ]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactmail()
    {
        $name = request('name');
        $companyname = request('companyname');
        $email = request('email');
        $subject = request('subject');
        $contact_kind = request('contact_kind');
        $detail = request('detail');

        mb_language("Japanese"); 
        mb_internal_encoding("UTF-8");
        
        //メール送信
        $site = new Site;
        $subject = "{".$contact_kind."}のお問い合わせがありました。";
        $message = "";
        $results = $site->where('title','問い合わせメール本文')->get();
        foreach ($results as $row) {
            $message=$row['content'];
            break;
        }
        $message = str_replace('$name',$name,$message);
        $message = str_replace('$companyname',$companyname,$message);
        $message = str_replace('$email',$email,$message);
        $message = str_replace('$subject',$subject,$message);
        $message = str_replace('$detail',$detail,$message);
        $results = $site->where('title','お問い合わせ送信先')->get();
        $to = "";
        foreach ($results as $row) {
            $to=$row['content'];
            break;
        }
        $results = $site->where('title','送信元メールアドレス')->get();
        $from = "";
        foreach ($results as $row) {
            $from=$row['content'];
            break;
        }
        $additional_headers = "From: ".$from;
        mb_send_mail($to, $subject, $message, $additional_headers);
        //Log::debug('Contact '.$subject." ".$message);
        
        echo "<script>alert('お問い合わせを送信しました。担当者から連絡があるまでお待ちください。');location.href='/';</script>";
    }

    public function privacypolicy()
    {
        $site = new Site;
        $message = "";
        $results = $site->where('title','プライバシーポリシー')->get();
        foreach ($results as $row) {
            $message=$row['content'];
            break;
        }
        return view('privacypolicy')->with([
            'title' => 'プライバシーポリシー',
            'text' => $message
        ]);
    }
    
    public function rules()
    {
        $site = new Site;
        $message = "";
        $results = $site->where('title','利用規約・免責事項')->get();
        foreach ($results as $row) {
            $message=$row['content'];
            break;
        }
        return view('privacypolicy')->with([
            'title' => '利用規約・免責事項',
            'text' => $message
        ]);
    }

    public function password()
    {
        $site = new Site;
        $message = "";
        $results = $site->where('title','パスワード再設定')->get();
        foreach ($results as $row) {
            $message=$row['content'];
            break;
        }
        return view('password')->with([
            'title' => 'パスワード再設定'
        ]);
    }
    
    public function passwordmail()
    {
        $email = request('email');

        $user = new UserRegist;
        $results = $user->where('email',$email)->get();
        $userRegist=0;
        foreach ($results as $row) {
            $id=$row['id'];
            $token=$row['token'];
            $userRegist=1;
            $passurl='userPass';
            break;
        }
        if (!$user) {
            $com = new ComRegist;
            $results = $com->where('contact_email',$email)->get();
            $comRegist = 0;
            foreach ($results as $row) {
                $id=$row['id'];
                $token=$row['token'];
                $comRegist=1;
                $passurl='comPass';
                break;
            }
        }
        if (!$userRegist && !$comRegist) {
            echo "<script>alert('入力されたメールアドレスは登録されていません。');location.href='/';</script>";
            exit;
        }
        mb_language("Japanese"); 
        mb_internal_encoding("UTF-8");
        
        //メール送信
        $site = new Site;
        $subject = "[Threek]パスワード再設定メール";
        $message = "";
        $results = $site->where('title','パスワード再設定メール本文')->get();
        foreach ($results as $row) {
            $message=$row['content'];
            break;
        }
        $message = str_replace('$email',$email,$message);
        $message = str_replace('$passurl',$passurl,$message);
        $message = str_replace('$token',$token,$message);
        $results = $site->where('title','送信元メールアドレス')->get();
        $from = "";
        foreach ($results as $row) {
            $from=$row['content'];
            break;
        }
        $additional_headers = "From: ".$from;
        mb_send_mail($email, $subject, $message, $additional_headers);
        //Log::debug('Contact '.$subject." ".$message);
        
        return view('passwordsend')->with([
            'title' => 'メール送信完了'
        ]);
    }

    public function logout()
    {
        $_SESSION["id"] = null;
        $_SESSION['user'] = null;
        echo "<script>alert('ログアウトしました');location.href='/';</script>";
        exit;
    }
}
