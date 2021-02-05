<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserRegist;
use App\ComRegist;
use Log;

class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login')->with([
            'url' => 'login',
            'title' => 'ログイン'
        ]);
    }

    /**
     * show a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        @session_start();
        
        $email = request('email');
        $password = request('password');

        $email_verified=null;
        $pass=null;
        
        $user = new UserRegist;
        $results = $user->where('email',$email)->get();
        $found=0;
        foreach ($results as $row) {
            $email_verified=$row['email_verified'];
            $pass=$row['password'];
            $id=$row['id'];
            $nickname=$row['nick_name'];
            $found=1;
            break;
        }
        if ($found) {
            if ($email_verified) {
                // 本登録済み
                if (password_verify($password, $pass)) {
                    // パスワード一致
                    session_regenerate_id(true);
                    $_SESSION['email'] = $email;
                    $_SESSION['id'] = $id;
                    $_SESSION['nickname'] = $nickname;
                    $_SESSION['user'] = 'user'; // 個人事業主
                    Log::debug('UserRegist email: '.$email." login successfull.");
                    echo "<script>location.href='/userTop';</script>";
                    exit;
                } else {
                    Log::debug('UserRegist email: '.$email." password: ".$password);
                    echo "<script>alert('メールアドレスまたはパスワードが間違っています');location.href='/login';</script>";
                    exit;
                }
            } else {
                echo "<script>alert('本登録が完了していません');location.href='/'</script>";
                exit;
            }
        } else {
            $com = new ComRegist;
            $results = $com->where('contact_email',$email)->get();
            foreach ($results as $row) {
                $email_verified=$row['email_verified'];
                $pass=$row['password'];
                $id=$row['id'];
                $name=$row['name'];
                $found=1;
                break;
            }
            if ($found) {
                if ($email_verified) {
                    // 本登録済み
                    if (password_verify($password, $pass)) {
                        // パスワード一致
                        session_regenerate_id(true);
                        $_SESSION['email'] = $email;
                        $_SESSION['id'] = $id;
                        $_SESSION['name'] = $name;
                        $_SESSION['user'] = 'com'; // 法人
                        Log::debug('ComRegist email: '.$email." login successfull.");
                        echo "<script>location.href='/comTop';</script>";
                        exit;
                    } else {
                        Log::debug('ComRegist email: '.$email." password: ".$password);
                        echo "<script>alert('メールアドレスまたはパスワードが間違っています');location.href='/login';</script>";
                        exit;
                    }
                } else {
                    echo "<script>alert('本登録が完了していません');location.href='/';</script>";
                    exit;
                }
            }
        }   
        if (!$found) {
            Log::debug('Common email: '.$email." password: ".$password);
            echo "<script>alert('メールアドレスまたはパスワードが間違っています');location.href='/login';</script>";
            exit;
        }
    }
    //
}
