@extends('components.layout')

@section('after_css')
	<link rel="stylesheet" href="{{ asset('css/lightbox.min.css') }}">
@endsection

@section('content')
<main>
	<div class="container">
		@isset( $breadcrumbs )
			{{ $breadcrumbs }}
		@endisset
	</div>
	
	@include('components.profile-menu')
	<section class="my-messages">
		<div class="container">
			<div class="h4">Диалоги</div>
			@if( $dialogs->count() )
			<div class="dialog">
				<div class="left">
					<div class="spacer"></div>
					@foreach( $dialogs as $dialog )
						<?php $opponent = $dialog->getOponent( Auth::id() ) ?>
						<a class="itemDialogMenu" data-eq="{{ $loop->iteration }}" href="#">
							<div class="photo">
								<img src="{{ getAvatarSrc( $opponent ) }}" alt="">
							</div>
							<div class="info">
								<div class="name">
									{{ $opponent->name }}
								</div>
								<div class="last_m">
									@if( $dialog->getLastMessage() )
										@if( $dialog->getLastMessage()->isPhoto )
											Фотография
										@else
											{{ $dialog->getLastMessage()->getSomePart() }}
										@endif
									@endif
								</div>
							</div>
							@if( $dialog->getLastMessage() )
								<div class="date">{{ $dialog->getLastMessage()->getTime() }}</div>
							@endif
							@if( $dialog->post )
								<div class="img">
									<img src="{{ getPostPhotoSrc( $dialog->post->main_photo ) }}" alt="">
								</div>	
							@endif
						</a>
					@endforeach
					<div class="spacer"></div>
				</div>
				<div class="right">
					<div class="messages">
						<div class="messages_wrap">
							@foreach( $dialogs as $dialog )
								<div data-eq="{{ $loop->iteration }}" class="ms_www">
									<div class="message">
										<div class="head">

											@if( $dialog->post )
												<div class="photo">
													<img src="{{ getPostPhotoSrc( $dialog->post->main_photo ) }}" alt="">
												</div>
												<div class="info">
													<div class="title"> {{ $dialog->post->title }} </div>
													<div class="cost">{{ get_price($dialog->post->cost) }}</div>
												</div>
											@endif

											<div class="showMenuDialog">
												<div class="cir"></div>
												<div class="cir"></div>
												<div class="cir"></div>
											</div>
										</div>	
										<div class="body">
											@foreach( $dialog->messages as $message )
												<?php $author = $message->author; ?>
												
												<div class="@if( $message->isAuthor( Auth::id() )){{ 'me' }}@else{{ 'other' }}@endif mes">
													<div class="mes_wrap">
														@if( !$message->isAuthor( Auth::id() ) )
															<img class="acc_img" src="{{ getAvatarSrc( $author ) }}" alt="">
														@endif
														<div class="info">
															<div class="text">
																@if( $message->isPhoto )
																	<a href="{{ getPostPhotoSrc( $message->message )}}" data-lightbox="example-gallery{{ $loop->index }}">
																		<img class="img-fluid" src="{{ getPostPhotoSrc( $message->message ) }}">
																	</a>
																@else
																	{{ $message->message }}
																@endif
															</div>
															<div class="time"> {{ $message->getTime() }} </div>
														</div>
														@if( $message->isAuthor( Auth::id() ) )
															<img class="acc_img" src="{{ getAvatarSrc( $author ) }}" alt="">
														@endif
													</div>
												</div>
											@endforeach

										</div>
										<div class="bottom">
											<form method="POST" action="{{ route('message.send') }}" enctype="multipart/form-data">
												@csrf
												<input type="hidden" name="dialog" value="{{ $dialog->id }}" >
												<div class="wrap_text">
													<label class="phot">
														<i class="fa fa-camera" aria-hidden="true"></i>
														<input id="uploadFileMessage" name="fileMessage" class="file" type="file">
													</label>
													<textarea rows="2" class="ms_s" name="message"></textarea>
													<label class="send">
														<i class="fa fa-paper-plane" aria-hidden="true"></i>
														<input class="send_m" type="submit">
													</label>
												</div>
											</form>
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
			@else
				<div class="alert alert-info" role="alert">
					У вас нет диалогов
				</div>
			@endif
		</div>
	</section>
</main>
@endsection

@section('after_js')
	<script>
		$('#uploadFileMessage').change(function(){
			$form = $(this).closest('form');
			$form.submit();
		})
	</script>
	<script src="{{ asset('js/lightbox.min.js') }}" ></script>

	<script>
		lightbox.option({
		'resizeDuration': 200,
		'wrapAround': true,
		'albumLabel' : "Изображение %1 из %2"
		})
	</script>
@endsection