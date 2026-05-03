<?php
include("../config/db.php");
include("../config/lang.php");

$item_id = $_GET['item'];

$conn->query("UPDATE items SET status='completed' WHERE id='$item_id'");

header("Location: inbox.php");
?>