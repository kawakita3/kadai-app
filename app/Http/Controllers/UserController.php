<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller,
    Session;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * ユーザー画面遷移
     */
    public function show($id)
    {
        // セッションにログイン情報があるか確認
        if (!Session::exists('user')) {
            // ログインしていなければログインページへ
            return redirect('/login');
        }

        // 指定したIDのユーザー情報を取得する
        $user = User::find($id);

        // ユーザーが存在するか判定
        if ($user == null) {
            return dd('存在しないユーザーです');
        }

        // ユーザーの投稿を取得
        $posts = $user->posts();
        // フォロー/フォロワー数の取得
        $followCount = count($user->followUsers());
        $followerCount = count($user->followerUsers());

        // ログイン中のユーザーの情報を取得する
        $loginUser = Session::get('user');
        // 自分自身のユーザーページか判定
        $isOwnPage = $loginUser->id == $user->id;

        // フォロー済みかどうか判定
        $isFollowed = false;
        if (!$isOwnPage) {
            $isFollowed = $loginUser->isFollowed($user->id);
        }

        // 画面表示
        return view('user.index', compact('user', 'posts', 'followCount', 'followerCount', 'isOwnPage', 'isFollowed'));
    }

    /**
     * プロフィール編集画面遷移
     */
    public function edit($id)
    {
        $user = User::find($id);
        // ユーザーが存在するか判定
        if ($user == null) {
            return dd('存在しないユーザーです');
        }
        // セッションにログイン情報があるか確認
        if (!Session::exists('user')) {
            return redirect('/');
        }

        // ログイン中のユーザーの情報を取得する
        $loginUser = Session::get('user');
        // 自分自身のユーザーページか判定
        if ($loginUser->id != $user->id) {
            return redirect('/');
        }

        // 画面表示
        return view('user.edit', compact('user'));
    }

    /**
     * プロフィール編集処理
     */
    public function update(Request $request, $id)
    {
        // idからユーザーを取得
        $user = User::find($id);

        // 投稿が存在するか判定
        if ($user == null) {
            return dd('存在しないユーザーです');
        }
        // セッションにログイン情報があるか確認
        if (!Session::exists('user')) {
            return redirect('/');
        }

        // ログイン中のユーザーの情報を取得する
        $loginUser = Session::get('user');
        // 自分自身の投稿ページか判定
        if ($loginUser->id != $user->id) {
            return redirect('/');
        }

        // データ登録
        $user->name = $request->username;
        $user->biography = $request->biography;
        $user->save();

        // 画面表示
        return redirect('/user/' . $user->id);
    }


    /**
     * 新規登録画面遷移
     */
    public function create()
    {
        $errorMessage = null;
        return view('user.signup',compact('errorMessage'));
    }

    /**
     * 新規登録処理
     */
    public function store(Request $request)
    {
        //TODO 登録処理

        // バリデーション
        $rules = [
            'email' => [ 'required', 
            'regex:/^[a-zA-Z0-9_.+-]+@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/' ],
            'password' => 'regex:/[a-zA-Z0-9_.+-]+/'
            // 'email' => [ 'required | email:filter' ],
          ];
        $message = [
            'email.required' => 'メールアドレスを入力してください',
            'email.regex' => 'メールアドレスを正しく入力してください',
            'password.regex' => 'パスワード（半額英数字記号、８文字以上）を正しく入力してください'
          ];
        
        $validator = Validator::make($request->all(), $rules, $message);
        
        if ($validator->fails()) {
            // return view('user.signup')
            // return view('user.signup',compact('errorMessage'))
            return redirect('/signup')
            ->withErrors($validator)
            ->withInput();
        }

        // $user = new User;
        $user = User::where('email', $request->email)->first();

        // 入力されたメアドが存在するか確認
        if ($user != null) {
            $errorMessage = 'このメールアドレスはすでに使用されています';
            return view('user.signup',compact('errorMessage'));
        }

        // データ登録
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        // 成功
        Session::put('user', $user);

        $errorMessage = null;
        return redirect('/');
    }
}
