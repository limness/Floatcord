<?php
  ob_start();
	require_once 'connect.php';
  session_start();
  require_once 'language.php';

  $email = 'None';

  if (isset($_SESSION['email'])) {
      $email = $_SESSION['email'];
      unset($_SESSION['email']);
  } else {
    header("Location: index.php");
  }

  # Generate the Key
  $chars="qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
	$max = 10;
	$size = StrLen($chars) - 1;
	$id_coupon = null;

  while($max--) {
    $id_coupon .= $chars[rand(0,$size)];
  }

  #################

  $title = ''
  $message = ''

  if($_SESSION['Language'] == "ru") {
    $title = 'Floatcord VIP - Выдача доступа'
    $message = '
    <!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
        <title></title>
      </head>
      <body>
        <table style="width: 100%;">
        <tr>
          <td>
            <center>
              <table style="width: 640px; margin: 0 auto; text-align: left;">
                <tr>
                  <td>
                    <div style="background: #191c26; width: 500px; height: 800px; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%);">
                      <div style="background: #6da7ff; width: 500px; height: 150px;">
                        <center>
                          <div style="padding-top: 30px;">
                            <img src="https://i.imgur.com/pHP7NgS.png" width="100" height="90">
                          </div>
                        </center>
                      </div>
                      <div style="margin-top: 60px; font-family: Trebuchet MS; font-weight: lighter; color: #fff; text-align: center;">
                        Мы благодарим вас за то, что вы поддерживаете<br>
                        нас и наш проект. Это помогает нам понять, что мы<br>
                        стараемся не просто так. Вся поддержка пойдет на <br>
                        дальнейшее развитие всего сайта и проекта
                      </div>
                      <div style="margin-top: 30px; font-family: Trebuchet MS; font-weight: lighter; color: #fff; text-align: center;">
                        В качестве благодарности мы отправляем<br>
                        вам <span style = "font-weight: bold;">доступ для создания одного VIP канала</span>
                      </div>
                      <div style="margin-top: 60px; font-family: Trebuchet MS; font-size: 30pt; font-weight: bold; color: #fff; text-align: center;">
                        ' . $id_coupon . '
                      </div>
                      <div style="margin-top: 60px; font-family: Trebuchet MS; font-weight: lighter; color: #fff; text-align: center;">
                        Чтобы воспользоваться кодом, перейдите на сайт<br>
                        нажмите кнопку <span style = "font-weight: bold;">Доступ VIP</span> и введите код<br>
                        Затем нажмите <span style = "font-weight: bold;">Получить доступ</span> и выберите тип<br>
                        канала
                      </div>
                      <div style="margin-top: 90px; font-family: Trebuchet MS; font-size: 10pt; font-weight: lighter; color: #fff; text-align: center;">
                        <span style = "font-weight: bold;">FLOAT</span>CORD © 2020 <span style = "font-weight: bold;">LIM&ETERNAL</span>
                      </div>
                    </div>
                   </td>
                  </tr>
                </table>
              </center>
            </td>
          </tr>
        </table>
      </body>
    </html>';
  } else {
    $title = 'Floatcord VIP - Success';
    $message = '
    <!DOCTYPE html>
        <html lang="en" dir="ltr">
          <head>
            <meta charset="utf-8">
            <title></title>
          </head>
          <body>
            <table style="width: 100%;">
            <tr>
              <td>
                <center>
                  <table style="width: 640px; margin: 0 auto; text-align: left;">
                    <tr>
                      <td>
                        <div style="background: #191c26; width: 500px; height: 800px; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%);">
                          <div style="background: #111319; width: 500px; height: 150px;">
                            <center>
                              <div style="padding-top: 30px;">
                                <img src="https://i.imgur.com/pHP7NgS.png" width="100" height="90">
                              </div>
                            </center>
                          </div>
                          <div style="margin-top: 60px; font-family: Trebuchet MS; font-size: 14pt; font-weight: lighter; color: #fff; text-align: center;">
                            Thank you for supporting us and our project.<br>
                            It helps us understand that we try for a reason.<br>
                            All support from you goes to the development of our project.
                          </div>
                          <div style="margin-top: 30px; font-family: Trebuchet MS; font-size: 14pt; font-weight: lighter; color: #fff; text-align: center;">
                            In gratitude we sent to you<br>
                            <span style = "font-weight: bold;">a pass to your own VIP-channel.</span>
                          </div>
                          <div style="margin-top: 60px; font-family: Trebuchet MS; font-size: 30pt; font-weight: bold; color: #fff; text-align: center;">
                            ' . $id_coupon . '
                          </div>
                          <div style="margin-top: 60px; font-family: Trebuchet MS; font-size: 14pt; font-weight: lighter; color: #fff; text-align: center;">
                            To use the code, go to <span style = "font-weight: bold;">site Floatcord</span> and<br>
                            enter your VIP code in <span style = "font-weight: bold;">VIP-access</span> window<br>
                            then choose your type of channel.
                          </div>
                          <div style="margin-top: 90px; font-family: Trebuchet MS; font-size: 10pt; font-weight: lighter; color: #fff; text-align: center;">
                            <span style = "font-weight: bold;">FLOAT</span>CORD © 2020 <span style = "font-weight: bold;">LIM&ETERNAL</span>
                          </div>
                        </div>
                       </td>
                      </tr>
                    </table>
                  </center>
                </td>
              </tr>
            </table>
          </body>
        </html>';
  }
  $codes = '
    From: noreply@floatcord.com\r\n"
    ."Content-type: text/html; charset=utf-8\r\n"
    ."X-Mailer: PHP mail script
  '

  mail($email, $title, $message, $codes);

  $sql = "INSERT INTO coupons (coupon) VALUES ('$id_coupon')";
  mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155065961-1"></script>
	<script src="js/googleanalytics.js"></script>
	<meta charset="UTF-8">
	<title>Floatcord - File sharing service</title>
	<meta name="description" content="Send your files to people! You can use our online text editor to share information in real time." />
	<link rel="icon" type="image/png" href="https://i.imgur.com/k2rF22C.png">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style_fon.css">
