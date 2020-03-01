<? /*
event
name
date
time
*/?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <style href>
        a {
            color: #1a85ca;
            text-decoration: underline;
        }

        a.link-grey {
            color: #2e2e2e;
            text-decoration: underline;
        }

        a.no-line-all {
            text-decoration: none;
        }

        a{word-wrap:break-word;}
        table{border-collapse:collapse;}
        img, a img{border:0;}


        #outlook a{padding:0;}
        @-ms-viewport{width:device-width;}
        img{-ms-interpolation-mode:bicubic;}
        table{mso-table-lspace:0pt; mso-table-rspace:0pt;}
        .ReadMsgBody{width:100%;} .ExternalClass{width:100%;}
        p, a, li, td, blockquote{mso-line-height-rule:exactly;}
        a[href^="tel"], a[href^="sms"]{color:inherit; cursor:default; text-decoration:none;}
        p, a, li, td, body, table, blockquote{-ms-text-size-adjust:100%; -webkit-text-size-adjust:100%;}
        .ExternalClass, .ExternalClass p, .ExternalClass td, .ExternalClass div, .ExternalClass span, .ExternalClass font{line-height:100%;}
        a[x-apple-data-detectors]{color:inherit !important; text-decoration:none !important; font-size:inherit !important; font-family:inherit !important; font-weight:inherit !important; line-height:inherit !important;}
    </style>
</head>

