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

	# Set the create_vip for activation of VIP
  if(isset($_POST['create_txt_channel'])) {
		$_SESSION['create_vip'] = 1;
		header('Location: create_server.php');
  }
	# Set the VIP period
	if(isset($_POST['vip_month'])) {
		$_SESSION['vip_period'] = 1;
		header('Location: payment_vip.php');
  }
	# Set the VIP period
	if(isset($_POST['vip_year'])) {
		$_SESSION['vip_period'] = 2;
		header('Location: payment_vip.php');
  }
	# Set the VIP period
	if(isset($_POST['vip_infinity'])) {
		$_SESSION['vip_period'] = 3;
		header('Location: payment_vip.php');
  }

	# Create the channel process
	if(isset($_POST['create_vip_channel'])) {
  	$errors = array();

		# Check that the code is correct
		if(trim($_POST['input_vip_coupon']) == '') {
			if($_SESSION['Language'] == "ru") {
 				$_SESSION['flashMessageWrongId'] = 'FVC купон не введен シ';
			} else {
 				$_SESSION['flashMessageWrongId'] = 'FVC coupon is wrong シ';
			}
			header("Location:" . $_SERVER['PHP_SELF']);
		} else {
				$id_coupon = mysqli_real_escape_string($connect, $_POST['input_vip_coupon']);
	    	$query = "SELECT * FROM coupons WHERE coupon = '$id_coupon'";
	    	$data = mysqli_query($connect, $query);

				require_once 'generate_id.php';

				$id_channel = $name_channel;
				$ip = $_SERVER['REMOTE_ADDR'];

				# Check the enter coupon in DB
	    	if(mysqli_num_rows($data) == 1) {
					# Remove this for future access
					$sql_delete = "DELETE FROM coupons WHERE coupon = '$id_coupon'";
					mysqli_query($connect, $sql_delete);

					# Create new file channel
					$sql = "INSERT INTO channels_files (id_channel, userscount, vip_status, size) VALUES ('$id_channel', '0', '1', '0')";
					mysqli_query($connect, $sql);

					# Create new channel for total list
					$sql_total = "INSERT INTO channels_total (id_channel, vip, ip) VALUES ('$id_channel', '1', '$ip')";
					mysqli_query($connect, $sql_total);

					# Create new dir in our host
					mkdir("servers/" . $id_channel, 0700);
					header('Location: channel_files.php?id='. $id_channel);
	    	} else {
					if($_SESSION['Language'] == "ru") {
	 					$_SESSION['flashMessageWrongId'] = 'Введенный FVC купон не существует! <br><span style="text-decoration: underline;">Помощь -> Разработчики</span>';
	 				} else {
	 					$_SESSION['flashMessageWrongId'] = 'FVC coupon is wrong! <br><span style="text-decoration: underline;">Help -> Developers</span>';
					}
					header("Location:" . $_SERVER['PHP_SELF']);
	    	}
	    	mysqli_close($connect);
		}
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-155065961-1"></script>
	<script src="js/googleanalytics.js"></script>
	<meta charset="UTF-8">
	<title>Floatcord</title>
	<link rel="icon" type="image/png" href="https://i.imgur.com/k2rF22C.png">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style_fon.css">
	<link rel="stylesheet" href="css/style_vip_menu.css">
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
					<div style="margin-bottom: 10pt; font-size: 10pt; color: #f6f6f6; font-family: GothamSSm Narrow Medium;">
						<?php if($_SESSION['Language'] == "ru"): ?>Уже есть VIP купон (FVC)? Используйте его!<?php else: ?>Already have a VIP coupon? Enter it now!<?php endif; ?>
					</div>
					<div style = "background: #12161e; color: #1d222e; font-family: GothamSSm Narrow Medium; font-size: 10pt; padding-top: 30px; padding-bottom: 30px; padding-left: 30px; padding-right: 30px; border-radius: 6px; text-decoration: none; ">
						<div style="display: flex; justify-content: center;">
							<?php if($_SESSION['Language'] == "ru"): ?><input id = "login_input" type = "text" placeholder = "Введите FVC купон" name = "input_vip_coupon"></input><?php else: ?>
							<input id = "login_input" type = "text" placeholder = "Enter FVC coupon" name = "input_vip_coupon"></input><?php endif; ?>
						</div>
						<div style="display: flex; justify-content: center;">
							<button name = "create_vip_channel" id = "login_button">
								<?php if($_SESSION['Language'] == "ru"): ?>Создать VIP канал<?php else: ?>Create VIP channel<?php endif; ?>
							</button>
						</div>
					</div>
				</div>
				<div style = "display:inline-block; margin-right: 18px;">
					<div style="margin-bottom: 10pt; font-size: 10pt; color: #f6f6f6; font-family: GothamSSm Narrow Medium;">
						<?php if($_SESSION['Language'] == "ru"): ?>Нет VIP доступа? Его преимущества:<?php else: ?>Do you not have VIP? His advantages:<?php endif; ?>
					</div>
					<div style = "background: #12161e; color: #1d222e; font-family: GothamSSm; font-size: 10pt; padding-top: 30px; padding-bottom: 30px; padding-left: 30px; padding-right: 30px; border-radius: 6px; text-decoration: none;
								">
						<div id = "items_vip">
							<?php if($_SESSION['Language'] == "ru"): ?>Создание VIP каналов:<?php else: ?>Create VIP channels<?php endif; ?>
						</div>
						<div id = "items_vip">
							<?php if($_SESSION['Language'] == "ru"): ?>Загружать файлы до 500 МБ<?php else: ?>Upload files up to 500 MB<?php endif; ?>
						</div>
						<div id = "items_vip">
							<?php if($_SESSION['Language'] == "ru"): ?>До 1 ГБ информации на одном канале<?php else: ?>Up to 1 GB of data for a channel<?php endif; ?>
						</div>
						<div id = "items_vip">
							<?php if($_SESSION['Language'] == "ru"): ?>Канал удаляется по подписке<?php else: ?>The channel will be deleted <br>by the end of the subscriptipon<?php endif; ?>
						</div>
						<div style="display: flex; justify-content: center;">
							<button name = "vip_month" style = "background: #43b581; color: #f6f6f6; font-family: GothamSSm Narrow Medium; font-size: 10pt; padding-top: 15px; padding-bottom: 15px;padding-left: 25px; padding-right: 25px; border-radius: 6px; text-decoration: none; cursor: pointer; width: 100%; border: none; outline: none; margin-right: 20px;">
								0.99$
								<span style = "font-family: GothamSSm Narrow Light;"><?php if($_SESSION['Language'] == "ru"): ?>МЕСЯЦ<?php else: ?>MONTH<?php endif; ?></span>
							</button>
							<button name = "vip_year" style = "background: #43b581; color: #f6f6f6; font-family: GothamSSm Narrow Medium; font-size: 10pt; padding-top: 15px; padding-bottom: 15px;padding-left: 25px; padding-right: 25px; border-radius: 6px; text-decoration: none; cursor: pointer; width: 100%; border: none; outline: none;">
								8.99$
								<span style = "height: 100%; font-family: GothamSSm Narrow Light; display: block;"><?php if($_SESSION['Language'] == "ru"): ?>ГОД<?php else: ?>YEAR<?php endif; ?></span>
							</button>
						</div>
						<button name = "vip_infinity" style = "margin-top: 20px; background: #4396b5; color: #f6f6f6; font-family: GothamSSm Narrow Medium; font-size: 10pt; padding-top: 15px; padding-bottom: 15px;padding-left: 25px; padding-right: 25px; border-radius: 6px; text-decoration: none; cursor: pointer; width: 100%; border: none; outline: none;">
								19.99$ <?php if($_SESSION['Language'] == "ru"): ?>ВЕЧНО<?php else: ?>INFINITY<?php endif; ?>
						</button>
					</div>
				</div>
				<div style="margin-top: 10pt; font-size: 10pt; color: #c07b7b; font-family: GothamSSm Narrow Medium;">
					<?php echo $success;?>
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
