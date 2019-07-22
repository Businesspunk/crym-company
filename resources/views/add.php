<?php include "components/header.php"; ?>
<main>
<form class="added_post" action="">
	<section class="add">
		<div class="container">
				<div class="header">
					<div class="left">
						<img class="logo_photo" src="img/logo.png" alt="">
					</div>
					<div class="right">Новое объявление</div>
				</div>
				<div class="choose_cat">
					<div class="title_m">Выберите категорию</div>
					<div class="second_container">
						<div class="wrap left_s">
							<div class="left ui_shadow">
								<ul>
									<li class="title">Недвижимость</li>
									<li class="select">
										<label>
											<input type="radio" name="added_main_cat" id="">
											<div class="text">Продажа</div>
										</label>
									</li>
									<li class="select">
										<label>
											<input type="radio" name="added_main_cat" id="">
											<div class="text">Аренда / Сдам</div>
										</label>
									</li>
									<li class="select">
										<label>
											<input type="radio" name="added_main_cat" id="">
											<div class="text">Аренда / Сниму</div>
										</label>
									</li>
								</ul>
								<ul>
									<li class="title">Ремонт и строительство</li>
									<li class="select">
										<label>
											<input type="radio" name="added_main_cat" id="">
											<div class="text">Продажа</div>
										</label>
									</li>
									<li class="select">
										<label>
											<input type="radio" name="added_main_cat" id="">
											<div class="text">Аренда</div>
										</label>
									</li>
									<li class="select">
										<label>
											<input type="radio" name="added_main_cat" id="">
											<div class="text">Услуги</div>
										</label>
									</li>
								</ul>
								<ul>
									<li class="title">Ландшафт, озеленение, благоустройство</li>
									<li class="select">
										<label>
											<input type="radio" name="added_main_cat" id="">
											<div class="text">Продажа</div>
										</label>
									</li>
									<li class="select">
										<label>
											<input type="radio" name="added_main_cat" id="">
											<div class="text">Услуги</div>
										</label>
									</li>
								</ul>
							</div>
							<div class="right ui_shadow">
								<ul>
									<li class="select">
										<label>
											<input type="radio" name="second_main_cat" id="">
											<div class="text">Квартиру ( 1,2,3,4 и более)</div>
										</label>
									</li>
									<li class="select">
										<label>
											<input type="radio" name="second_main_cat" id="">
											<div class="text">Комнату </div>
										</label>
									</li>
									<li class="select">
										<label>
											<input type="radio" name="second_main_cat" id="">
											<div class="text">Дома, дачи, коттеджи, земельный участок </div>
										</label>
									</li>
									<li class="select">
										<label>
											<input type="radio" name="second_main_cat" id="">
											<div class="text">Гараж и машиноместа  </div>
										</label>
									</li>
									<li class="select">
										<label>
											<input type="radio" name="second_main_cat" id="">
											<div class="text">Коммерческая недвижимость</div>
										</label>
									</li>
								</ul>
							</div>
						</div>
						<div class="right_s"></div>
					</div>
				</div>
		</div>
	</section>
	<section class="add_choose">
		<div class="container">
			<div class="wrap">
				<div class="left">
					Кто разместил
				</div>
				<div class="right">
					<div class="choosen">
						<label>
							<input type="radio" name="choose" id="">
							<div class="text">Собственник</div>
						</label>
						<label>
							<input type="radio" name="choose" id="">
							<div class="text">Агенство</div>
						</label>
					</div>
				</div>
			</div>
			<div class="wrap period">
				<div class="left">
					Срок владения
				</div>
				<div class="right">
					<input type="text">
				</div>
			</div>
			<div class="wrap local">
				<div class="left">
					Месторасположение
				</div>
				<div class="right">
					<div class="second_wr">
						<input type="text" placeholder="Введите адрес">
						<i class="fa fa-search" aria-hidden="true"></i>
					</div>
					<div class="map_block">
						<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A30be4394b4264e223f7e0dcd4bdd6de0cedfaf554feeffbc39281ca1fd71c784&amp;width=100%25&amp;height=300&amp;lang=ru_RU&amp;scroll=false"></script>
					</div>
				</div>
			</div>
			<div class="wrap name">
				<div class="left">
					Название объявления
				</div>
				<div class="right">
					<input type="text" placeholder="Название">
				</div>
			</div>
			<div class="wrap email">
				<div class="left">
					Электронная почта
				</div>
				<div class="right">
					<input type="text" placeholder="@">
				</div>
			</div>
			<div class="wrap tel">
				<div class="left">
					Телефон
				</div>
				<div class="right">
					<input type="text" placeholder="Введите телефон">
				</div>
			</div>
			<div class="wrap type_connection">
				<div class="left">
					Способ связи
				</div>
				<div class="right">
					<label class="ui_radio">
						<input name="type_of_connection" type="radio">
						<span class="ch">
							<span class="active"></span>
						</span>
						<span class="text">По телефону и в сообщениях</span>
					</label>
					<label class="ui_radio" >
						<input name="type_of_connection" type="radio">
						<span class="ch">
							<span class="active"></span>
						</span>
						<span class="text">По телефону</span>
					</label>
					<label class="ui_radio">
						<input name="type_of_connection" type="radio">
						<span class="ch"><span class="active"></span></span>
						<span class="text">В сообщениях</span>
					</label>
				</div>
			</div>
			<div class="wrap desc">
				<div class="left">
					Описание
				</div>
				<div class="right">
					<textarea placeholder="Опишите объект" rows="10"></textarea>
				</div>
			</div>
		</div>
	</section>
	<section class="add_choose">
		<div class="divider"> <div class="line"></div> </div>
		<div class="container">
		<div class="title">Параметры дома</div>
		<div class="subtitle">Основные</div>
			<div class="wrap typeHouse">
				<div class="left">
					Тип квартиры
				</div>
				<div class="right">
					<select class="add_post">
						<option value="">Не выбрано</option>
						<option value="">Не выбрано 2</option>
						<option value="">Не выбрано 3</option>
						<option value="">Не выбрано 4</option>
					</select>
				</div>
			</div>
			<div class="wrap yearsOfBuilding">
				<div class="left">
					Год постройки
				</div>
				<div class="right">
					<input type="text">
				</div>
			</div>
			<div class="wrap typeBuilding">
				<div class="left">
					Тип дома
				</div>
				<div class="right">
					<select class="add_post">
						<option value="">Не выбрано</option>
						<option value="">Не выбрано 2</option>
						<option value="">Не выбрано 3</option>
						<option value="">Не выбрано 4</option>
					</select>
				</div>
			</div>
			<div class="wrap lifts">
				<div class="left">
					Лифты
				</div>
				<div class="right">
					<select class="add_post">
						<option value="">Не выбрано</option>
						<option value="">Не выбрано 2</option>
						<option value="">Не выбрано 3</option>
						<option value="">Не выбрано 4</option>
					</select>
				</div>
			</div>

			<div class="subtitle">Дополнительные</div>
			<div class="wrap infr">
				<div class="left">
					Инфраструктура
				</div>
				<div class="right">
					<select class="add_post">
						<option value="">Не выбрано</option>
						<option value="">Не выбрано 2</option>
						<option value="">Не выбрано 3</option>
						<option value="">Не выбрано 4</option>
					</select>
				</div>
			</div>
		</div>
		<div class="divider"> <div class="line"></div> </div>
		<div class="container">
			<div class="title">Параметры квартиры</div>
			<div class="subtitle">Основные</div>

			<div class="wrap rooms">
				<div class="left">
					Комнат в квартире
				</div>
				<div class="right">
					<select class="add_post">
						<option value="">Не выбрано</option>
						<option value="">Не выбрано 2</option>
						<option value="">Не выбрано 3</option>
						<option value="">Не выбрано 4</option>
					</select>
				</div>
			</div>

			<div class="wrap floor">
				<div class="left">
					Этаж
				</div>
				<div class="right">
					<input type="text">
				</div>
			</div>

			<div class="wrap floors">
				<div class="left">
					Этажность дома
				</div>
				<div class="right">
					<input type="text">
				</div>
			</div>

			<div class="subtitle">Площадь</div>
			
			<div class="wrap square">
				<div class="left">
					Общая площадь
				</div>
				<div class="right">
					<input type="text">
					<div class="sup">м<sup>2</sup> </div>
				</div>
			</div>
			<div class="wrap square">
				<div class="left">
					Жилая площадь
				</div>
				<div class="right">
					<input type="text">
					<div class="sup">м<sup>2</sup> </div>

				</div>
			</div>
			<div class="wrap square">
				<div class="left">
					Площадь кухни
				</div>
				<div class="right">
					<input type="text">
					<div class="sup">м<sup>2</sup> </div>

				</div>
			</div>
			<div class="subtitle">Дополнительные</div>
			<div class="wrap height">
				<div class="left">
					Высота потолка
				</div>
				<div class="right">
					<input type="text">
				</div>
			</div>
			<div class="wrap update">
				<div class="left">
					Ремонт
				</div>
				<div class="right">
					<select class="add_post">
						<option value="">Не выбрано</option>
						<option value="">Не выбрано 2</option>
						<option value="">Не выбрано 3</option>
						<option value="">Не выбрано 4</option>
					</select>
				</div>
			</div>
			<div class="wrap update">
				<div class="left">
					Санузлы
				</div>
				<div class="right">
					<select class="add_post">
						<option value="">Не выбрано</option>
						<option value="">Не выбрано 2</option>
						<option value="">Не выбрано 3</option>
						<option value="">Не выбрано 4</option>
					</select>
				</div>
			</div>
			<div class="wrap update">
				<div class="left">
					Балкон
				</div>
				<div class="right">
					<select class="add_post">
						<option value="">Не выбрано</option>
						<option value="">Не выбрано 2</option>
						<option value="">Не выбрано 3</option>
						<option value="">Не выбрано 4</option>
					</select>
				</div>
			</div>

		</div>
		<div class="divider"> <div class="line"></div> </div>
		<div class="container">
			<div class="wrap photo">
				<div class="left">
					Фотографии
				</div>
				<div class="right">
					<div class="notice">Перетащите фото сюда или <span class="blue">выберите их на своем компьютере</span></div>
					<div class="wrap_m">
						<div class="item">
							<i class="fa fa-camera" aria-hidden="true"></i>
							<div class="text">Добавить</div>
						</div>
					</div>
					<div class="desc">
						Первое фото будет отображаться в результатах поиска, выберите наиболее удачное.
						Вы можете загрузить до 20 фотографий в формате JPG или PNG.
						Максимальный размер фото — 25MB.
					</div>
				</div>
			</div>
			<div class="wrap youtube">
				<div class="left">
					Видео с YouTube
				</div>
				<div class="right">
					<input type="text" placeholder="Вставьте ссылку">
				</div>
			</div>
		</div>
		<div class="divider"> <div class="line"></div> </div>
		<div class="container service">
			<div class="title">Услуги продвижения</div>
			<div class="desc">Сравните и выберите услуги продвижения, если вы хотите ускорить продажу</div>
			<div class="table desktop">
				<div class="row">
					<div class="button">
					</div>
					<div class="photo"></div>
					<div class="main_info">
						
					</div>
					<div class="exist">
						<div class="type">
							Блок «Премиум»
						</div>
						<div class="desc">
							Первые строчки результатов поиска
						</div>
					</div>
					<div class="exist">
						<div class="type">
							Блок «VIP»
						</div>
						<div class="desc">
							Промоблок в результатах поиска
						</div>
					</div>
					<div class="result">
						Первое место в результатах поиска
					</div>
				</div>
				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input checked name="typePR" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo"></div>
					<div class="main_info">
						<div class="tit">
							Без продвижения
						</div>
						<div class="cost">0 руб</div>
					</div>
					<div class="exist"><span class="not"></span></div>
					<div class="exist"><span class="not"></span></div>
					<div class="result">1 раз</div>
				</div>
				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typePR" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo">
						<img src="img/icons/service-1.png" alt="">
					</div>
					<div class="main_info">
						<div class="tit">
							VIP-размещение
						</div>
						<div class="cost">139 руб</div>
					</div>
					<div class="exist">
						<span class="not"></span>
					</div>
					<div class="exist"><i class="fa fa-check" aria-hidden="true"></i></div>
					<div class="result">1 раз</div>
				</div>
				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typePR" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo">
						<img src="img/icons/service-2.png" alt="">
					</div>
					<div class="main_info">
						<div class="tit">
							Премиум
						</div>
						<div class="cost">250 руб</div>
					</div>
					<div class="exist"><i class="fa fa-check" aria-hidden="true"></i></div>
					<div class="exist"><span class="not"></span></div>
					<div class="result">1 раз</div>
				</div>
				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typePR" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo">
						<img src="img/icons/service-3.png" alt="">
					</div>
					<div class="main_info">
						<div class="tit">
							Быстрая продажа
						</div>
						<div class="cost">329 руб</div>
					</div>
					<div class="exist"><span class="not"></span></div>
					<div class="exist"><i class="fa fa-check" aria-hidden="true"></i></div>
					<div class="result">
						<p>4 раза</p>
						<p>Каждые 48 часов</p>
					</div>
				</div>
				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typePR" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo">
						<img src="img/icons/service-4.png" alt="">
					</div>
					<div class="main_info">
						<div class="tit">
							Турбо-продажа
						</div>
						<div class="cost">539 руб</div>
					</div>
					<div class="exist"><i class="fa fa-check" aria-hidden="true"></i></div>
					<div class="exist"><i class="fa fa-check" aria-hidden="true"></i></div>
					<div class="result">
						<p>7 раз</p>
						<p>Каждые 24 часа</p>
					</div>
				</div>
			</div>

			<div class="table mobile">
				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input checked name="typePR" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo"></div>
					<div class="main_info">
						<div class="tit">
							Без продвижения
						</div>
						<div class="cost">0 руб</div>
					</div>
					<div class="icon_wrap">
						<i class="fa fa-angle-up" aria-hidden="true"></i>
					</div>
				</div>
				<div class="added_info">
					<div class="item">
						<div class="bolder">
							Первое место в результатах поиска: 
						</div>
						<div class="norm">
							1 раз
						</div>
					</div>
				</div>


				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typePR" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo">
						<img src="img/icons/service-1.png" alt="">
					</div>
					<div class="main_info">
						<div class="tit">
							VIP-размещение
						</div>
						<div class="cost">139 руб</div>
					</div>
					<div class="icon_wrap">
						<i class="fa fa-angle-up" aria-hidden="true"></i>
					</div>
				</div>
				<div class="added_info">
					<div class="item">
						<div class="bolder">
							Первое место в результатах поиска: 
						</div>
						<div class="norm">
							1 раз
						</div>
					</div>
					<div class="item">
						<div class="bolder">
							Блок «VIP».  
						</div>
						<div class="norm">
							Промоблок в результатах поиска
						</div>
					</div>
				</div>


				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typePR" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo">
						<img src="img/icons/service-2.png" alt="">
					</div>
					<div class="main_info">
						<div class="tit">
							Премиум
						</div>
						<div class="cost">250 руб</div>
					</div>
					<div class="icon_wrap">
						<i class="fa fa-angle-up" aria-hidden="true"></i>
					</div>
				</div>
				<div class="added_info">
					<div class="item">
						<div class="bolder">
							Первое место в результатах поиска: 
						</div>
						<div class="norm">
							1 раз
						</div>
					</div>
					<div class="item">
						<div class="bolder">
							Блок «Премиум». 
						</div>
						<div class="norm">
							Первые строчки результатов поиска
						</div>
					</div>
				</div>



				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typePR" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo">
						<img src="img/icons/service-3.png" alt="">
					</div>
					<div class="main_info">
						<div class="tit">
							Быстрая продажа
						</div>
						<div class="cost">329 руб</div>
					</div>
					<div class="icon_wrap">
						<i class="fa fa-angle-up" aria-hidden="true"></i>
					</div>

				</div>
				<div class="added_info">
					<div class="item">
						<div class="bolder">
							Первое место в результатах поиска: 
						</div>
						<div class="norm">
							4 раза. Каждые 48 часов
						</div>
					</div>
					<div class="item">
						<div class="bolder">
							Блок «VIP».  
						</div>
						<div class="norm">
							Промоблок в результатах поиска
						</div>
					</div>
				</div>




				<div class="row">
					<div class="button">
						<label class="ui_radio">
							<input name="typePR" type="radio">
							<span class="ch"><span class="active"></span></span>
						</label>
					</div>
					<div class="photo">
						<img src="img/icons/service-4.png" alt="">
					</div>
					<div class="main_info">
						<div class="tit">
							Турбо-продажа
						</div>
						<div class="cost">539 руб</div>
					</div>
					<div class="icon_wrap">
						<i class="fa fa-angle-up" aria-hidden="true"></i>
					</div>
				</div>
				<div class="added_info">
					<div class="item">
						<div class="bolder">
							Первое место в результатах поиска: 
						</div>
						<div class="norm">
							7 раз. Каждые 24 часа
						</div>
					</div>
					<div class="item">
						<div class="bolder">
							Блок «Премиум». 
						</div>
						<div class="norm">
							Первые строчки результатов поиска
						</div>
					</div>
					<div class="item">
						<div class="bolder">
							Блок «VIP».  
						</div>
						<div class="norm">
							Промоблок в результатах поиска
						</div>
					</div>
				</div>



			</div>
			<div class="total">
				<div class="btn">
					<a href="#">Далее <span class="line"></span></a>
				</div>
				<div class="cost">
					Итого: <div class="num">0 руб.</div>
				</div>
			</div>
		</div>
	</section>
</form>
</main>
<?php include 'components/footer.php'; ?>