<?php include 'components/header.php'; ?>
<main>
	<?php $activePage = 'my-posts.php'; ?>
	<?php include 'components/profile-menu.php'; ?>
	<section class="my-posts">
		<div class="container">
			<div class="toggle_button">
				<div class="wrap">
					<div class="h4">
						<a data-target=".active" class="active myPostsChangeType" href="#" >Активные</a>
					</div>
					<div class="h4">
						<a data-target=".close" class="myPostsChangeType" href="#">Закрытые</a>
					</div>
				</div>
			</div>
			<div class="contt">
				<div class="active">
					<div class="wrap_g">
						<?php for($i = 0; $i < 2; $i++): ?>
							<?php include 'components/post-2.php'; ?>
						<?php endfor; ?>
					</div>
				</div>
				<div class="close">
					<div class="wrap_g">
						<?php for($i = 0; $i < 7; $i++): ?>
							<?php include 'components/post-2.php'; ?>
						<?php endfor; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php include 'components/footer.php'; ?>