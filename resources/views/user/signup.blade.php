<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}" />

    <title>kadai-app | 新規登録</title>
</head>
<!-- ログイン画面 -->

<body class="">
    <x-header></x-header>
    <div class="page singup-page">
        <form class="form" action="/signup" method="post">
            @csrf
            <div class="form-item name">
                <label for="name">ユーザー名</label>
                <input type="text" id="name" name="name" />
            </div>
            <div class="form-item email">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" />
            </div>
            <div class="form-item password">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" />
            </div>
            @if ($errorMessage)
            <div class="error-message font-red">{{ $errorMessage }}</div>
            @endif
            <div class="regist-button">
                <button class="button-white" onclick="valid()" type="submit">登録する</button>
            </div>
            @foreach($errors->all() as $error)
                <p style="color:red;">{{$error}}</p>
            @endforeach
        </div>
        </form>
    </div>
</body>
<script>
    const valid = () => {
        let email = document.getElementById("email").value;
        let pass = document.getElementById("password").value;
        if (!email.match(/^[a-zA-Z0-9_.+-]+@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/)
        || !pass.match(/[a-zA-Z0-9_.+-]+/) 
        || pass.length < 8 ){
            alert("正しいメールアドレス、パスワード（半額英数字記号、８文字以上）を入力してください")
        }
    }
</script>
<script src="{{ asset('/js/app.js') }}"></script>
<style scoped>
    .singup-page {
        display: flex;
        justify-content: center;
    }
    
    .singup-page .title {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
    }
    
    .singup-page .form {
        width: 60vw;
    }
    
    .singup-page input {
        height: 30px;
        border-radius: 10px;
        background-color: lightgray;
    }
    
    .singup-page .form-item {
        display: flex;
        flex-direction: column;
        margin-top: 10px;
    }
    
    .singup-page .regist-button {
        text-align: center;
        margin-top: 10px;
    }
    
    .singup-page button {
        width: 50%;
        height: 30px;
        font-size: 18px;
    }
    
    .singup-page .error-message {
        margin-top: 5px;
        font-size: 10px;
    }
</style>

</html>