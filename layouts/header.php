<?php
require_once("../config/lang.php");
include("../config/db.php");

$user = $_SESSION['user_id'] ?? 0;

// 🔔 COUNT UNREAD MESSAGES
$msg_count = 0;
if($user){
    $q = $conn->query("SELECT COUNT(*) as total FROM messages 
    WHERE receiver_id='$user' AND seen=0");
    if($q){
        $msg_count = $q->fetch_assoc()['total'];
    }
}

// 🔔 COUNT PENDING CLAIMS
$claim_count = 0;
if($user){
    $q2 = $conn->query("SELECT COUNT(*) as total 
    FROM claims 
    JOIN items ON claims.item_id = items.id
    WHERE items.user_id='$user' AND claims.status='pending'");
    if($q2){
        $claim_count = $q2->fetch_assoc()['total'];
    }
}

$total_notify = $msg_count + $claim_count;
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LF App</title>

<link rel="stylesheet" href="/lf_app/assets/css/style.css?v=10">

<style>
.badge-notify{
    background:red;
    color:white;
    border-radius:50%;
    padding:3px 7px;
    font-size:12px;
    margin-left:5px;
}
</style>

</head>

<body>

<div class="header">

<div class="logo">🔍 LF App</div>

<div class="nav">
    <a href="dashboard.php"><?= t('dashboard') ?></a>
    <a href="post.php"><?= t('post') ?></a>
    <a href="browse.php"><?= t('browse') ?></a>

    <a href="chat_list.php">
        💬Chats
        <?php if($msg_count > 0): ?>
        <span class="badge-notify"><?= $msg_count ?></span>
        <?php endif; ?>
    </a>

    <a href="inbox.php">
        📥Inbox
        <?php if($claim_count > 0): ?>
        <span class="badge-notify"><?= $claim_count ?></span>
        <?php endif; ?>
    </a>

    <a href="../auth/logout.php"><?= t('logout') ?></a>
</div>

<div class="lang-switch">
    <a href="../lang_switch.php?lang=en">EN</a>
    <a href="../lang_switch.php?lang=hi">हिंदी</a>
</div>

</div>