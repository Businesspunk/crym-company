<?php 
	$isRegisterError = $errors->register->count() > 0;
	$isLoginError = $errors->has('loginerror');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="yandex-verification" content="f7af27c159a6b6e4">
	<title>
        @if( isset( $header ) && isset( $header['title'] ) )
            {{ $header['title'] }}
        @else
            Крымский — Бесплатные объявления на сайте Крымский
        @endif
    </title>


    @if( isset( $header ) && isset( $header['description'] ) )
        <meta name="description" content="{{ $header['description'] }}">            
    @else
        <meta name="description" content="Крымский — Бесплатные объявления на сайте Крымский">    
    @endif

    @if( isset( $header ) && isset( $header['keywords'] ) )
        <meta name="keywords" content="$header['keywords']">       
    @else
        <meta name="keywords" content="Крымский — Бесплатные объявления на сайте Крымский">
    @endif

  

	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="msapplication-TileColor" content="#FFFFFF" />
	<meta name="msapplication-TileImage" content="{{ asset('img/favicons/mstile-144x144.png') }}" />
	<meta name="msapplication-square70x70logo" content="{{ asset('img/favicons/mstile-70x70.png') }}" />
	<meta name="msapplication-square150x150logo" content="{{ asset('img/favicons/mstile-150x150.png') }}" />
	<meta name="msapplication-wide310x150logo" content="{{ asset('img/favicons/mstile-310x150.png') }}" />
	<meta name="msapplication-square310x310logo" content="{{ asset('img/favicons/mstile-310x310.png') }}" />

	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('img/favicons/apple-touch-icon-57x57.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('img/favicons/apple-touch-icon-114x114.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('img/favicons/apple-touch-icon-72x72.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('img/favicons/apple-touch-icon-144x144.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('img/favicons/apple-touch-icon-60x60.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('img/favicons/apple-touch-icon-120x120.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('img/favicons/apple-touch-icon-76x76.png') }}" />
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('img/favicons/apple-touch-icon-152x152.png') }}" />
	<link rel="icon" type="image/png" href="{{ asset('img/favicons/favicon-196x196.png')}}" sizes="196x196" />
	<link rel="icon" type="image/png" href="{{ asset('img/favicons/favicon-96x96.png')}}" sizes="96x96" />
	<link rel="icon" type="image/png" href="{{ asset('img/favicons/favicon-32x32.png')}}" sizes="32x32" />
	<link rel="icon" type="image/png" href="{{ asset('img/favicons/favicon-16x16.png')}}" sizes="16x16" />
	<link rel="icon" type="image/png" href="{{ asset('img/favicons/favicon-128.png')}}" sizes="128x128" />
	<meta name="application-name" content="&nbsp;"/>
	
    <style>
        .preloader{position: absolute;top: 0;left: 0;width: 100%;height: 200%;background: #fff;z-index: 999;}
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }} ">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('jquery-ui/jquery-ui.structure.min.css') }}">
	<link rel="stylesheet" href="{{ asset('jquery-ui/jquery-ui.min.css') }}">
	<link rel="stylesheet" href="{{ asset('jquery-ui/jquery-ui.theme.min.css') }}">
	<link rel="stylesheet" href="{{ asset('styles/reset.css') }}">
	<link rel="stylesheet" href="{{ asset('slick/slick-theme.css') }}">
	<link rel="stylesheet" href="{{ asset('slick/slick.css') }}">
	<link rel="stylesheet" href="{{ asset('style.css?v='. (21)) }}">
	
    @yield('after_css')
    
