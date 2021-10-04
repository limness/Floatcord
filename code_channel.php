<?php
	ob_start();
	require_once 'connect.php';
	session_start();
	require_once 'language.php';


	$id_channel_search = $_GET['id'];

	if(isset($_POST['area_code'])) {
		$code_text = $_POST['area_code'];
	}

	$success = "";

	# Set the Success Session for error handling on the page
	if (isset($_SESSION['flashMessage'])) {
    $success = $_SESSION['flashMessage'];
    unset($_SESSION['flashMessage']);
	}

	$query = "SELECT id_channel FROM channels_txt WHERE id_channel = '$id_channel_search'";
	$data = mysqli_query($connect, $query);

	# If ID is wrong - open the Error Page
	if(mysqli_num_rows($data) == 1) {
		$insert = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `channels_txt` WHERE `id_channel` = '". $id_channel_search. "'"));
	} else {
		header("Location: errno.php");
	}

	# Counting users on the current page
	$insert['userscount']++;
	$query = "UPDATE channels_txt SET userscount = '" . $insert['userscount'] . "' WHERE id_channel = '". $id_channel_search. "'";
  $data = mysqli_query($connect, $query);
	####################################

	# Save the changes to files
	if(isset($_POST['save_changes'])) {
		$file = 'servers/' . $id_channel_search . '/code.txt';
		file_put_contents($file, $code_text);

		if($_SESSION['Language'] == "ru") {
			$_SESSION['flashMessage'] = 'Изменения сохранены!';
		} else {
 			$_SESSION['flashMessage'] = 'Saved changes!';
		}
		header("Location:" . $_SERVER['PHP_SELF'] . '?id=' . $id_channel_search);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155065961-1"></script>
	<script src="js/googleanalytics.js"></script>
	<meta charset="UTF-8">
	<title>Floatcord - File sharing service</title>
	<link rel="icon" type="image/png" href="https://i.imgur.com/k2rF22C.png">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="lib/codemirror/lib/codemirror.css">
	<link rel="stylesheet" href="lib/codemirror/theme/material.css">
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
    			<button name = "selectEnglish" id = "languageEnglish" style = "background: #2f3645; display: table; margin-top: 5pt; color: #f6f6f6; font-family: GothamSSm Narrow Light; cursor: pointer; visibility: hidden; border: none; outline: none; border-radius: 3pt; width: 100%;">English</button>
    			<button name = "selectRussia" id = "languageRussia" style = "background: #2f3645; display: table; margin-top: 5pt; color: #f6f6f6; font-family: GothamSSm Narrow Light; cursor: pointer; visibility: hidden; border: none; outline: none; border-radius: 3pt; width: 100%;">Русский</button>
		    </div>
			</form>
		</div>
	</div>
	<div id = "name_channel">
		<div style="display: inline-block; color: #7bc0b6; font-family: GothamSSm Narrow Medium; font-size: 35pt; cursor: pointer;">#<?php echo $insert['id_channel']; ?></div>
		<div style = "display: inline-block; margin-left: 10pt;">
			<div style = "display: table;" >
				<?php if($insert['vip_status'] == 1): ?>
				<div style = "display: inline-block; border-radius: 6px; background: #ffae00; padding-left: 5pt; padding-top: 1pt; padding-bottom: 1pt; padding-right: 5pt; font-size: 10pt; font-family: GothamSSm Narrow Medium;">
					VIP
				</div>
				<?php endif;?>
				<?php if($id_channel_search == 777): ?>
				<div style = "margin-left: 5pt; display: inline-block; border-radius: 6px; background: #d16161; padding-left: 5pt; padding-top: 1pt; padding-bottom: 1pt; padding-right: 5pt; font-size: 10pt; font-family: GothamSSm Narrow Medium;">
					Admin Channel
				</div>
				<?php endif;?>
			</div>
			<?php if($_SESSION['Language'] == "ru"): ?>
			Номер канала для подключения
			<?php else:?>
			Number of channel for connection
			<?php endif;?><span onclick="Rabbits(<?php echo $id_channel_search; ?>)" style="font-family: GothamSSm Narrow Medium; cursor: pointer;">(<?php if($_SESSION['Language'] == "ru"):?><span style="font-family: GothamSSm Narrow Medium; text-decoration: underline">Скопировать</span><?php else:?>Copy<?php endif;?>)</span>
		</div>
	</div>
	<form method = "POST">
		<div id = "container-code">
			<textarea name = "area_code" id = "code"><?php echo file_get_contents('servers/' . $id_channel_search . '/code.txt'); ?></textarea>
			<button style = "margin-top: 32pt; background: #7bc0b6;color: #f6f6f6; font-family: GothamSSm Narrow Medium; font-size: 10pt;cursor: pointer;padding-top: 15px;padding-bottom: 15px;padding-left: 25px;padding-right: 25px;border-radius: 6px; text-decoration: none; display: inline-block; border: none; outline: none;" name = "save_changes">
				<?php if($_SESSION['Language'] == "ru"): ?>
				Сохранить изменения
				<?php else: ?>
				Save changes
				<?php endif; ?>
			</button>
			<div id = "text_wrong_password" style="margin-left: 10pt; font-family: GothamSSm Narrow Medium; color: #7bc0b6; font-size: 10pt; display: inline-block;"> <?php echo $success; ?></div>
		</div>
	</form>
	<script type = "text/javascript" src = "js/copyIDchannel.js"></script>
	<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
  	$(window).on('unload', function() {
	    var url = document.URL;
			var id = url.substring(url.lastIndexOf('=') + 1);
	  	var fd = new FormData();

	  	fd.append('ajax_data', id);
	  	navigator.sendBeacon('removeTxt.php', fd);
    });
  </script>
	<script src="lib/codemirror/lib/codemirror.js"></script>
	<script src="lib/codemirror/mode/javascript/javascript.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<script type = "text/javascript" src = "js/scriptFon.js"></script>
</body>
</html>

<?php
	ob_end_flush();
?>
