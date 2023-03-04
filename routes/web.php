<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*-------------------------------------------------------------------------
| ホーム
| -------------------------------------------------------------------------
*/
/** ホーム画面遷移 */
Route::get('/', [HomeController::class, 'index']);

/*-------------------------------------------------------------------------
| ログイン
| -------------------------------------------------------------------------
*/
/** ログイン画面遷移 */
Route::get('/login', [LoginController::class, 'index']);


/** ログイン処理 */
Route::post('/login',  [LoginController::class, 'login']);
/** ログアウト処理 */
Route::post('/logout',  [LoginController::class, 'logout']);

/*-------------------------------------------------------------------------
| 投稿
| -------------------------------------------------------------------------
*/
/** 投稿画面遷移 */
Route::get('/post', [PostController::class, 'create']);
/** 投稿処理 */
Route::post('/post', [PostController::class, 'store']);

/** 投稿詳細画面遷移 */
Route::get('/post/detail/{id}', [PostController::class, 'show']);

/** 投稿編集画面遷移 */
Route::get('/post/edit/{id}', [PostController::class, 'edit']);
/** 投稿編集処理 */
Route::put('/post/edit/{id}', [PostController::class, 'update']);

/** 投稿削除処理 */
Route::post('/post/delete/{id}', [PostController::class, 'delete']);


/*-------------------------------------------------------------------------
| ユーザー
| -------------------------------------------------------------------------
*/
/** ユーザー画面遷移 */
Route::get('/user/{id}', [UserController::class, 'show']);

/** プロフィール編集画面遷移 */
Route::get('/user/edit/{id}', [UserController::class, 'edit']);
/** プロフィール編集処理 */
Route::put('/user/edit/{id}', [UserController::class, 'update']);

/** フォローリスト画面遷移 */
Route::get('user/{id}/follow', [FollowController::class, 'index']);
/** フォロワーリスト画面遷移 */
Route::get('user/{id}/follower', [FollowController::class, 'index']);

/** フォロワー/フォロー解除処理 */
Route::put('follow/{id}',[FollowController::class, 'update']);

/*-------------------------------------------------------------------------
| 新規登録
| -------------------------------------------------------------------------
*/

/** 新規登録画面遷移 */
Route::get('/signup', [UserController::class, 'create']);

/** 新規登録処理 */
Route::post('/signup', [UserController::class, 'store']);
