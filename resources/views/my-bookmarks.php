<?php include 'components/header.php'; ?>
<main>
	<?php $activePage = 'my-bookmarks.php'; ?>
	<?php include 'components/profile-menu.php' ?>
	<section class="my-bookmarks">
		<div class="container">
			<div class="items objects">
			<?php for($i = 0; $i < 5; $i++): ?>
				<?php include 'components/post.php' ?>
			<?php endfor; ?>
			</div>
		</div>
	</section>
</main>
<?php include 'components/footer.php'; ?>