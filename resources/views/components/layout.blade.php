<?php 
	$isRegisterError = $errors->register->count() > 0;
	$isLoginError = $errors->has('loginerror');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<title>Недвижимость</title>
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
	

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }} ">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('jquery-ui/jquery-ui.structure.min.css') }}">
	<link rel="stylesheet" href="{{ asset('jquery-ui/jquery-ui.min.css') }}">
	<link rel="stylesheet" href="{{ asset('jquery-ui/jquery-ui.theme.min.css') }}">
	<link rel="stylesheet" href="{{ asset('styles/reset.css') }}">
	<link rel="stylesheet" href="{{ asset('slick/slick-theme.css') }}">
	<link rel="stylesheet" href="{{ asset('slick/slick.css') }}">
	<link rel="stylesheet" href="{{ asset('style.css?v=4') }}">
	
    @yield('after_css')
</head> 
<body>
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
					<a href="#">
						<i class="fa fa-heart" aria-hidden="true"></i>
					</a>
				</div>
				<div class="title rd3">
					Недвижимость и строительство республики Крым 
				</div>
				<div class="number th4">
					<a href="+79616342146">+7 (961) 634-21-46</a>
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
							<a href="#">Объявления</a>
							<a href="#">Магазины</a>
							<a href="#">Бизнес</a>
							<a href="#">Помощь</a>
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
                                        <a href="{{ route('my-messages') }}" class="item ">
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
                                        <a href="{{ route('my-support') }}" class="item ">
                                            <span class="icon">
                                                <img src="{{ asset('img/icons/help.png') }}" alt="">
                                            </span>
                                            <span class="menu_item">Помощь</span>
                                        </a>
                                        <a href="#" class="item sight_out">
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
	</header>
	<section class="mobile_menu">
			<div class="wrap">
			<div class="close_mob_menu">
				<i class="fa fa-times" aria-hidden="true"></i>
			</div>
				<a href="#">Объявления</a>
				<a href="#">Магазины</a>
				<a href="#">Бизнес</a>
				<a href="#">Помощь</a>
				<a href="#" class="firm_btn btn_blue put">
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
					<div class="items">
						@foreach( $maincategories as $maincat )
							<div class="item">
								<div class="title category">{{ $maincat->name }}</div>
									@foreach( $maincat->categories as $cat )
										<a class="category" href="{{ route('category', $cat->slug) }}">{{ $cat->name }}</a>
									@endforeach
							</div>
						@endforeach
					</div>
				</div>
				<div class="bottom">
					<div class="desc">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
						sed do eiusmod tempor incididunt 
					</div>
					<div class="social">
						<a href="#"><img src="{{ asset('img/icons/facebook.png') }}" alt=""></a>
						<a href="#"><img src="{{ asset('img/icons/instagram.png') }}" alt=""></a>
						<a href="#"><img src="{{ asset('img/icons/ok.png') }}" alt=""></a>
						<a href="#"><img src="{{ asset('img/icons/twitter.png') }}" alt=""></a>
						<a href="#"><img src="{{ asset('img/icons/vk.png') }}" alt=""></a>
					</div>
					<div class="website">
						Сайт разработан командой Web-Marketing
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
                                            <a href="#" class="open-modal" data-modal="#reset-password-by-email">Забыли пароль?</a>
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
                                    <a href="#"><img src="{{ asset('img/icons/facebook.png') }}" alt=""></a>
                                    <a href="#"><img src="{{ asset('img/icons/ok.png') }}" alt=""></a>
                                    <a href="#"><img src="{{ asset('img/icons/vk.png') }}" alt=""></a>
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
	<script src="{{ asset('scrolly/dist/jquery.scroolly.min.js') }}"></script>
	<script src="{{ asset('slick/slick.min.js') }}"></script>
	<script src="{{ asset('main.js?s=3') }}"></script>
    @yield('after_js')
</body>
</html>