<?php
	ob_start();
	require_once 'connect.php';
	session_start();

	$id_channel_search = $_POST["ajax_data"];

	$sql_total = "INSERT INTO logs_id_remove (id_channel_for_delete, txt) VALUES ('$id_channel_search', '1')";
	mysqli_query($connect, $sql_total);

	# Counting users on the current page
	$insert = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `channels_txt` WHERE `id_channel` = '". $id_channel_search. "'"));
	$userscount = $insert['userscount'];
	$userscount--;
	####################################

	# There is no one user on the channel at the moment
	if($userscount < 1) {
		# If the channel is not admin panel and it has'nt VIP status - remove
		if($id_channel_search != 777 && $insert['vip_status'] != 1) {
			# Destroy from DB all channels
			$query = "DELETE FROM channels_txt WHERE id_channel = '". $id_channel_search. "'";
			$data = mysqli_query($connect, $query);
			# Destroy from dir all folders
			if(trim($id_channel_search) != '') {
				delete_tree('servers/' . $id_channel_search);
			}
		}
	} else {
		$query = "UPDATE channels_txt SET userscount = '" . $userscount . "' WHERE id_channel = '". $id_channel_search. "'";
		$data = mysqli_query($connect, $query);
	}

	####################################

	function delete_tree($dir) {
		$files = array_diff(scandir($dir), array('.','..'));
		foreach ($files as $file) {
			(is_dir("$dir/$file")) ? delete_tree("$dir/$file") : unlink("$dir/$file");
		}
		return rmdir($dir);
	}

	ob_end_flush();
?>
