<?php
session_start();
require_once("../config/db.php");

if (!isset($_SESSION['user_id'])) exit();

$sender = $_SESSION['user_id'];
$receiver = $_GET['receiver'] ?? 0;
$item_id = $_GET['item_id'] ?? 0;

/* GET MESSAGES */
$sql = "SELECT * FROM messages 
        WHERE item_id='$item_id'
        AND (
            (sender_id='$sender' AND receiver_id='$receiver')
            OR
            (sender_id='$receiver' AND receiver_id='$sender')
        )
        ORDER BY id ASC";

$res = $conn->query($sql);

if(!$res){
    die("DB Error: " . $conn->error);
}

/* SHOW MESSAGES */
while($row = $res->fetch_assoc()){

    $class = ($row['sender_id'] == $sender) ? "me" : "other";

    echo "<div class='msg $class'>";
    echo "<span class='delete-btn' onclick='deleteMsg(".$row['id'].")'>🗑</span>";
    /* TEXT */
    if(!empty($row['message'])){
        echo "<div class='text'>".$row['message']."</div>";
    }

    /* IMAGE */
    if(!empty($row['image'])){
        echo "<img src='../uploads/".$row['image']."' class='chat-img'>";
    }

    echo "</div>";
}
?>