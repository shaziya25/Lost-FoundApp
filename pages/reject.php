<?php
include("../config/db.php");

$id = $_GET['id'];

$conn->query("UPDATE claims SET status='rejected' WHERE id='$id'");

header("Location: inbox.php");
?>