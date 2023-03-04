<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/reset.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}" />

    <title>kadai-app | ホーム画面</title>
</head>
<!-- ホーム画面 -->

<body class="">
    <x-header></x-header>
    <div class="page home-page">
        <div class="page-title">ホーム</div>
        <div class="post-list">
            @foreach ($posts as $post)
            @if ( !$post['post']->is_deleted)
            <div class="post">
                <a href="/user/{{ $post['user']->id }}">
                    <img class="user-icon" src="{{ asset('/img/user_icon.png') }}" alt="" />
                </a>
                <div class="container">
                    <a href="/user/{{ $post['user']->id }}">
                        <div class="user-name">
                            {{ $post['user']->name }}
                        </div>
                    </a>
                    <a href="/post/detail/{{ $post['post']->id }}">
                        <div class="content">
                            {{ $post['post']->content }}
                        </div>
                        <div class="time-stamp">
                            {{ $post['post']->created_at }}
                        </div>
                    </a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</body>
<x-footer></x-footer>
<script src="{{ asset('/js/app.js') }}"></script>
<style scoped>
    .home-page .page-title {
        font-size: 20px;
        font-weight: bold;
        color: gray;
        padding-left: 10px;
    }
    
    .home-page .post-list {
        margin-top: 10px;
    }
    
    .home-page .post {
        display: flex;
        width: 100vw;
        padding: 0 10px;
    }
    
    .home-page .post .container {
        width: 100%;
    }
    
    .home-page .user-icon {
        width: 40px;
        height: 40px;
    }
    
    .home-page .user-name {
        line-height: 40px;
    }
    
    .home-page .content {
        font-size: 14px;
    }
    
    .home-page .time-stamp {
        font-size: 8px;
        text-align: end;
    }
</style>

</html>