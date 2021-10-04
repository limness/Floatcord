<?php
    ob_start();
    session_start();

  	require_once 'connect.php';

    $message = $_POST['message'];
    $username = $_POST['username'];
    $id_channel = $_POST['id_channel'];

    $sess = session_id();
    $sql_total = "INSERT INTO messages (`id_channel`, `username`, `session`, `message`) VALUES ('$id_channel', '$username', '$sess', '$message')";
    mysqli_query($connect, $sql_total);

    ob_end_flush();
?>