<body style="margin: 0; padding: 0; font-size: 15px; font-family: Arial, sans-serif; line-height: 18px; color: #2e2e2e; background-color: #dce0df;">
    <table width="100%" align="center" cellpadding="0" cellspacing="0" style="background-color: #dce0df; border-collapse:collapse; border:none; margin:0;">
        <tr>
            <td border="0" align="center" valign="top" style="border:none; padding:0 5px;margin: 0;">
                <table width="700" align="center" valign="top" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:none;max-width: 700px;min-width: 700px; table-layout: fixed; background-color: #eeeeee; margin-top:41px; margin-bottom:41px;">
                    <tr>
                        <td border="0" align="left" style="border: 0; padding: 0px;font-size:0px;">
                           <table width="100%" align="center" valign="bottom" cellpadding="0" cellspacing="0" style="background-color: #e3e6e5; border-collapse:collapse; border:none; table-layout: fixed;">
                                <tr>
                                    <td width="180" height="80" border="0" align="left" style="border: 0; font-size:0px;">
                                        <a href="https://www.hyundai.ru/motorstudio_moscow">
                                            <img src="https://www.hyundai.ru/media/motorstudio/mail/1.jpg" width="180" height="80" border="0" style="vertical-align: top; padding:0;">
                                        </a>
                                    </td>
                                    <td width="320" height="80" border="0" align="left" style="border: 0; font-size:0px;">
                                        <img src="https://www.hyundai.ru/media/motorstudio/mail/2.jpg"  width="320" height="80" border="0" style="vertical-align: top; padding:0;">
                                    </td>
                                    <td width="200" height="80" border="0" align="left" style="border: 0; font-size:0px;">
                                        <a href="https://www.hyundai.ru/">
                                            <img src="https://www.hyundai.ru/media/motorstudio/mail/3.jpg"width="200" height="80" border="0" style="vertical-align: top; padding:0;">
                                        </a>
                                    </td>
                                </tr>
                           </table>
                        </td>
                    </tr>

                    <tr>
                        <td width="700" height="330" border="0" align="left" style="border: 0; font-size:0px;">
                            <img src="https://www.hyundai.ru/media/motorstudio/mail/4.jpg" width="700" height="330" border="0" style="vertical-align: top; padding:0;">
                        </td>
                    </tr>

                    <tr>
                        <td width="700" height="22" border="0" align="left" style="border: 0; font-size:0px; background-color: #eeeeee;">
                        </td>
                    </tr>

                    <tr>
                        <td border="0" align="left" style="border: 0; padding: 0px;font-size:0px;padding-left: 40px; padding-right: 40px;">
                            <table width="100%" align="center" valign="bottom" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-collapse:collapse; border:none; table-layout: fixed;">
                                <tr>
                                    <td border="0" align="left" style="border: 0; padding: 0px;font-size:26px;padding-left: 40px; padding-right: 40px; padding-top: 48px; padding-bottom: 48px; color: #241d1d;font-weight: bold;">
                                        Здравствуйте, <?=$data['name']?> <?=$data['surname'];?>!
                                    </td>
                                </tr>
                                <tr>
                                    <td border="0" align="left" style="border: 0; padding: 0px;font-size:18px; line-height: 30px; padding-left: 40px; padding-right: 40px; padding-bottom: 30px; color: #241d1d; font-weight: 500;">
                                        <? if($data['date_start'] == $data['date_end']) :?>
                                        Вы успешно зарегистрировались на мероприятие "<?=$data['event']?>",
                                        которое состоится в Hyundai Motorstudio Moscow <?=$data['date_start'];?> в <?=$data['time_start'];?>.
                                        <? else :?>
                                        Вы успешно зарегистрировались на <?=$data['event']?>,
                                        которое будет проходить в Hyundai Motorstudio Moscow с <?=$data['date_start'];?> по <?=$data['date_end'];?>.
                                        <? endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td border="0" align="left" style="border: 0; padding: 0px;font-size:18px; line-height: 30px; padding-left: 40px; padding-right: 40px; padding-bottom: 30px; color: #241d1d; font-weight: 500;">
                                        Для прохода на мероприятие вам, возможно, понадобится показать это письмо. Приготовьте его заранее или сделайте скриншот.
                                    </td>
                                </tr>
                                <tr>
                                    <td border="0" align="left" style="border: 0; padding: 0px;font-size:18px; line-height: 30px; padding-left: 40px; padding-right: 40px; padding-bottom: 30px; color: #241d1d; font-weight: 500;">
                                        Если с вами будет спутник, обязательно зарегистрируйте<br>
                                        его&nbsp;на&nbsp;сайте.
                                    </td>
                                </tr>
                                <tr>
                                    <td border="0" align="left" style="border: 0; padding: 0px;font-size:18px; line-height: 30px; padding-left: 40px; padding-right: 40px; padding-bottom: 50px; color: #241d1d; font-weight: 500;">
                                        С нетерпением ждем встречи!<br>
                                        Hyundai Motorstudio Moscow.
                                    </td>
                                </tr>

                                <tr>
                                    <td width="700" height="22" border="0" align="left" style="border: 0; font-size:0px; background-color: #eeeeee;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>


                    <tr>
                        <td border="0" align="left" style="border: 0; font-size:0px;padding-left: 0px; padding-right: 0px;">
                            <table width="100%" align="center" valign="bottom" cellpadding="0" cellspacing="0" style="background-color: #113a72; border-collapse:collapse; border:none; table-layout: fixed;">
                                <tr>
                                    <td width="700" height="214" border="0" align="left" style="border: 0; font-size:0px;">
                                        <img src="https://www.hyundai.ru/media/motorstudio/mail/51.jpg" width="700" height="214" border="0" style="vertical-align: top; padding:0;">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="700" border="0" align="left" style="border: 0; font-size:0px;">
                                        <table width="100%" align="center" valign="bottom" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:none; table-layout: fixed;">
                                            <tr>
                                                <td width="400" height="40" border="0" align="left" style="border: 0; font-size:0px;">
                                                    <a href="https://www.hyundai.ru/motorstudio_moscow">
                                                        <img src="https://www.hyundai.ru/media/motorstudio/mail/6.jpg" width="400" height="40" border="0" style="vertical-align: top; padding:0;">
                                                    </a>
                                                </td>
                                                <td width="300" height="40" border="0" align="left" style="border: 0; font-size:0px;">
                                                    <img src="https://www.hyundai.ru/media/motorstudio/mail/7.jpg" width="300" height="40" border="0" style="vertical-align: top; padding:0;">
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="700" height="38" border="0" align="left" style="border: 0; font-size:0px;">
                                        <img src="https://www.hyundai.ru/media/motorstudio/mail/8.jpg" width="700" height="38" border="0" style="vertical-align: top; padding:0;">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td border="0" align="left" style="border: 0; font-size:0px;padding-left: 40px; padding-right: 40px; padding-top: 24px; padding-bottom: 17px;">
                            <table width="100%" align="center" valign="bottom" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:none; table-layout: fixed;">
                                <tr>
                                    <td width="420" border="0" align="left" style="border: 0; font-size: 12px; color: #040404; padding-top: 15px; line-height: 16px;">
                                        © ООО «Хендэ Мотор СНГ». Все права защищены. <br>
                                        <a href="http://www.hyundai.ru/Legal">Юридическая информация</a>
                                    </td>
                                    <td width="200" height="50" border="0" align="left" style="border: 0; font-size: 0px;">
                                       <a href="#">
                                            <img src="https://www.hyundai.ru/media/motorstudio/mail/9.jpg" width="200" height="50" border="0" style="vertical-align: top; padding:0;">
                                       </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td border="0" align="left" style="border: 0; padding: 0px;font-size:0px;padding-left: 40px; padding-right: 40px; border-top: 1px solid #e1e1e1;">
                            <table width="100%" align="center" valign="bottom" cellpadding="0" cellspacing="0" style="border-collapse:collapse; border:none; table-layout: fixed;">
                                <tr>
                                    <td border="0" align="left" style="border: 0; font-size: 12px; color: #bdc9cf; padding-top: 17px;  line-height: 16px;">
                                        Вы получили это письмо, потому что оставили заявку на посещение мероприятия в Hyundai Motorstudio Moscow. Если вы по ошибке получили это письмо, просто проигнорируйте его.
                                    </td>
                                </tr>
                                <tr>
                                    <td border="0" align="left" style="border: 0; font-size: 12px; color: #bdc9cf; padding-top: 12px; padding-bottom: 40px;  line-height: 16px;">
                                       По всем вопросам Вы можете обратиться: в Службу Клиентской поддержки Hyundai 8 800 333-71-67, заполнить <a href="#">форму обратной связи</a>, или в любой официальный дилерский центр. Оттенки цветов и изображения автомобилей, используемые в рассылке, могут отличаться от реальных.
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