</head> 
<body>
    <div class="preloader"></div>
	<header>
		<div class="header_container">
			<div class="first">
				<div class="st1">
                    @guest
                        <a data-modal="#modal-entire" class="firm_btn open-modal btn_white sigh-in" href="#">
                            Вход и Регистрация
                        </a>
                    @endguest
				</div>
				<div class="nd2">
					<a class="favar_link" href="{{ route('my-bookmarks') }}">
						<i class="fa fa-heart" aria-hidden="true"></i>
                        <span class="favor">Избранное</span>
					</a>
				</div>
				<div class="title rd3">
					<span>Крымский.ру</span>
                    <p>Недвижимость и строительство республики Крым </p>
				</div>
				<div class="number th4">
                    <a class="firm_btn btn_white sigh-in">
                        Помощь
                    </a>
				</div>
				<div class="th5">
                    @auth
                        <a href="{{ route('addPost') }}" class="firm_btn btn_blue put">
                            Подать объявление
                        </a>
                    @endauth
                    
				</div>
			</div>
		</div>
			
		<div class="wrap_before_second">
			<div class="second">
					<div class="container">
						<div class="left">
							<div class="show_mobile_menu">
								<div class="wrap">
									<div class="rise"></div>
									<div class="rise"></div>
									<div class="rise"></div>
								</div>
							</div>
							<a href="{{ route('posts') }}">Объявления</a>
							<a href="{{ route('messageToSupport') }}">Помощь</a>
							<a href="{{ route('goodOffers') }}">Недвижимость на особых условиях</a>
						</div>
                        @auth
                            <div class="right">
                                <div class="account">
                                    <img src="{{ getAvatarSrc( Auth::user() ) }}" alt="">
                                </div>
                                <div class="menu_account">
                                    <div class="wrap_menu_account">
                                        <a href="{{ route('my-posts') }}" class="item ">
                                            <span class="icon">
                                                <img src="{{ asset('img/icons/report.png') }}" alt="">
                                            </span>
                                            <span class="menu_item">Мои объявления</span>
                                        </a>
                                        <a href="{{ route('messages') }}" class="item ">
                                            <span class="icon">
                                                <img src="{{ asset('img/icons/message.png') }}" alt="">
                                            </span>
                                            <span class="menu_item">
                                                Мои сообщения
                                            </span>
                                        </a>
                                        <a href="{{ route('my-bookmarks') }}" class="item ">
                                            <span class="icon">
                                            <img src="{{ asset('img/icons/love.png') }}" alt="">
                                            </span>
                                            <span class="menu_item">Закладки</span>
                                        </a>
                                        <a href="{{ route('my-settings') }}" class="item ">
                                            <span class="icon">
                                                <img src="{{ asset('img/icons/settings.png') }}" alt="">
                                            </span>
                                            <span class="menu_item">Настройки</span>
                                        </a>
                                        <a href="{{ route('messageToSupport') }}" class="item ">
                                            <span class="icon">
                                                <img src="{{ asset('img/icons/help.png') }}" alt="">
                                            </span>
                                            <span class="menu_item">Помощь</span>
                                        </a>
                                        <a href="{{ route('logout') }}" class="item sight_out">
                                            <span class="icon">
                                                <img src="{{ asset('img/icons/sign-out.png') }}" alt="">
                                            </span>
                                            <span class="menu_item">Выход</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endauth
					</div>
				</div>
            </div>
            @if( Auth::check() && Auth::user()->messagesNotification )
            <div aria-live="polite" aria-atomic="true" style="position: absolute; margin-top: 20px; right: 3%;">
                <div class="toast messageNotification" style="opacity: 1;" >
                    <div class="toast-header">
                    <strong class="mr-auto">Уведомление</strong>
                    <small> {{ Auth::user()->messagesNotification->created_at->diffForHumans() }} </small>
                    </div>
                    <div class="toast-body">
                        <p>У вас новое сообщение</p>
                         <p> <a href="{{ route('messages') }}">Перейти к диалогам</a> </p>
                    </div>
                </div>
            </div>
            @endif
	</header>
	<section class="mobile_menu">
			<div class="wrap">
			<div class="close_mob_menu">
				<i class="fa fa-times" aria-hidden="true"></i>
			</div>
				<a href="{{ route('posts') }}">Объявления</a>
				<a href="{{ route('messageToSupport') }}">Помощь</a>
				<a href="{{ route('goodOffers') }}">Недвижимость на особых условиях</a>
				<a href="{{ route('addPost') }}" class="firm_btn btn_blue put">
					Подать объявление
				</a>
				<a data-modal="#modal-entire" class="open-modal firm_btn btn_white sigh-in" href="#">
					Вход и Регистрация
				</a>
			</div>
    </section>
    
    


    @yield('content')

    <footer>
			<div class="container">
				<div class="main">

                @if( isset($count) )
                    <div class="main_title">
                        <h1>
                            @if( isset( $title ) )
                                {{ upFirstLetter( $title ) }}
                            @else
                                {{ upFirstLetter( $category->name) }}
                            @endif
                        </h1>
                        <span class="number">{{ $count }}</span>
                    </div>
                @endif

					<div class="items">
						@foreach( $maincategories->sortBy('weightSort') as $maincat )
                                <div class="item">
                                    <div class="title category">
                                        <a href="{{ route('maincategory', $maincat->slug ) }}">{{ $maincat->name }}</a>
                                    </div>
                                        @foreach( $maincat->categories->sortBy('weightSort') as $cat )
                                            <a class="category" href="{{ route('category', [ 'maincategory' => $maincat->slug , 'slug' => $cat->slug]) }}">{{ $cat->name }}</a>
                                        @endforeach
                                </div>
						@endforeach
					</div>
				</div>
				<div class="bottom documentsLinks">
					<div class="desc">
						<a class="useragreements" href="{{ route('agreement.user') }}">Пользовательское соглашение</a>
						<a class="useragreements" href="{{ route('agreement.privacyPolicy') }}">Политика конфиденциальности</a>
						<a class="useragreements" href="{{ route('agreement.oferta') }}">Договор оферты</a>
					</div>
					<div class="website senior">
						Разработка сайта EZTec
					</div>
				</div>
			</div>
		</footer>
	@guest
		<div class="popup_f">
            <div class="overlay @if($isLoginError) open @endif">
                <div class='modal2 @if($isLoginError) open @endif' id='modal-entire'>
                    <a class='btn close-modal' data-modal="#modal-entire" href="#">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                    <div class='content'>
                        <form action="{{ route('loginPost') }}" method="POST" >
							@csrf
                            <div class="top">
                                <div class="h4">Вход</div>
                            </div>
                            <div class="body">
                                <div class="sm_c" >
                                    <div class="wrap_inp">
                                        <input name="email" placeholder="Электронная почта" type="text" class="firm_inp">
                                    </div>
                                    <div class="wrap_inp">
                                        <input name="password" placeholder="Пароль" type="password" class="firm_inp">
                                    </div>
                                    <div class="add_panel">
                                        <div class="remember_me">
                                            <label class="wrap_checkbox">
                                                <input name="remember" type="checkbox">
                                                <span class="icon">
                                                    <i class="fa fa-check" aria-hidden="true"></i>
                                                </span>
                                                <span class="text">запомнить меня</span>
                                            </label>
                                        </div>
                                        <div class="reset_pas">
                                            <a href="{{ route('password.request') }}" >Забыли пароль?</a>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="firm_btn" value="Войти">
								@if($isLoginError)
									@foreach( $errors->get('message') as $error )
										<div class="alert alert-danger" role="alert">
											{{ $error }}
										</div>
									@endforeach
								@endif
                                <div class="orGo">или продолжить через</div>
                                <div class="social">
                                    <a href="{{ getFBAuthLink() }}"><img src="{{ asset('img/icons/facebook.png') }}" alt=""></a>
                                    <a href="{{ getVkAuthLink() }}"><img src="{{ asset('img/icons/vk.png') }}" alt=""></a>
                                </div>
                            </div>
                            <div class="bottom">
                                <div class="register">
                                    <a class="open-modal" data-modal="#modal-register" href="#">Зарегистрироваться</a>
                                </div>
                                <div class="text">
                                    При входе вы подтверждаете согласие с условиями использования Компании и политикой о данных пользователей.
                                </div>
                            </div>
                        </form>
                    </div>	
                </div>
            </div>
		</div>
		<div class="popup_f">
            <div class="overlay @if($isRegisterError) open @endif">
                <div class='modal2 @if($isRegisterError) open @endif' id='modal-register'>
                    <a class='btn close-modal' data-modal="#modal-register" href="#">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                    <div class='content'>
                        <form method="POST" action="{{ route('registerPost') }}">
                            @csrf
                            <div class="top">
                                <div class="h4">Регистрация</div>
                            </div>
                            <div class="body">
                                <div class="sm_c" >
                                    <div class="wrap_inp">
                                        <input name="name" required value="{{ old('name') }}" placeholder="Имя" type="text" class="firm_inp">
                                    </div>
                                    <div class="wrap_inp">
                                        <input name="email" required value="{{ old('email') }}" placeholder="Электронная почта" type="text" class="firm_inp">
                                    </div>
                                    <div class="wrap_inp">
                                        <input name="password" required placeholder="Пароль" type="password" class="firm_inp">
                                    </div>
                                    <div class="wrap_inp">
                                        <input name="password_confirmation" required placeholder="Повторите пароль" type="password" class="firm_inp">
                                    </div>
                                </div>
                                <input type="submit" class="firm_btn" value="Продолжить">
                                @foreach( $errors->register->all() as $error )
                                    <div class="alert alert-danger" role="alert">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            </div>
                            <div class="bottom">
                                У вас есть учетная запись? <a class="open-modal" data-modal="#modal-entire" href="#">Войти</a>
                            </div>
                        </form>
                    </div>	
                </div>
            </div> 
		</div>

		<div class="popup_f">
			<div class="overlay">
				<div class='modal2' id='reset-password-by-email'>
					<a class='btn close-modal' data-modal="#reset-password-by-email" href="#">
						<i class="fa fa-times" aria-hidden="true"></i>
					</a>
					<div class='content'>
						<form action="">
							<div class="top">
								<div class="h4">Восстановление пароля</div>
							</div>
							<div class="body">
								<div class="sm_c" >
									<div class="wrap_inp">
										<input placeholder="Введите электронную почту" type="text" class="firm_inp">
									</div>
								</div>
								<input type="submit" class="firm_btn" value="Сбросить пароль">
							</div>
						</form>
					</div>	
				</div>
			</div>
		</div>
    @endguest

    @auth

    @if( !Auth::user()->type_of_account )
        <div class="popup_f">
            <div class="overlay open">
                <div class='modal2 open'>
                    <div class='content choose_account'>
                        <form method="POST" action="{{ route('setaccounttype') }}">
                            @csrf
                            <div class="top">
                                <div class="h4">Выберите тип аккаунта</div>
                            </div>
                            <div class="body">
                                <div class="sm_c" >
                                    <div class="wrap_inp wrap_choose">
                                        <label >
                                            <input type="radio" required name="type" value="1">
                                            <span class="firm_btn2">Физическое лицо</span>
                                            <p>6 бесплатных объявлений</p>
                                        </label>
                                        <label>
                                            <input type="radio" required name="type" value="2">
                                            <span class="firm_btn2">Юридическое лицо</span>
                                            <p>10 беплатных объявлений</p>
                                        </label>
                                    </div>
                                    <input type="submit" class="firm_btn" value="Продолжить">
                                </div>
                            </div>
                        </form>
                    </div>	
                </div>
            </div> 
        </div>
    @endif
        

    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ошибка</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-none" role="alert"></div>
                <div class="insertion">
                
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
            </div>
            </div>
        </div>
    </div>
    @endauth

	<script src="{{ asset('jquery-ui/external/jquery/jquery.js') }}"></script>
	<script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="{{ asset('jquery-ui/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('js/cookie.js') }}"></script>
	<script src="{{ asset('scrolly/dist/jquery.scroolly.min.js') }}"></script>
	<script src="{{ asset('slick/slick.min.js') }}"></script>
    <script src="{{ asset('main.js?v='). (20) }}"></script>
    
    <script>    
        var routes_variable = [ "{!! route( 'post.addFollowing' ) !!}" ]
    </script>

    @yield('after_js')
    <script>
        $(window).on('load',function() {
            $(".preloader").delay(50).fadeOut(300, function(){
                $(".preloader").remove();
            });    
        });
    </script>
</body>
</html>
