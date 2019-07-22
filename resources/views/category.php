<?php 	include 'components/header.php'; ?>
	<main>
		<?php include 'components/category.php'; ?>
		<section class="fourth section--margin-top">
			<div class="container">
				<div class="main_title">
					<span>Категория</span>
					<span class="number">256</span>
				</div>
			</div>
			<div class="container wrap_grid">
				<div class="left">
					<div class="items">
						<div class="item named">
							Категория
						</div>
						<div class="item filter">
							<div class="name">Цена</div>
							<form action="">
								<div class="wrap">
									<input type="text" name="" placeholder="От" id="">
									<input type="text" name="" placeholder="До" id="">
								</div>
								<div class="tac">
									<input type="submit" value="Показать 5000 объявлений">
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="right">
					<div class="choosen">
						<label>
							<input type="radio" name="choose" id="">
							<div class="text">Частное лицо</div>
						</label>
						<label>
							<input type="radio" name="choose" id="">
							<div class="text">Компания</div>
						</label>
					</div>
					<div class="items objects">
					<?php for($i = 0; $i < 50; $i++): ?>
						<div class="item">
							<div class="photo">
								<i class="fa fa-heart" aria-hidden="true"></i>
								<img src="img/tests/two.png" alt="">
							</div>
							<div class="title">
								<a href="#">Частный дом 1</a>
							</div>
							<div class="cost">1 200 000 рублей</div>
							<div class="desc">Lorem ipsum dolor sit amet, consectetur</div>
							<div class="time">Сегодня в 07:32</div>
						</div>
					<?php endfor; ?>
					</div>
					<div class="btn">Показать еще объявления</div>
				</div>
			</div>
		</section>
		</main>
<?php 	include 'components/footer.php'; ?>
