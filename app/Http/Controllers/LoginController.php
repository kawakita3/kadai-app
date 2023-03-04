<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller,
    Session;

class LoginController extends Controller
{
    /**
     * ログイン画面遷移
     */
    public function index()
    {
        $errorMessage = null;
        return view('login', compact('errorMessage'));
    }

    /**
     * ログイン処理
     */
    public function login(Request $request)
    {
        // 入力されたユーザーが存在するか確認
        $user = User::where('email', $request->email)->first();
        $errorMessage = 'ユーザーが存在しないかパスワードが間違っています';
        if ($user == null) {
            return view('login', compact('errorMessage'));
        }

        // パスワードがあっているか確認
        if ($user->password != $request->password) {
            return view('login', compact('errorMessage'));
        }

        // 成功
        Session::put('user', $user);
        return redirect('/');
    }

    /**
     * ログアウト処理
     */
    public function logout()
    {
        Session::forget('user');
        return redirect('/login');
    }
}
