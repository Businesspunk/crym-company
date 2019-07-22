<?php include "components/header.php"; ?>
<main>
	<?php $activePage = 'my-messages.php'; ?>
	<?php include 'components/profile-menu.php'; ?>
	<section class="my-messages">
		<div class="container">
			<div class="h4">Диалоги</div>

			<div class="dialog">
				<div class="left">
					<div class="spacer"></div>
					<?php for( $i = 0; $i < 4; $i++ ): ?>
						<a class="itemDialogMenu" data-eq="<?= $i; ?>" href="#">
							<div class="photo">
								<img src="img/tests/account.jpg" alt="">
							</div>
							<div class="info">
								<div class="name">
									Никита Казакевич
								</div>
								<div class="last_m">
									Последнее сообщение
								</div>
							</div>
							<div class="date">
								Вчера, 20:15
							</div>
							<div class="img">
								<img src="img/tests/two.png" alt="">
							</div>	
						</a>
					<?php endfor; ?>
					<div class="spacer"></div>
				</div>
				<div class="right">
					<div class="messages">
						<div class="messages_wrap">
							<?php for($i = 0; $i < 4; $i++): ?>
								<div data-eq="<?= $i ?>" class="ms_www">
									<div class="message">
										<div class="head">
											<div class="photo">
												<img src="img/tests/two.png" alt="">
											</div>
											<div class="info">
												<div class="title">
													2х комнатная квартира
												</div>
												<div class="cost">
													2 000 000 рублей
												</div>
											</div>
											<div class="showMenuDialog">
												<div class="cir"></div>
												<div class="cir"></div>
												<div class="cir"></div>
											</div>
										</div>	
										<div class="body">
											<div class="me mes">
												<div class="mes_wrap">
													<div class="info">
														<div class="text">Здравсвуйте, можно узнать по подробнее о квартире? </div>
														<div class="time">19:58</div>
													</div>
													<img class="acc_img" src="img/tests/account.jpg" alt="">
												</div>
											</div>
									
											<div class="other mes">
												<div class="mes_wrap">
													<img class="acc_img" src="img/tests/account.jpg" alt="">
													<div class="info">
														<div class="text">
															Здравсвуйте, да ,конечно, можно созвониться и я вам расскажу обо всем, что вас интересует 
														</div>
														<div class="time">19:59</div>
													</div>
												</div>
											</div>
										</div>
										<div class="bottom">
											<form action="">
												<input type="hidden" name="forWhom">
												<div class="wrap_text">
													<label class="phot">
														<i class="fa fa-camera" aria-hidden="true"></i>
														<input class="file" type="file">
													</label>
													<textarea rows="2" class="ms_s" name="message"></textarea>
													<label class="send">
														<i class="fa fa-paper-plane" aria-hidden="true"></i>
														<input class="send_m" type="submit">
													</label>
												</div>
											</form>
										</div>
									</div>
								</div>
							<?php endfor; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php include "components/footer.php"; ?>