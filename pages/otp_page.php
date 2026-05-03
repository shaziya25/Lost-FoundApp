<?php
session_start();
require_once("../config/db.php");
require_once("../layouts/header.php");

$id = $_GET['id'] ?? 0;

if($id == 0){
    die("Invalid ID");
}

$q = $conn->query("
SELECT claims.*, items.title, items.location
FROM claims
JOIN items ON claims.item_id = items.id
WHERE claims.id='$id'
");

if(!$q || $q->num_rows == 0){
    die("Claim not found");
}

$data = $q->fetch_assoc();
?>

<div class="container">

<div class="form-card">

<h2>🔐 OTP Page</h2>

<div class="card">
    <h3><?= $data['title'] ?></h3>
    <p>📍 <?= $data['location'] ?></p>
    <p><b>OTP:</b> <?= $data['otp'] ?? 'Not Generated' ?></p>
</div>

<form method="POST" action="verify_otp.php?id=<?= $id ?>">
    <input type="text" name="otp" placeholder="Enter OTP">
    <button class="btn green">Verify & Complete</button>
</form>

</div>

</div>

<?php require_once("../layouts/footer.php"); ?>