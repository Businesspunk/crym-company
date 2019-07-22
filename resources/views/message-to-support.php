<?php include 'components/header.php'; ?>
<main>
	<?php
	$name = "Помощь";
	include 'components/sub-menu.php'; ?>
	<section class="message-to-support">
		<div class="container">
			<div class="h4">Написать в техподдержку </div>
			<form>
				<div class="wrap email">
					<div class="left">
						Электронная почта
					</div>
					<div class="right">
						<input type="text" placeholder="@">
					</div>
				</div>
				<div class="wrap topic">
					<div class="left">
						Тема сообщения
					</div>
					<div class="right">
						<input type="text" placeholder="Тема">
					</div>
				</div>
				<textarea placeholder="Сообщение" rows="10"></textarea>
				<input type="submit" value="Отправить">
			</form>
		</div>
	</section>
</main>
<?php include 'components/footer.php'; ?>