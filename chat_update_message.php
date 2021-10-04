<?php
    require_once 'connect.php';

    $id_channel = $_POST['id_channel'];

    $query = "SELECT `id`, `message`, `session`, `username`, `access` FROM `messages` WHERE `id_channel` = '" . $id_channel . "'";
    $result = mysqli_query($connect, $query);

    $messages = array();
    $sessions = array();
    $usernames = array();
    $accesses = array();

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        array_push($messages, $row['message']);
        array_push($sessions, $row['session']);
        array_push($usernames, $row['username']);
        array_push($accesses, $row['access']);
    }

    echo json_encode(array("messages" => $messages, "sessions" => $sessions, "usernames" => $usernames, "accesses" => $accesses));
  ?>
