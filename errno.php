<?php
	ob_start();
	session_start();
	require_once 'language.php';
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155065961-1"></script>
	<script src="js/googleanalytics.js"></script>
	<meta charset="UTF-8">
	<title>Floatcord - Oooops...</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div style = "position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: #fff;">
		<div id = "body_name" style="font-size: 70pt;">
			Hey!
		</div>
		<div id = "body_name_two" style="margin-top: 20pt; font-size: 25pt;">
			<?php if($_SESSION['Language'] == "ru"): ?>
			Похоже вы пытались подключиться по ссылке<br>
			Но при этом допустили ошибку в номере канала :(
			<?php else: ?>
			Are you trying to connect by link?<br>
			The number of channel is wrong :(
			<?php endif; ?>
		</div>
		<div id = "body_name_two" style="margin-top: 20pt; font-size: 14pt;">
			<?php if($_SESSION['Language'] == "ru"): ?>
			Подключиться на канал вы также сможете на сайте<br>
			Давай сюда <a href="https://floatcord.com/" style="text-decoration: none; font-family: GothamSSm Narrow Medium; color: #fff;">floatcord.com</a>
			<?php else: ?>
			You can connect to server using this link
			<a href="https://floatcord.com/" style="text-decoration: none; font-family: GothamSSm Narrow Medium; color: #fff;">floatcord.com</a>
			<?php endif; ?>
		</div>
	</div>
</body>
</html>

<?php
ob_end_flush();
?>
