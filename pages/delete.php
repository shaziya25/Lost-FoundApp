<?php
session_start();
include("../config/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user = $_SESSION['user_id'];
$item = $_POST['item_id'] ?? 0;

if(!$item){
    die("Invalid item");
}

// 🔒 SECURITY: delete only own post
$conn->query("DELETE FROM items WHERE id='$item' AND user_id='$user'");

header("Location: browse.php");
exit();