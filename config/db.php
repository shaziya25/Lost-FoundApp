<?php
$conn = new mysqli("localhost", "root", "", "lost_found22");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>