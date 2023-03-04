<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}" />

    <title>kadai-app | 投稿</title>
</head>
<!-- 投稿画面 -->

<body class="">
    <x-header></x-header>
    <div class="page post-page">
        <form class="form" action="/post" method="post">
            @csrf
            <textarea name="postContent" id="content" cols="30" rows="5" placeholder="いまどうしてる?"></textarea>
            <div class="post-button">
                <button class="button-white" onclick="valid()" type="submit">投稿する</button>
            </div>
        </form>
        <div>
            @foreach($errors->all() as $error)
                <p style="color:red;">{{$error}}</p>
            @endforeach
        </div>
    </div>
</body>
<script>
    const valid = () => {
        let content = document.getElementById("content").value;
        if (content.length <= 0 || content.length >= 140) {
            alert("１文字以上１４０文字以下で入力してください")
        }
    }
</script>
<script src="{{ asset('/js/app.js') }}"></script>
<style scoped>
    .post-page .form {
        display: flex;
        flex-direction: column;
    }
    
    .post-page .post-button {
        text-align: end;
        margin: 20px 20px 0 0;
    }
    
    .post-page button {
        height: 35px;
        width: 90px;
    }
</style>

</html>