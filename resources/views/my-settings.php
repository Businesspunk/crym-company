<?php include 'components/header.php'; ?>
<main>
	<?php $activePage = 'my-settings.php'; ?>
	<?php include "components/profile-menu.php"; ?>

	<section class="my-settings">
		<div class="container">
			<form>
				<div class="title">Настройки профиля</div>
				<div class="wrap int">
					<div class="left">Телефон</div>
					<div class="right">
						<input placeholder="Введите телефон" type="text">
					</div>
				</div>
				<div class="wrap int">
					<div class="left">Электронная почта</div>
					<div class="right">
						<input placeholder="@" type="text">
					</div>
				</div>
				<div class="divider">
					<div class="line"></div>
				</div>
				<div class="title">Контактная информация</div>
				<div class="wrap photo_y int">
					<div class="left">Фотография</div>
					<div class="right">
						<img src="img/tests/account.jpg" alt="">
						<label><input class="file" type="file">
							<span class="text">Загрузить</span>
						</label>
					</div>
				</div>
				<div class="wrap int">
					<div class="left">Город</div>
					<div class="right">
						<input placeholder="Ваш город" type="text">
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
</main>
<?php include 'components/footer.php' ?>