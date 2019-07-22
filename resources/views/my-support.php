<?php include 'components/header.php'; ?>
<main>
	<?php $activePage = 'my-support.php'; ?>
	<?php include "components/profile-menu.php"; ?>

	<section class="my-support">
		<div class="container">
			<div class="title">Частые вопросы</div>

			<div class="items">
				<?php for($i = 0; $i < 5; $i++): ?>
					<div class="faq">
						Объявление заблокировали за повторную подачу
					</div>
				<?php endfor; ?>
			</div>
			<div class="block">
				<div>
					<div class="title">
						Служба поддержки
					</div>
					<div class="sub">
						Если вы не нашли решение, обратитесь в службу поддержки.
					</div>
				</div>
				<div class="btn">
					<a href="message-to-support.php">Задать вопрос</a>
				</div>
			</div>
		</div>
	</section>
</main>
<?php include 'components/footer.php' ?>