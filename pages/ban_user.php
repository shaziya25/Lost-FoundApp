<?php
session_start();
include("../config/db.php");

if($_SESSION['user_id'] != 1) die("Access Denied");

$id = $_GET['id'];

// simple ban (add column if needed)
$conn->query("UPDATE users SET banned=1 WHERE id='$id'");

header("Location: admin.php");