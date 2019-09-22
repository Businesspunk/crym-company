@extends('components.layout')

@section('after_css')
	<link rel="stylesheet" href="{{ asset('styles/cropper.css') }}">

	<style>
		img {
		max-width: 100%;
		}
		section.my-settings .photo_y .right{
			position: relative;
		}
		.spinner-border{
			display: none;
		}
		section.my-settings .photo_y .right .spinner-border{
			position: absolute;
			top: 0;
			left: 0;
		}
		.cropper-view-box,
		.cropper-face {
		border-radius: 50%;
		}

		.modal.show{
			z-index: 1050;
			opacity: 1;
		}
		.modal{
			display: block;
			opacity: 0;
			z-index: -10;
		}
		
	</style>
@endsection

@section('content')
<main>
	<?php $activePage = 'my-settings.php'; ?>
	
	@include('components.profile-menu')
	<section class="my-settings">
		<div class="container">
			<form method="POST">
				@csrf
				<div class="title">Контактная информация</div>
				<div class="wrap int">
					<div class="left">Телефон</div>
					<div class="right">
						<input value="{{ $user->profile->number }}" name="number" placeholder="Введите телефон" type="text">
					</div>
				</div>
				<div class="divider">
					<div class="line"></div>
				</div>
				<div class="title">Настройки аккаунта</div>
				<div class="wrap photo_y int">
					<div class="left">Фотография</div>
					<div class="right">
						<div id="preloader" class="spinner-border text-primary" role="status">
								<span class="sr-only">Loading...</span>
						</div>
						<img src="{{ getAvatarSrc( $user ) }}" alt="">
						<label>
							<input id="pemanentUpload" class="file" type="file">
							<span class="text">Загрузить</span>
						</label>
						
					</div>
				</div>
				<div class="wrap int">
					<div class="left">Город</div>
					<div class="right">
						<input value="{{ $user->profile->city }}" name="city" placeholder="Ваш город" type="text">
					</div>
				</div>
				<div class="wrap int">
					<div class="left"></div>
					<div class="right">
						<input type="submit" class="sumb" value="Сохранить">
					</div>
				</div>
			</form>
		</div>
	</section>

	<!-- Modal -->
	<div class="modal fade" id="avatarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Выберите миниатюру</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div>
				<img id="image" src="" alt="Picture">
				</div>
			</div>
			<div class="modal-footer">
				<div id="preloader2" class="spinner-border text-primary" role="status">
					<span class="sr-only">Loading...</span>
				</div>
				<button id="saveImage" type="button" class="btn btn-primary">Сохранить</button>
			</div>
			</div>
		</div>
	</div>

</main>
@endsection

@section('after_js')
	<script src="{{ asset('js/cropper.js') }}" ></script>
	<script>
		

		$(document).ready(function(){
			var cropper;
			$('#pemanentUpload').change(function(){
				$imageInRedactor = $('#image');
				$('#preloader').fadeIn(200);

				var formData = new FormData();
				formData.append('avatar', $('#pemanentUpload')[0].files[0]);

				$.ajax({
					url: "{{ route('permanentUploadAvatar') }}",
					type: 'POST',
					data: formData,
					processData: false, 
					contentType: false, 
					success: function (data) {
						$('#preloader').fadeOut(200);
						if( data.error ){ 
							showErrors(data.messages);
							return;
						}
						
						$imageInRedactor.attr('src', data.src );

						cropper = new Cropper( $imageInRedactor[0], {
							aspectRatio: 1,
							viewMode: 1,
							ready: function () {
								croppable = true;
							},
						});
						
						$('#avatarModal').modal('show');
					}
				});
			})

		$('#saveImage').click(function(){
			$('#preloader2').fadeIn(200);
			getRoundedCanvas( cropper.getCroppedCanvas() ).toBlob((blob) => {

				formData = new FormData();
				formData.append('avatar', blob);

				$.ajax('{{ route("updateAvatar") }}', {
					method: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					success: function() {
						location.reload()
					},
					error: function() {
						console.log('Upload error');
					},
				});
			});
		})
})
	</script>


	<script>
		function getRoundedCanvas(sourceCanvas) {
			var canvas = document.createElement('canvas');
			var context = canvas.getContext('2d');
			var width = sourceCanvas.width;
			var height = sourceCanvas.height;

			canvas.width = width;
			canvas.height = height;
			context.imageSmoothingEnabled = true;
			context.drawImage(sourceCanvas, 0, 0, width, height);
			context.globalCompositeOperation = 'destination-in';
			context.beginPath();
			context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI, true);
			context.fill();
			return canvas;
		}

	</script>
@endsection