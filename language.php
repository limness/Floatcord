<?php
	if(!isset($_SESSION['Language'])) {
		$_SESSION['Language'] = '';
		$langs = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

		if($langs == 'ru') {
			$_SESSION['Language'] = 'ru';
		} else {
			$_SESSION['Language'] = 'en';
		}
	}

	if (isset($_POST['selectEnglish'])) {
		$_SESSION['Language'] = 'en';
	}
	if (isset($_POST['selectRussia'])) {
		$_SESSION['Language'] = 'ru';
	}
?>
