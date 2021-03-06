<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=
1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
        <title>@yield('title')</title>

        <!-- Scripts -->
        {{-- Laravel標準で読み込まれているjavascriptを読み込みます -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dnds-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Railway:300,40
0,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準で読み込まれているcssを読み込みます --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    </head>
    <body>
      <div id="app">
          {{-- 画面上部に表示するナビゲーションバーです。 --}}
          <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
              <div class="container">
                  <a class="navbar-brand" href="{{ url('/') }}">
                      {{ config('app.name', 'Laravel') }}
                  </a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <!-- Left Side Of Navbar -->
                      <ul class="navbar-nav mr-auto">

                      </ul>

                      <!-- Right Side Of Navbar -->
                      <ul class="navbar-nav ml-auto">

                        {{-- 以下を追記 --}}
                        <!-- Authentication Links -->
                        {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            @endguest
                            {{-- 以上までを追記 --}}
                        </ul>
                  </div>
              </div>
          </nav>
          {{-- ここまでナビゲーションバー --}}

          <main class="py-4">
            <div class="row">
                <div class="col-md-9">
                    <div class="community-button">
                        <a href="{{ action('Admin\AppController@index') }}" role=button class="btn btn-primary">コミュニティ一覧に戻る</a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="back-button">
                        <a href="{{ action('Admin\AppController@add') }}" role=button class="btn btn-primary">プロフィールに戻る</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="caption mx-auto">
                                <div class="image">
                                    <img src="{{ asset('storage/image/' . $tweet->community->image_path) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="name">
                                <h1 >{{ str_limit($tweet->community->name, 50) }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="detail-button">
                    <a href="{{ action('Admin\AppController@top', ['id' => $tweet->community_id]) }}" role=button class="btn btn-primary">概要</a>
                </div>
                <div class="timeline-button">
                    <a href="{{ action('Admin\AppController@timeline', ['id' => $tweet->community_id]) }}" role=button class="btn btn-primary">タイムライン</a>
                </div>
                <div class="event-button">
                    <a href="{{ action('Admin\AppController@event', ['id' => $tweet->community_id]) }}" role=button class="btn btn-primary">イベント</a>
                </div>
            </div>
              {{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}
              @yield('content')
          </main>
      </div>
    </body>
</html>
