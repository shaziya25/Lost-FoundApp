<?php
session_start();
include("../config/db.php");

$sender = $_SESSION['user_id'];
$receiver = $_POST['receiver'];
$item_id = $_POST['item_id'];
$msg = $_POST['msg'];

$conn->query("
INSERT INTO messages (sender_id, receiver_id, item_id, message)
VALUES ('$sender','$receiver','$item_id','$msg')
");
?>