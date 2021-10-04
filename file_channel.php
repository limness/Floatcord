<?php
	ob_start();
	require_once 'connect.php';
	session_start();
	require_once 'language.php';

	$id_channel_search = $_GET['id'];
	$success = 0;

	# Getting the data of the current channel in the db
	$query = "SELECT id_channel FROM channels_files WHERE id_channel = '$id_channel_search'";
	$data = mysqli_query($connect, $query);

	if(mysqli_num_rows($data) == 1) {
		$insert = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `channels_files` WHERE `id_channel` = '". $id_channel_search. "'"));
	} else {
		header("Location: errno.php");
	}
	#####################################################

	$size_total_files = $insert['size'];

	if (isset($_SESSION['minuseSize'])) {
			$size_minus = $_SESSION['minuseSize'];
			$size_total_files -= $size_minus;

			if($size_total_files < 0) {
				$size_total_files = 0;
			}

			$query3 = "UPDATE channels_files SET size = '" . $size_total_files . "' WHERE id_channel = '". $id_channel_search . "'";
			$data = mysqli_query($connect, $query3);

	    unset($_SESSION['minuseSize']);
	}

	if (isset($_SESSION['flashMessage'])) {
			$success = $_SESSION['flashMessage'];
			unset($_SESSION['flashMessage']);
	} else {
		# Counting users on the current page
		$insert['userscount']++;
		$query = "UPDATE `channels_files` SET `userscount` = '" . $insert['userscount'] . "' WHERE `id_channel` = '". $id_channel_search. "'";
	  $data = mysqli_query($connect, $query);
	}

	if(isset($_FILES['image'])) {
		$file_name = $_FILES['image']['name'];
		$file_size = $_FILES['image']['size'];
		$file_tmp = $_FILES['image']['tmp_name'];
		$file_type = $_FILES['image']['type'];

		$size_total_files_kb = $size_total_files + $file_size;

		# From KB to MB
		$file_size = $file_size / 1024 / 1024;
		$file_size = round($file_size * 100) / 100;

		# Total MB
		$file_totals = $size_total_files;
		$file_totals = $file_totals / 1024 / 1024;
		$file_totals = round($file_totals * 100) / 100;

		$file_totals += $file_size;

		if($file_size > 250) {
			# If the file size exceeds 250 MB - show await message
			$_SESSION['flashMessage'] = 1;
			header("Location:" . $_SERVER['PHP_SELF'] . '?id=' . $_GET['id']);
		} else if($file_totals > 300) {
			# If the file size exceeds 300 MB - show error
			$_SESSION['flashMessage'] = 2;
			header("Location:" . $_SERVER['PHP_SELF'] . '?id=' . $_GET['id']);
		} else {
			# In other case just upload the file
			$query2 = "UPDATE `channels_files` SET `size` = '" . $size_total_files_kb . "' WHERE `id_channel` = '". $id_channel_search. "'";
			mysqli_query($connect, $query2);
			move_uploaded_file($file_tmp, "servers/". $id_channel_search ."/". $file_name);
		}
	}

	$dir = "servers/". $id_channel_search;
	$dh  = opendir($dir);

	$files = array();

	$b = 0;

	while (false !== ($filename = readdir($dh))) {
		if($filename != "." && $filename != "..") {
			$files[] = $filename;
			$b++;
		}
	}

	if(count($files) > 0) {
		rsort($files);
		for($j = 0; $j < $b; $j++) {
			if(isset($_POST['load_file_'. $j])) {
				$file = 'servers/'. $id_channel_search .'/'. $files[$j];
				header('Content-Type: application/x-force-download;');
				header("Content-Disposition: attachment; filename=\"".basename($files[$j])."\";");
				readfile($file);
				exit();
			}
		}
	}

	function delete_file($directory, $filename) {
		$dirs = opendir($directory);

		# Read the text of the dir
		while($file = readdir($dirs)) {
			# If the file is not file we want to delete
			if((is_file("$directory/$file")) && ("$directory/$file" == "$directory/$filename"))
			{
				$_SESSION['minuseSize'] = filesize("servers/". $_GET['id'] ."/". $file);

				# Delete this
				unlink("$directory/$file");
				header("Location:" . $_SERVER['PHP_SELF'] . '?id=' . $_GET['id']);

				# If this file is not in the directory - it has already been deleted.
				if(!file_exists($directory."/".$filename)) {
					return $s = TRUE;
				}
			}
		}
		closedir($dirs);
	}

	// for($j = 0; $j < $b; $j++) {
	// 	if(isset($_POST['delete_file_'. $j])) {
	// 		$file = 'servers/'. $id_channel_search .'/'. $files[$j];
	// 		delete_file('servers/'. $id_channel_search, $files[$j]);
	// 		break;
	// 	}
	// }
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

	<form method = "POST" enctype = "multipart/form-data">
		<div class="button">
			<div id = "name_channel" style="text-align: center;">
				<div id = "id_channel_text" style="margin-top: 100pt; margin-bottom: 10pt; color: #7bc0b6; font-family: GothamSSm Narrow Medium; font-size: 35pt; cursor: pointer;"><?php echo $insert['id_channel']; ?></div>
				<div style="margin-bottom: 20pt;">
					<img src="img/channel_settings.png" alt="Sooooon! :)" title="Sooooon! :)">
				</div>
			</div>
			<div id = "center_button">
				<div style = "background: #10131a; color: #1d222e; font-family: GothamSSm Narrow Medium; font-size: 10pt; display:inline-block; border-radius: 6px; text-decoration: none; overflow: auto; height: 600px; width: 700px; margin-right: 10pt; margin-bottom: 10pt;">
						<div style="margin-top: 45pt; margin-left: 45pt; margin-right: 45pt;">
							<input id = "load_file" type = "file" name = "image">
							<label id = "label_span" for = "load_file"><?php if($_SESSION['Language'] == "ru"): ?>Открыть файл<?php else: ?>Open file<?php endif; ?></label>
							<?php if($_SESSION['Language'] == "ru"): ?>
							<input type="submit" style = "visibility: hidden;" id = "submit_load" value = "Загрузить">
							<?php else: ?>
							<input type="submit" style = "visibility: hidden;" id = "submit_load" value = "Load">
							<?php endif; ?>
						</div>
						<div style="margin-top: 10pt; margin-left: 45pt; margin-right: 45pt; height: 75%; overflow: auto;">
							<?php
								if(count($files) > 0) {
									$i = 0;
									rsort($files);
									foreach($files as $value) {
										$file_size = filesize("servers/".$id_channel_search."/".$value);
										$file_size = $file_size / 1024 / 1024;
										$file_size = round($file_size * 100) / 100;

										echo '<div style = "font-size: 9pt; color: #ffffff; background-color: #181c25; display: inline-block; padding: 5pt; width: 220pt; border-radius: 6pt; font-family: GothamSSm Narrow Light;">'. $value .' </div>'; //background-color: #181c25; display: inline-block; padding: 15pt; width: 260pt;
										echo '<div style = "font-size: 9pt; color: #ffffff; background-color: #181c25; display: inline-block; padding: 5pt; width: 50pt; border-radius: 6pt; margin-left: 10pt; margin-bottom: 10pt; font-family: GothamSSm Narrow Medium;">'. $file_size . 'МБ</div>';

										if($_SESSION['Language'] == "ru") {
											echo '<button style = "font-size: 9pt; color: #ffffff; background-color: #78bfb9; border: none; outline: none; display: inline-block; padding: 5pt; border-radius: 6pt; margin-left: 10pt; font-family: GothamSSm Narrow Medium; cursor: pointer;" name = load_file_' . $i . '>' . 'Скачать' . '</button>';
											echo '<button style = "font-size: 9pt; color: #2b3140; background-color: rgba(0, 125, 215, 0); border: 1px solid #2b3140; outline: none; display: inline-block; padding: 5pt; border-radius: 6pt; margin-left: 10pt; font-family: GothamSSm Narrow Medium; cursor: pointer;" name = delete_file_' . $i . '>' . 'Удалить' . '</button>' . '<br/>';
										} else {
											echo '<button style = "font-size: 9pt; color: #ffffff; background-color: #78bfb9; border: none; outline: none; display: inline-block; padding: 5pt; border-radius: 6pt; margin-left: 10pt; font-family: GothamSSm Narrow Medium; cursor: pointer;" name = load_file_' . $i . '>' . 'Download' . '</button>';
											echo '<button style = "font-size: 9pt; color: #2b3140; background-color: rgba(0, 125, 215, 0); border: 1px solid #2b3140; outline: none; display: inline-block; padding: 5pt; border-radius: 6pt; margin-left: 10pt; font-family: GothamSSm Narrow Medium; cursor: pointer;" name = delete_file_' . $i . '>' . 'Remove' . '</button>' . '<br/>';
										}
										$i++;
									}
								}
							?>
						</div>
				</div>
				<div class="chat-container" style="margin-bottom: 10pt;">
		      <div class="chat-frame">
		        <div class="chat-fix" style="margin-top: 30px;">
		        </div>
		      </div>
		      <div style ="display: flex; justify-content: center;">
		        <input type="text" name="" placeholder="Введите сообщение для чата" class="input_chat">
		      </div>
	    	</div>
			</div>
		</div>
	</form>
	<script type = "text/javascript" src = "js/copy_channel_id.js"></script>
	<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
    	$(window).on('unload', function() {
    	    var url = document.URL;
					var id = url.substring(url.lastIndexOf('=') + 1);
        	var fd = new FormData();

        	fd.append('ajax_data', id);
        	navigator.sendBeacon('remove_files.php', fd);
        });
    </script>
	<script>
      $('body').ready(function() {
        var timer = setTimeout(update_messages, 400);
        var cout_message = 0;

        $('.input_chat').keypress(function (e) {
          if (e.which == 13) {
            if($('.input_chat').val().trim() != '') {
              put_message_to_server($('.input_username_chat').val(), $('.input_chat').val());
            } else {
              $('.input_chat').val('');
            }
            return false;
          }
        });

        function update_messages() {
					var session_id = /SESS\w*ID=([^;]+)/i.test(document.cookie) ? RegExp.$1 : false;

          $.ajax({
                type: "POST",
                url: 'chat_update_message.php',
    						dataType: "json",
								data: {
									id_channel: $('#id_channel_text').html()
								},
                success: function(data) {
									$('.chat-fix').html('');
									data.messages.forEach(function(item, i, arr) {
										if(session_id == data.sessions[i]) {
											$('.chat-fix').append('<div class="chat-fix-your" style="margin-left: 120px;"><div class="your-message-chat"><span style="font-family: GothamSSm Narrow Light;">You:</span><br>' + item + '</div></div>');
										} else {
											if(data.accesses[i] == 1) {
												$('.chat-fix').append('<div class="message-chat" style = "background: #e56565"><span style="font-family: GothamSSm Narrow Light;">' + data.usernames[i] + '</span><br>' + item + '</div>');
											} else {
												$('.chat-fix').append('<div class="message-chat"><span style="font-family: GothamSSm Narrow Light;">' + data.usernames[i] + '</span><br>' + item + '</div>');
											}
										}
									});
									if(data.messages.length > cout_message) {
										cout_message = data.messages.length;
										$('.chat-frame').scrollTop($('.chat-frame').prop('scrollHeight'));
									}
                }
           });
          timer = setTimeout(update_messages, 400);
        }

        function put_message_to_server(user, mes) {
          $.ajax({
                type: "POST",
                url: 'chat_put_message.php',
                data: {
                  message: mes,
                  username: user,
                  id_channel: $('#id_channel_text').html()
                },
                success: function(response) {
                  $('.chat-fix').append('<div class="chat-fix-your" style="margin-left: 120px;"><div class="your-message-chat"><span style="font-family: GothamSSm Narrow Light;">You:</span><br>' + $('.input_chat').val() + '</div></div>');
                  last_message = $('.input_chat').val();

                  $('.input_chat').val('');
                  $('.chat-frame').scrollTop($('.chat-frame').prop('scrollHeight'));
                }
           });
         }
      });
    </script>
	<script type = "text/javascript" src = "js/loaderfile.js"></script>
	<script type = "text/javascript" src = "js/scriptFon.js"></script>
</body>
</html>

<?php
ob_end_flush();
?>
