<?php
	ob_start();
	require_once 'connect.php';
	session_start();
	require_once 'language.php';

	$success = "";

	# Set the Success Session for error handling on the page
	if (isset($_SESSION['flashMessageWrongId'])) {
	    $success = $_SESSION['flashMessageWrongId'];
	    unset($_SESSION['flashMessageWrongId']);
	}

	if(isset($_POST['connect_to'])) {
  	$errors = array();

		if(trim($_POST['id_channel_search']) == '') {
			if($_SESSION['Language'] == "ru") {
 				$_SESSION['flashMessageWrongId'] = 'Номер канала не введен シ';
 			} else {
 				$_SESSION['flashMessageWrongId'] = 'Number of channel is wrong シ';
			}
			header("Location:" . $_SERVER['PHP_SELF']);
		} else {
			$id_channel_search = mysqli_real_escape_string($connect, $_POST['id_channel_search']);
			$query = "SELECT id_channel FROM channels_txt WHERE id_channel = '$id_channel_search'";
			$data = mysqli_query($connect, $query);

			if(mysqli_num_rows($data) == 1) {
				$insert = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `channels_txt` WHERE `id_channel` = '$id_channel_search'"));
				header('Location: channel_txt.php?id='. $id_channel_search);
			} else {
				$id_channel_search = mysqli_real_escape_string($connect, $_POST['id_channel_search']);
				$query = "SELECT id_channel FROM channels_files WHERE id_channel = '$id_channel_search'";
				$data = mysqli_query($connect, $query);

				if(mysqli_num_rows($data) == 1) {
					$insert = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `channels_files` WHERE `id_channel` = '$id_channel_search'"));
					header('Location: channel_files.php?id='. $id_channel_search);
				} else {
					if($_SESSION['Language'] == "ru") {
						$_SESSION['flashMessageWrongId'] = 'Номер канала введен неверно :warning:';
					} else {
						$_SESSION['flashMessageWrongId'] = 'Number of channel is wrong シ';
					}
					header("Location:" . $_SERVER['PHP_SELF']);
				}
			}
			mysqli_close($connect);
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155065961-1"></script>
	<script src="js/googleanalytics.js"></script>

	<meta charset="UTF-8">
	<title>Floatcord</title>
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
	<form method = "POST">
		<div class="button">
			<div id = "center_button">
				<div style = "display:inline-block; margin-right: 18px;">
					<div style = "background: #181c25; color: #1d222e; font-family: GothamSSm Narrow Medium; font-size: 10pt; padding-top: 30px; padding-bottom: 30px; padding-left: 30px; padding-right: 30px; border-radius: 6px; text-decoration: none; ">
						<div style="display: flex; justify-content: center;">
							<?php if($_SESSION['Language'] == "ru"): ?>
							<input type = "text" placeholder = "Введите номер канала" name = "id_channel_search" id = "input_search"></input>
							<?php else: ?>
							<input type = "text" placeholder = "Number of channel" name = "id_channel_search" id = "input_search"></input>
							<?php endif; ?>
						</div>

						<div style="display: flex; justify-content: center;">
							<button id = "button_connect_to_server_from_connect" name = "connect_to">
								<?php if($_SESSION['Language'] == "ru"): ?>
								Подключиться
								<?php else: ?>
								Connect
								<?php endif; ?>
							</button>
						</div>
					</div>
				</div>
				<div id = "text_wrong_password" style="margin-top: 12pt; font-family: GothamSSm Narrow Medium; color: #c07b7b; font-size: 10pt;"><?php echo $success;?></div>
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
    <!--  <svg viewBox="0 0 40 24" class="Cloud"><use xlink:href="#Cloud"></use></svg>-->
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
