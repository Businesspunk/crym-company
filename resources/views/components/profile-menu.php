<?php $profilePages = [
	'my-posts.php'	=> 'Мои объявления',
	'my-messages.php' => 'Мои сообщения',
	'my-bookmarks.php' => 'Закладки',
	'my-settings.php' => 'Настройки',
	'my-support.php' => 'Помощь'
	]


 ?>
<section class="profile-menu">
	<div class="container">
		<div class="left">
			<img src="img/logo.png" alt="" class="logo_photo">
		</div>
		<div class="right">
			<div class="links">
				<?php foreach( $profilePages as $url => $title ): ?>
					<a
					<?php if( isset($activePage) &&  $activePage == $url ): ?>
						class="active"
					<?php endif; ?> 
						href="<?= $url; ?>">
						<?= $title; ?>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>