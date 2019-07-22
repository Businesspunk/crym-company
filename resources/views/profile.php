<?php include 'components/header.php'; ?>
<main>
	<?php include 'components/category.php'; ?>
	<section class="profile">
		<div class="container">
			<div class="left">
				<?php include 'components/people.php'; ?>
			</div>
			<div class="right">
				<div class="head">
					<div class="item">
						<div class="h4">
							<a class="in-sale active" data-target=".in-sale" href="#">В продаже</a>
						</div>
					</div>
					<div class="item">
						<div class="h4">
							<a class="in-sale" data-target=".from-sale" href="#">Продано</a>
						</div>
					</div>
				</div>
				<div class="body">
					<div class="in-sale active hiddable">
						<div class="items objects">
							<?php for($i = 0; $i < 2; $i++): ?>
								<?php include 'components/post.php'; ?>
							<?php endfor; ?>
						</div>
					</div>
					<div class="from-sale hidden hiddable">
						<div class="items objects">
							<?php for($i = 0; $i < 2; $i++): ?>
								<?php include 'components/post.php'; ?>
							<?php endfor; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php include 'components/footer.php'; ?>