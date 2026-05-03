<?php
session_start();
require_once("../config/db.php");

header('Content-Type: application/json');

if(!isset($_SESSION['user_id'])){
    echo json_encode(["status"=>"error","msg"=>"unauthorized"]);
    exit();
}

$user = $_SESSION['user_id'];
$id = intval($_GET['id'] ?? 0);

if($id == 0){
    echo json_encode(["status"=>"error","msg"=>"invalid id"]);
    exit();
}

/* DELETE ONLY OWN MESSAGE */
$sql = "DELETE FROM messages 
        WHERE id='$id' 
        AND sender_id='$user'";

if($conn->query($sql)){
    echo json_encode(["status"=>"success"]);
} else {
    echo json_encode(["status"=>"error","msg"=>$conn->error]);
}
?>