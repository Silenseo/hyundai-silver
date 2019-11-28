<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<style href>
		a {color: #2dbbea;text-decoration: underline;}
		a.link-white {color: #fff;text-decoration: underline;}
	</style>
</head>
<body style="margin: 0; padding: 0; font-size: 17px; font-family: Arial, sans-serif;
 line-height: 26px; color: #000; background-color: #dddddd;">
<table width="100%" align="center" cellpadding="0" cellspacing="0" style="background-color: #dddddd;border-collapse:collapse;
 border:none;  margin:0;">
	<tr>
		<td border="0" align="center" style="border:none; padding:0;margin: 0;">
			<table width="800" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse;
 border:none; background-color: #ffffff; margin-top:50px; margin-bottom:50px;">
				<tr>
					<td border="0" align="left" style="background: #ffffff; border:none; text-align: left; vertical-align: middle;
		 padding-top:28px; padding-bottom:0;padding-left: 50px;padding-right: 50px;">
						<table width="700" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse;
				 background-color: #fff;margin: 0;">
							<tr>
								<td border="0" align="left" style="background: #ffffff; border: 0;padding-left: 0;padding-right: 0;text-align: left;padding-bottom: 13px;font-family: Arial, sans-serif;">
									<a href="http://hyundai.ru" target="_blank" style="text-decoration: none; line-height: 0;"><img width="340" height="46" border="0" src="http://<?=$_SERVER['HTTP_HOST']?>/media/mail/img/logo.jpg" alt=""/></a>
								</td>
								<td border="0" align="right" style="vertical-align: middle;background: #ffffff; border: 0;padding-left: 0;padding-right: 0;padding-top:1px;text-align: right;padding-bottom: 13px;font-family: Arial, sans-serif;">
									<a href="https://www.facebook.com/HyundaiRussia" target="_blank" style="text-decoration: none; line-height: 0;"><img width="24" height="24" border="0" src="http://<?=$_SERVER['HTTP_HOST']?>/media/mail/img/social_02.jpg" alt=""/></a>
									<a href="https://vk.com/HyundaiRussia" target="_blank" style="text-decoration: none; line-height: 0;"><img width="24" height="24" border="0" src="http://<?=$_SERVER['HTTP_HOST']?>/media/mail/img/social_04.jpg" alt=""/></a>
									<a href="https://twitter.com/HyundaiRussia" target="_blank" style="text-decoration: none; line-height: 0;"><img width="24" height="24" border="0" src="http://<?=$_SERVER['HTTP_HOST']?>/media/mail/img/social_06.jpg" alt=""/></a>
									<a href="http://instagram.com/HyundaiRussia" target="_blank" style="text-decoration: none; line-height: 0;"><img width="24" height="24" border="0" src="http://<?=$_SERVER['HTTP_HOST']?>/media/mail/img/social_08.jpg" alt=""/></a>
									<a href="http://www.youtube.com/hyundairussia" target="_blank" style="text-decoration: none; line-height: 0;"><img width="24" height="24" border="0" src="http://<?=$_SERVER['HTTP_HOST']?>/media/mail/img/social_10.jpg" alt=""/></a>
									<a href="http://hyundai.ru" target="_blank" style="text-decoration: none; line-height: 0;"><img width="24" height="24" border="0" src="http://<?=$_SERVER['HTTP_HOST']?>/media/mail/img/social_12.jpg" alt=""/></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td border="0" align="center" style="background: #ffffff; border:none; text-align: center; vertical-align: middle;
		 padding-top:7px; padding-bottom:7px;padding-left: 50px;padding-right: 50px;">
						<img width="700" height="1" border="0" src="http://<?=$_SERVER['HTTP_HOST']?>/media/mail/img/line.jpg" alt=""/>
					</td>
				</tr>
				<tr>
					<td border="0" align="left" style="background: #ffffff; border: 0;padding-top: 40px;padding-left: 50px;padding-right: 50px;text-align: left;padding-bottom: 36px;font-family: Arial, sans-serif;">
						<p style="font-size: 30px;font-weight: bold; color:#303030; line-height: 32px; font-family: Arial, sans-serif;
			 padding:0; margin:0;margin-bottom: 26px;text-align: left;">Здравствуйте, <?=$data['name'];?>!</p>
						<p style="font-size: 17px; color:#000; line-height: 26px; font-family: Arial, sans-serif;
			 padding:0; margin:0;text-align: left;">Рады, что Вы воспользовались
				 <? if($startPlus) :?>
				 <a href="http://<?=$_SERVER['HTTP_HOST'];?>/start_plus" target="_blank" style="text-decoration: underline !important; font-weight: normal;color: #2dbbea !important;">программой «Старт Плюс»</a>
				 <? else :?>
				 <a href="http://<?=$_SERVER['HTTP_HOST'];?>/start" target="_blank" style="text-decoration: underline !important; font-weight: normal;color: #2dbbea !important;">программой «Старт»</a>
				 <? endif; ?>
				 , которая позволит наслаждаться ездой на новом автомобиле без больших ежемесячных взносов.</p>
					</td>
				</tr>
				<tr>
					<td border="0" align="center" style="background: #ffffff; border: 0;padding-top:0; padding-bottom:41px;padding-left: 50px;padding-right: 50px;text-align: left;vertical-align: top;">
						<table width="700" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse;
				 background-color: #fff;margin: 0;">
							<tr>
								<td width="350" border="0" align="center" valign="middle" style="border:none;
					 background: #fff;text-align: center;vertical-align: top;padding-top: 0;">
									<a href="http://<?=$_SERVER['HTTP_HOST']?><?=$cars[(int)$data['carid']]['URL'];?>" target="_blank" style="text-decoration: none; line-height: 0;"><img width="350" height="230" border="0" src="http://<?=$_SERVER['HTTP_HOST']?><?=$cars[(int)$data['carid']]['IMG'];?>" alt=""/></a>
								</td>
								<td width="300" border="0" align="center" valign="middle" style="border:none;
					 background: #fff;padding-left: 50px;padding-top: 28px;text-align: left;vertical-align: top;">
									<p style="text-transform: uppercase;font-size: 17px; color:#c3c3c3; font-weight: bold;line-height: 26px; font-family: Arial, sans-serif;
			 padding:0; margin:0;margin-bottom: 29px;text-align: left;">Ваш автомобиль</p>
									<table width="300" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse;
				 background-color: #fff;margin: 0;">
										<tr>
											<td width="140" border="0" align="left" valign="top" style="border:none;
					 background: #fff;text-align: left;vertical-align: top; font-size: 14px; color:#303030; font-weight: bold;line-height: 18px; font-family: Arial, sans-serif;
			 padding:0;padding-bottom: 22px; margin:0;">Модель:</td>
											<td width="160" border="0" align="left" valign="top" style="border:none;
					 background: #fff;text-align: left;vertical-align: top; font-size: 17px; color:#000; line-height: 18px; font-family: Arial, sans-serif;
			 padding:0;padding-bottom: 22px; margin:0;">
				 								<a href="http://<?=$_SERVER['HTTP_HOST']?><?=$cars[(int)$data['carid']]['URL'];?>" target="_blank" style="text-decoration: underline !important; font-weight: normal;color: #2dbbea !important;"><?=$cars[(int)$data['carid']]['NAME'];?></a><?if($cars[(int)$data['carid']]['TYPE'] != '') :?> / <?=$cars[(int)$data['carid']]['TYPE'];?><? endif; ?>
										</tr>
										<tr>
											<td width="140" border="0" align="left" valign="top" style="border:none;
					 background: #fff;text-align: left;vertical-align: top; font-size: 14px; color:#303030; font-weight: bold;line-height: 18px; font-family: Arial, sans-serif;
			 padding:0;padding-bottom: 22px; margin:0;">Модификация:</td>
											<td width="160" border="0" align="left" valign="top" style="border:none;
					 background: #fff;text-align: left;vertical-align: top; font-size: 17px; color:#000; line-height: 18px; font-family: Arial, sans-serif;
			 padding:0;padding-bottom: 22px; margin:0;"><?=$data['mod'];?></td>
										</tr>
										<tr>
											<td width="140" border="0" align="left" valign="top" style="border:none;
					 background: #fff;text-align: left;vertical-align: top; font-size: 14px; color:#303030; font-weight: bold;line-height: 18px; font-family: Arial, sans-serif;
			 padding:0;padding-bottom: 22px; margin:0;">Комплектация:</td>
											<td width="160" border="0" align="left" valign="top" style="border:none;
					 background: #fff;text-align: left;vertical-align: top; font-size: 17px; color:#000; line-height: 18px; font-family: Arial, sans-serif;
			 padding:0;padding-bottom: 22px; margin:0;"><?=$data['compl'];?></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td border="0" align="center" style="background: #1f9be1; border: 0;padding-top:41px; padding-bottom:39px;padding-left: 50px;padding-right: 50px;text-align: left;vertical-align: top;">
						<table width="700" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse;
				 background-color: #1f9be1;margin: 0;">
							<tr>
								<td width="350" border="0" align="center" valign="top" style="border:none;
					 background: #1f9be1;text-align: left;vertical-align: top;padding-top: 0;">
									<p style="font-size: 15px;font-weight: bold; color:#000000; line-height: 18px; font-family: Arial, sans-serif;
			 padding:0; margin:0;margin-bottom: 32px;text-align: left;">Условия программы «Старт»</p>
									<table width="350" align="left" cellpadding="0" cellspacing="0" style="border-collapse:collapse;
				 background-color: #1f9be1;margin: 0;">
					 					<tr>
											<td width="200" border="0" align="left" valign="top" style="border:none;
					 background: #1f9be1;text-align: left;vertical-align: top; font-size: 15px; color:#000; line-height: 18px; font-family: Arial, sans-serif;
			 padding:0;padding-right: 10px;padding-bottom: 22px; margin:0;">Стоимость автомобиля:</td>
											<td width="140" border="0" align="left" valign="top" style="border:none;
					 background: #1f9be1;text-align: left;vertical-align: top; font-size: 17px; color:#fff; line-height: 18px;font-weight: bold; font-family: Arial, sans-serif;
			 padding:0;padding-bottom: 22px; margin:0;">

				 <?=$data['sum'];?> Р</td>
										</tr>
										<tr>
											<td width="200" border="0" align="left" valign="top" style="border:none;
					 background: #1f9be1;text-align: left;vertical-align: top; font-size: 15px; color:#000; line-height: 18px; font-family: Arial, sans-serif;
			 padding:0;padding-right: 10px;padding-bottom: 22px; margin:0;">Первоначальный взнос:</td>
											<td width="140" border="0" align="left" valign="top" style="border:none;
					 background: #1f9be1;text-align: left;vertical-align: top; font-size: 17px; color:#fff; line-height: 18px;font-weight: bold; font-family: Arial, sans-serif;
			 padding:0;padding-bottom: 22px; margin:0;">
				 <? if($data['prepay'] == 41 && str_replace(' ', '', $data['pay']) == 6000) $data['prepay'] = '41.39'; ?>
				 <?=$data['prepay'];?>% (<?=number_format($data['prepay_rub'], 0, '', ' ')?> Р)</td>
										</tr>
										<tr>
											<td width="200" border="0" align="left" valign="top" style="border:none;
					 background: #1f9be1;text-align: left;vertical-align: top; font-size: 15px; color:#000; line-height: 18px; font-family: Arial, sans-serif;
			 padding:0;padding-right: 10px;padding-bottom: 22px; margin:0;">Срок:</td>
											<td width="140" border="0" align="left" valign="top" style="border:none;
					 background: #1f9be1;text-align: left;vertical-align: top; font-size: 17px; color:#fff; line-height: 18px;font-weight: bold; font-family: Arial, sans-serif;
			 padding:0;padding-bottom: 22px; margin:0;"><?=$data['term'];?> месяц<?=$data['term'] == 24 ? 'а' : 'ев';?></td>
										</tr>
										<? if($startPlus) :?>
										<tr>
											<td width="200" border="0" align="left" valign="top" style="border:none;
					 background: #1f9be1;text-align: left;vertical-align: top; font-size: 15px; color:#000; line-height: 18px; font-family: Arial, sans-serif;
			 padding:0;padding-right: 10px;padding-bottom: 22px; margin:0;">Стоимость КАСКО и ТО:</td>
											<td width="140" border="0" align="left" valign="top" style="border:none;
					 background: #1f9be1;text-align: left;vertical-align: top; font-size: 17px; color:#fff; line-height: 18px;font-weight: bold; font-family: Arial, sans-serif;
			 padding:0;padding-bottom: 22px; margin:0;"><?=number_format($data['addCost'], 0, '', ' ')?> Р</td>
										</tr>
										<? endif; ?>
									</table>
								</td>
								<td width="300" border="0" align="center" valign="middle" style="border:none; border-left: 1px solid #3dadec;
					 background: #1f9be1;padding-left: 50px;padding-top: 0;text-align: left;vertical-align: top;">
									<p style="font-size: 15px;font-weight: bold; color:#000000; line-height: 18px; font-family: Arial, sans-serif;
			 padding:0; margin:0;margin-bottom: 23px;text-align: left;">Ежемесячный платеж составит:</p>
									<span style="font-size: 72px;font-weight: bold; color:#fff; line-height: 72px; font-family: Arial, sans-serif;
			 padding:0; margin:0;text-align: left;"><?=$data['pay'];?></span>
									<span style="font-size: 20px;font-weight: bold; color:#fff; line-height: 20px; font-family: Arial, sans-serif;
			 padding:0; margin:0;text-align: left;">рублей</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td border="0" align="left" style="background: #ffffff; border: 0;padding-top: 33px;padding-left: 50px;padding-right: 50px;text-align: left;padding-bottom: 51px;font-family: Arial, sans-serif;">
						<p style="font-size: 15px; color:#c3c3c3; line-height: 23px; font-family: Arial, sans-serif;
			 padding:0; margin:0;margin-bottom: 40px;text-align: left;">По всем вопросам Вы можете обращаться в службу клиентской поддержки Hyundai по телефону
8 800 333-71-67 или заполнить <a href="http://<?=$_SERVER['HTTP_HOST'];?>/ContactUs" target="_blank" style="text-decoration: underline !important; font-weight: normal;color: #2dbbea !important;">форму обратной связи</a> на сайте.</p>
						<p style="font-size: 15px; color:#303030; line-height: 18px; font-weight: bold;font-family: Arial, sans-serif;
			 padding:0; margin:0;text-align: left;">С уважением, Хендэ Мотор СНГ</p>
					</td>
				</tr>
				<tr>
					<td border="0" align="left" style="background: #555555; border:none; text-align: left; vertical-align: middle;
		 padding-top:13px; padding-bottom:12px;padding-left: 50px;padding-right: 50px;">
						<table width="700" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse;
				 background-color: #555555;margin: 0;">
							<tr>
								<td border="0" align="left" style="vertical-align: top;background: #555555; border: 0;padding-left: 0;padding-right: 0;text-align: left;padding-top: 12px;padding-bottom: 13px;font-family: Arial, sans-serif;">
									<p style="font-size: 10px; color:#aaaaaa; line-height: 12px; font-family: Arial, sans-serif;
			 padding:0; margin:0;text-align: left;">© ООО «Хенде Мотор СНГ». Все права защищены.</p>
									<p style="font-size: 10px; color:#aaaaaa; line-height: 12px; font-family: Arial, sans-serif;
			 padding:0; margin:0;text-align: left;"><a class="link-white" href="http://<?=$_SERVER['HTTP_HOST'];?>/Legal" target="_blank" style="text-decoration: underline !important; font-weight: normal;color: #fff !important;">Юридическая информация</a></p>
									<p style="font-size: 10px; color:#aaaaaa; line-height: 12px; font-family: Arial, sans-serif;
			 padding:0; margin:0;text-align: left;">Письмо сгенерировано автоматически.</p>
								</td>
								<td border="0" align="right" style="vertical-align: top;background: #555555; border: 0;padding-left: 0;padding-right: 0;padding-top:5px;text-align: right;padding-bottom: 13px;font-family: Arial, sans-serif;">
									<a href="https://www.facebook.com/HyundaiRussia" target="_blank" style="text-decoration: none; line-height: 0;"><img width="24" height="24" border="0" src="http://<?=$_SERVER['HTTP_HOST']?>/media/mail/img/social_02.jpg" alt=""/></a>
									<a href="https://vk.com/HyundaiRussia" target="_blank" style="text-decoration: none; line-height: 0;"><img width="24" height="24" border="0" src="http://<?=$_SERVER['HTTP_HOST']?>/media/mail/img/social_04.jpg" alt=""/></a>
									<a href="https://twitter.com/HyundaiRussia" target="_blank" style="text-decoration: none; line-height: 0;"><img width="24" height="24" border="0" src="http://<?=$_SERVER['HTTP_HOST']?>/media/mail/img/social_06.jpg" alt=""/></a>
									<a href="http://instagram.com/HyundaiRussia" target="_blank" style="text-decoration: none; line-height: 0;"><img width="24" height="24" border="0" src="http://<?=$_SERVER['HTTP_HOST']?>/media/mail/img/social_08.jpg" alt=""/></a>
									<a href="http://www.youtube.com/hyundairussia" target="_blank" style="text-decoration: none; line-height: 0;"><img width="24" height="24" border="0" src="http://<?=$_SERVER['HTTP_HOST']?>/media/mail/img/social_10.jpg" alt=""/></a>
									<a href="http://hyundai.ru" target="_blank" style="text-decoration: none; line-height: 0;"><img width="24" height="24" border="0" src="http://<?=$_SERVER['HTTP_HOST']?>/media/mail/img/social_12.jpg" alt=""/></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td border="0" align="left" style="background: #333333; border:none; text-align: left; vertical-align: middle;
		 padding-top:13px; padding-bottom:12px;padding-left: 50px;padding-right: 50px;">
						<table width="700" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse;
				 background-color: #333333;margin: 0;">
							<tr>
								<td border="0" align="left" style="vertical-align: top;background: #333333; border: 0;padding-left: 0;padding-right: 0;text-align: left;padding-top: 12px;padding-bottom: 13px;font-family: Arial, sans-serif;">
									<p style="font-size: 10px; color:#aaaaaa; line-height: 12px; font-family: Arial, sans-serif;
			 padding:0; margin:0;text-align: left;">Вы получили это письмо, потому что являетесь владельцем автомобиля Hyundai или дали свое согласие получать информацию от компании Hyundai.
										</p>
									<p style="font-size: 10px; color:#aaaaaa; line-height: 12px; font-family: Arial, sans-serif;
			 padding:0; margin:0;text-align: left;">Не отвечайте, пожалуйста, на это письмо, оно отправлено системой автоматически. По всем вопросам Вы можете обратиться: в Службу Клиентской поддержки Hyundai 8 800 333-71-67,
										<a class="link-white"  href="http://<?=$_SERVER['HTTP_HOST'];?>/ContactUs" target="_blank" style="text-decoration: underline !important; font-weight: normal;color: #fff !important;">заполнить форму обратной связи</a>, или в любой официальный дилерский центр.</p>
									<p style="font-size: 10px; color:#aaaaaa; line-height: 12px; font-family: Arial, sans-serif;
			 padding:0; margin:0;text-align: left;">Оттенки цветов и изображения автомобилей, используемые в рассылке, могут отличаться от реальных.</p>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td border="0" align="center" style="background: #000000; border:none; text-align: center; vertical-align: middle;
		 padding-top:13px; padding-bottom:12px;padding-left: 50px;padding-right: 50px;">
						<table width="700" align="center" cellpadding="0" cellspacing="0" style="border-collapse:collapse;
				 background-color: #000000;margin: 0;">
							<tr>
								<td border="0" align="center" style="vertical-align: top;background: #000; border: 0;padding-left: 0;padding-right: 0;text-align: left;padding-top: 12px;padding-bottom: 13px;font-family: Arial, sans-serif;">
									<p style="font-size: 10px; color:#fff; line-height: 12px; font-family: Arial, sans-serif;
			 padding:0; margin:0;text-align: center;">Hyundai <?=date('Y');?>.</p>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html> 