</head>
<body>
	<div style="-webkit-app-region: drag" id = "logo">
		<a href = "index.php" style = "color: #f6f6f6; text-decoration: none; display:inline-block;">
			<span id="select">FLOAT</span>CORD
			<div id = "about_developer" onmouseenter = "mouseenter(event)" onmouseleave = "mouseleave(event)">
				<?php if($_SESSION['Language'] == "ru"): ?>
				О разработчиках
				<?php else: ?>
				Developers
				<?php endif; ?>
				<a href = "https://twitter.com/limtosingular" id = "developerLim" style = "display: table; margin-top: 5pt; color: #5c90d1; font-family: GothamSSm Narrow Medium; cursor: pointer; visibility: hidden;">lim</a>
				<a href = "http://twitter.com/EternalMech" id = "developerEternal" style = "display: table; margin-top: 5pt; color: #5c90d1; font-family: GothamSSm Narrow Medium; cursor: pointer; visibility: hidden;">Eternal</a>
			</div>
		</a>
		<div id = "change_language" onmouseenter = "langmouseenter(event)" onmouseleave = "langmouseleave(event)">
			<?php if($_SESSION['Language'] == "ru"): ?>
			Язык
			<?php else: ?>
			Language
			<?php endif; ?>
      <form method = "POST">
        <div style = "display: table; ">
          <button name = "selectEnglish" id = "languageEnglish" style = "background: #2f3645; display: table; margin-top: 5pt; color: #f6f6f6; font-family: GothamSSm Narrow Light; cursor: pointer; visibility: hidden; border: none; outline: none; border-radius: 3pt; width: 100%;">English</button>
          <button name = "selectRussia" id = "languageRussia" style = "background: #2f3645; display: table; margin-top: 5pt; color: #f6f6f6; font-family: GothamSSm Narrow Light; cursor: pointer; visibility: hidden; border: none; outline: none; border-radius: 3pt; width: 100%;">Русский</button>
        </div>
      </form>
		</div>
	</div>
  <div id = "body_name" style="font-size: 30pt;">
    <?php if($_SESSION['Language'] == "ru"): ?>
    Благодарим вас за покупку!<br>
    Это очень многое значит для нас
    <?php else: ?>
    Thank you for purchase!<br>
    That is really important for us
    <?php endif; ?>
  </div>
  <div id = "body_name_two" style="margin-top: 20pt; font-size: 18pt;">
    <?php if($_SESSION['Language'] == "ru"): ?>
    На почтовый адрес <span style = "font-family: GothamSSm Narrow Medium;"><?php echo $email; ?></span> было отправлено письмо<br>
    в котором указаны дальнейшие инструкции и номер купона для пользования
    <?php else: ?>
    A letter was send to your email <span style = "font-family: GothamSSm Narrow Medium;"><?php echo $email; ?></span><br>
    That have instructions for use
    <?php endif; ?>
  </div>
  <div class="button">
    <div id = "center_button">
      <a href = "info_vip.php" id = "button_create_server" style = "background: #74afff;">
        <?php if($_SESSION['Language'] == "ru"): ?>
        Активировать купон
        <?php else: ?>
        Activate coupon
        <?php endif; ?>
      </a>
    </div>
  </div>
	<div id="Clouds">
    <div class="Cloud Foreground"></div>
    <div class="Cloud Background"></div>
    <div class="Cloud Foreground"></div>
    <div class="Cloud Background"></div>
    <div class="Cloud Foreground"></div>
    <div class="Cloud Background"></div>
    <div class="Cloud Background"></div>
    <div class="Cloud Foreground"></div>
    <div class="Cloud Background"></div>
    <div class="Cloud Background"></div>
  </div>
  <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
  	 width="40px" height="24px" viewBox="0 0 40 24" enable- xml:space="preserve">
    <defs>
      <path id="Cloud" d="M33.85,14.388c-0.176,0-0.343,0.034-0.513,0.054c0.184-0.587,0.279-1.208,0.279-1.853c0-3.463-2.809-6.271-6.272-6.271
    	c-0.38,0-0.752,0.039-1.113,0.104C24.874,2.677,21.293,0,17.083,0c-5.379,0-9.739,4.361-9.739,9.738
    	c0,0.418,0.035,0.826,0.084,1.229c-0.375-0.069-0.761-0.11-1.155-0.11C2.811,10.856,0,13.665,0,17.126
    	c0,3.467,2.811,6.275,6.272,6.275c0.214,0,27.156,0.109,27.577,0.109c2.519,0,4.56-2.043,4.56-4.562
    	C38.409,16.43,36.368,14.388,33.85,14.388z"/>
    </defs>
  </svg>
	<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type = "text/javascript" src = "js/scriptFon.js"></script>
</body>
</html>

<?php
  ob_end_flush();
?>
