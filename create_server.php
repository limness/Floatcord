<?php
	ob_start();
	require_once 'connect.php';
	session_start();

	require_once 'language.php';
	require_once 'generate_id.php';


	if(isset($_POST['create_txt_channel'])) {
		$id_channel = $name_channel;
		$ip = $_SERVER['REMOTE_ADDR'];
		$sql = '';

		if(isset($_SESSION['create_vip'])) {
			if($_SESSION['create_vip'] == 1) {
				$sql = "INSERT INTO channels_txt (id_channel, userscount, vip_status) VALUES ('$id_channel', '0', '1')";
				$sql_total = "INSERT INTO channels_total (id_channel, vip, ip) VALUES ('$id_channel', '1', '$ip')";
			} else {
				$sql = "INSERT INTO channels_txt (id_channel, userscount) VALUES ('$id_channel', '0')";
				$sql_total = "INSERT INTO channels_total (id_channel, vip, ip) VALUES ('$id_channel', '0', '$ip')";
			}
	    unset($_SESSION['create_vip']);
		} else {
			$sql = "INSERT INTO channels_txt (id_channel, userscount) VALUES ('$id_channel', '0')";
			$sql_total = "INSERT INTO channels_total (id_channel, vip, ip) VALUES ('$id_channel', '0', '$ip')";
		}
		mysqli_query($connect, $sql_total);
		# Create new dir for channel
	  mkdir("servers/" . $id_channel, 0700);

		# Open the file for work
		$create = fopen("servers/" . $id_channel ."/code.txt", "a");

		if(mysqli_query($connect, $sql)) {
			# Sending the user to the channel page
			header('Location: channel_txt.php?id='. $id_channel);
		}
	}

	if(isset($_POST['create_filemanager_channel'])) {
		$id_channel = $name_channel;
		$ip = $_SERVER['REMOTE_ADDR'];
		$sql = '';

		if(isset($_SESSION['create_vip'])) {
			if($_SESSION['create_vip'] == 1) {
				$sql = "INSERT INTO channels_files (id_channel, userscount, vip_status, size) VALUES ('$id_channel', '0', '1', '0')";
				$sql_total = "INSERT INTO channels_total (id_channel, vip, ip) VALUES ('$id_channel', '1', '$ip')";
			} else {
				$sql = "INSERT INTO channels_files (id_channel, userscount, vip_status, size) VALUES ('$id_channel', '0', '0', '0')";
				$sql_total = "INSERT INTO channels_total (id_channel, vip, ip) VALUES ('$id_channel', '0', '$ip')";
			}
	   	unset($_SESSION['create_vip']);
		} else {
			$sql = "INSERT INTO channels_files (id_channel, userscount, vip_status, size) VALUES ('$id_channel', '0', '0', '0')";
			$sql_total = "INSERT INTO channels_total (id_channel, vip, ip) VALUES ('$id_channel', '0', '$ip')";
		}
		mysqli_query($connect, $sql_total);
		# Create new dir for channel
	  mkdir("servers/" . $id_channel, 0700);

		if(mysqli_query($connect, $sql)) {
			# Sending the user to the channel page
			header('Location: channel_files.php?id='. $id_channel);
		}
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155065961-1"></script>
	<script src="js/googleanalytics.js"></script>
	<meta charset="UTF-8">
	<title>Floatcord - File sharing service</title>
	<link rel="icon" type="image/png" href="https://i.imgur.com/k2rF22C.png">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style_fon.css">
</head>
<body>
	<div id = "logo">
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
    			<button name = "selectEnglish" id = "languageEnglish" style = "background: #2f3645; display: table; margin-top: 5pt; color: #f6f6f6; font-family: GothamSSm Narrow Light; cursor: pointer; visibility: hidden; border: none; outline: none; border-radius: 6px; width: 100%;">English</button>
    			<button name = "selectRussia" id = "languageRussia" style = "background: #2f3645; display: table; margin-top: 5pt; color: #f6f6f6; font-family: GothamSSm Narrow Light; cursor: pointer; visibility: hidden; border: none; outline: none; border-radius: 6px; width: 100%;">Русский</button>
		    </div>
			</form>
		</div>
	</div>
	<div style = "color: #f6f6f6; font-family:GothamSSm Narrow Medium; text-align: center; font-size: 17pt; margin-top: 1%; ">
		<?php if($_SESSION['Language'] == "ru"): ?>
		Выберите тип создаваемого канала
		<?php else: ?>
		Select the channel type
		<?php endif; ?>
	</div>
	<div style = "color: #9fa0a2; font-family: GothamSSm Narrow Light; text-align: center; font-size: 12pt; margin-top: 5pt; ">
		<?php if($_SESSION['Language'] == "ru"): ?>
		Канал будет удален сразу после того, как все участники его покинут
		<?php else: ?>
		When all the participants will leave it, channel will be deleted
		<?php endif; ?>
	</div>
	<form method = "POST">
		<div class="button">
			<div id = "center_button">
				<div style = "background: #181c25; color: #1d222e; font-family: GothamSSm Narrow Medium; font-size: 10pt; display:inline-block; margin-right: 18px; padding-top: 30px; padding-bottom: 30px; padding-left: 30px; padding-right: 30px; border-radius: 6px; text-decoration: none;
							">
					<img src="img/channel_txt.png" border="0" style="text-decoration: none;-moz-user-select: none; -webkit-user-select: none; -ms-user-select: none; user-select: none;" />
					<div style="display: flex; justify-content: center;">
						<button name = "create_txt_channel" style = "background: #43b581; color: #0f1520; font-family: GothamSSm Narrow Medium; font-size: 10pt; padding-top: 15px; padding-bottom: 15px; padding-left: 25px; padding-right: 25px; border-radius: 6px; text-decoration: none; cursor: pointer; width: 100%; margin-top: 20px; border: none; outline: none;">
							<?php if($_SESSION['Language'] == "ru"): ?>
							Создать канал редактора
							<?php else: ?>
							Create editor channel
							<?php endif; ?>
						</button>
					</div>
				</div>
				<div style = "background: #181c25; color: #1d222e; font-family: GothamSSm; font-size: 10pt; display:inline-block; margin-right: 18px; padding-top: 30px; padding-bottom: 30px; padding-left: 30px; padding-right: 30px; border-radius: 6px; text-decoration: none;
							">
					<img src="img/channel_files.png" border="0" style="text-decoration: none;-moz-user-select: none; -webkit-user-select: none; -ms-user-select: none; user-select: none;" />
					<div style="display: flex; justify-content: center;">
						<button name = "create_filemanager_channel" style = "background: #9577c2; color: #0f1520; font-family: GothamSSm Narrow Medium; font-size: 10pt; padding-top: 15px; padding-bottom: 15px;padding-left: 25px; padding-right: 25px; border-radius: 6px; text-decoration: none; margin-top: 20px; cursor: pointer; width: 100%; border: none; outline: none;">
							<?php if($_SESSION['Language'] == "ru"): ?>
							Создать файловый менеджер
							<?php else: ?>
							Create filemanager
							<?php endif; ?>
						</button>
					</div>
				</div>
				</div>
			</div>
		</div>
	</form>
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
