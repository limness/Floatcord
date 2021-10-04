<?php
	ob_start();
	session_start();
	require_once 'language.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
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
		<div id = "vip" >
			<a href = "d.php" id = "button_vip" onmouseleave = "vipmouseleave(event)">
				<?php if($_SESSION['Language'] == "ru"): ?>
				Доступ VIP
				<?php else: ?>
				VIP-access
				<?php endif; ?>
			</a>
			<div id = "soonVIP" style = "color: #f6f6f6; display: table; margin-top: 5pt; font-family: GothamSSm Narrow Medium; cursor: pointer; visibility: hidden; border: none; outline: none; width: 100%;">soon :)</div>
		</div>
	</div>
	<div id = "body_name">
		<?php if($_SESSION['Language'] == "ru"): ?>
		Создавайте каналы для передачи информации без регистрации
		<?php else: ?>
		Create channels for transmitting information without registration
		<?php endif; ?>
	</div>
	<div id = "body_name_two">
		<?php if($_SESSION['Language'] == "ru"): ?>
		Для этого просто нажмите на кнопку ниже и начните свою работу
		<?php else: ?>
		Just tap the green button and start your work
		<?php endif; ?>
	</div>
  <div class="button">
		<div id = "center_button">
			<a href = "create_server.php" id = "button_create_server">
				<?php if($_SESSION['Language'] == "ru"): ?>
				Создать канал
				<?php else: ?>
				Create channel
				<?php endif; ?>
			</a>
			<a href = "connect_to_server.php" id = "button_connect_to_server">
				<?php if($_SESSION['Language'] == "ru"): ?>
				Подключиться
				<?php else: ?>
				Connect
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
	<script type="text/javascript">
		require('./render.js');
	</script>
	<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type = "text/javascript" src = "js/scriptFon.js"></script>
</body>
</html>

<?php
ob_end_flush();
?>
