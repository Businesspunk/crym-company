<?php include 'components/header.php'; ?>
	<main>
		<?php include 'components/category.php'; ?>
		<section class="single_home">
			<div class="container">
				<div class="left">
					<div class="main">
						<div class="first_line">
							<div class="title">2-к квартира, 44 м², 1/5 эт.</div>
							<a href="" class="like">
								<i class="fa fa-heart" aria-hidden="true"></i>
							</a>
						</div>
						<div class="second_line">
							Размещено сегодня в 11:30
						</div>
						<div class="third_line cost">5 600 000р.</div>
						<div class="fourth_line views">
							<i class="fa fa-eye"></i>
							<div class="number">506</div>
						</div>
						<div class="big_photo">
							<img src="img/tests/single-big.png" alt="">
						</div>
						<div class="small_photos">
							<?php for($i = 0; $i < 8; $i++): ?>
								<img src="img/tests/single-big.png" alt="">
							<?php endfor; ?>
						</div>
						<div class="fifth_line">
							<div class="item">
								<div class="de">Этаж:</div>
								<div class="info">1</div>
							</div>
							<div class="item">
								<div class="de">Этажей в доме:</div>
								<div class="info">5</div>
							</div>
							<div class="item">
								<div class="de">Тип дома:</div>
								<div class="info">кирпичный</div>
							</div>
							<div class="item">
								<div class="de">Количество комнат:</div>
								<div class="info">2</div>
							</div>
							<div class="item">
								<div class="de">Общая площадь:</div>
								<div class="info">46</div>
							</div>
						</div>
						<div class="six_line">
							<div class="addr">
								<div class="de">Адрес:</div>
								<div class="info">Санкт-Петербург, улица Орджоникидзе, 10</div>
							</div>
							<div class="map">
								<a href="#" class="btn">Показать карту</a>
							</div>
						</div>
						<div class="seven_line">
							<div class="de">Описание:</div>
							<div class="info">
								Предлагается к продаже уютная квартира в пяти минутах ходьбы от м. Московская. Идеальна как для жизни, так и для сдачи в аренду. Район с развитой инфраструктурой, рядом с домом (во дворе) находятся теннисный корт, спортивная площадка, площадка с тренажерами, хоккейная коробка, 2 детских площадки, благоустроенный сквер. В квартире кухня и комната объединены в единое пространство + отдельная комната, в нашем решении детская. В детской выдвижная кровать + место для хранения, подиум с рабочей зоной, гардеробная. В гостиной кондиционер, кухня встроенная, посудомоечная машина, плита, духовой шкаф. В коридоре теплый пол. Все остается новым хозяевам. Любые вопросы по телефону. Реальному покупателю хорошая скидка.
							</div>
						</div>
					</div>
				</div>
					<div class="right">
						<div class="sticky">
							<a href="#" class="blue_btn btn">Показать телефон</a>
							<a href="#" class="gray_btn btn">Написать сообщение</a>
							<?php include 'components/people.php'; ?>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="left">
						<div class="add_info">
							<div class="eight_line">
								<div class="social">
									<a href="#"><img src="img/icons/facebook.png" alt=""></a>
									<a href="#"><img src="img/icons/instagram.png" alt=""></a>
									<a href="#"><img src="img/icons/ok.png" alt=""></a>
									<a href="#"><img src="img/icons/twitter.png" alt=""></a>
									<a href="#"><img src="img/icons/vk.png" alt=""></a>
								</div>
								<div class="report">
									<a href="#" class="info">Пожаловаться</a>
								</div>
							</div>
							<div class="simmilar_posts">
								<div class="h4">Похожие объявления</div>
								<div class="items objects">
								<?php for($i = 0; $i < 12; $i++): ?>
									<div class="item">
										<div class="photo">
											<i class="fa fa-heart" aria-hidden="true"></i>
											<img src="img/tests/two.png" alt="">
										</div>
										<div class="title">
											<a href="single-post.php">Частный дом 1</a>
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
					</div>
					<div class="right">
						
					</div>
				</div>
				
			</div>
		</section>
	</main>
<?php include 'components/footer.php'; ?>