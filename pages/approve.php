<?php
session_start();
include("../config/db.php");

$id = $_GET['id'] ?? 0;

if($id == 0){
    die("Invalid request");
}

// GET CLAIM
$q = $conn->query("SELECT * FROM claims WHERE id='$id'");
$data = $q->fetch_assoc();

$item_id = $data['item_id'];

// GENERATE OTP
$otp = rand(100000,999999);

// SAVE OTP + APPROVE
$conn->query("UPDATE claims SET status='approved', otp='$otp' WHERE id='$id'");

// REJECT OTHERS
$conn->query("UPDATE claims SET status='rejected' WHERE item_id='$item_id' AND id != '$id'");

// MARK ITEM CLAIMED
$conn->query("UPDATE items SET status='claimed' WHERE id='$item_id'");

// REDIRECT
header("Location: inbox.php?approved=1");
exit();
?>