<?php
session_start();
require_once("../config/db.php");

$sender = $_SESSION['user_id'];
$receiver = $_POST['receiver'];
$item_id = $_POST['item_id'];
$msg = $_POST['msg'] ?? "";

/* IMAGE UPLOAD */
$imageName = null;

if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

    $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $imageName = time().rand(1000,9999).".".$ext;

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        "../uploads/".$imageName
    );
}

/* SAVE MESSAGE */
$conn->query("INSERT INTO messages (sender_id, receiver_id, item_id, message, image)
VALUES ('$sender','$receiver','$item_id','$msg','$imageName')");
?>