<?php
session_start();
include("../config/db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$user = $_SESSION['user_id'];
$item = $_POST['item_id'] ?? 0;

// ❌ invalid request
if($item == 0){
    die("Invalid item");
}

// 🔍 Check item owner
$check = $conn->query("SELECT user_id FROM items WHERE id='$item'");
$data = $check->fetch_assoc();

// ❌ prevent self-claim
if($data['user_id'] == $user){
    echo "<script>alert('❌ You cannot claim your own item'); window.history.back();</script>";
    exit();
}

// ❌ prevent duplicate claim
$dup = $conn->query("SELECT * FROM claims WHERE claimant_id='$user' AND item_id='$item'");
if($dup->num_rows > 0){
    echo "<script>alert('⚠️ Already claimed'); window.history.back();</script>";
    exit();
}

// ✅ insert claim
$conn->query("
INSERT INTO claims (claimant_id, item_id, status) 
VALUES ('$user','$item','pending')
");

// ✅ redirect with message
header("Location: browse.php?msg=1");
exit();