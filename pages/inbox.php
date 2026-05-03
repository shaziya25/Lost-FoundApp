<?php
session_start();
require_once("../config/db.php");
require_once("../layouts/header.php");

$user = $_SESSION['user_id'] ?? 0;

$sql = "SELECT claims.*, users.username, items.title, items.id AS item_id
FROM claims
JOIN items ON claims.item_id = items.id
JOIN users ON claims.claimant_id = users.id
WHERE items.user_id = '$user'
ORDER BY claims.id DESC";

$res = $conn->query($sql);

if(!$res){
    die("SQL ERROR: " . $conn->error);
}
?>

<div class="container">

<h2><?= t('inbox') ?></h2>

<?php if($res->num_rows == 0): ?>
<p><?= t('no_claims') ?></p>
<?php endif; ?>

<?php while($row = $res->fetch_assoc()): ?>

<div class="card">

<h3>📦 <?= $row['title'] ?></h3>
<p>👤 <?= $row['username'] ?></p>
<p>Status: <b><?= $row['status'] ?></b></p>

<?php if($row['status'] == "pending"): ?>
<div class="actions">
<a href="approve.php?id=<?= $row['id'] ?>" class="btn green">Approve</a>
<a href="reject.php?id=<?= $row['id'] ?>" class="btn red">Reject</a>
</div>
<?php endif; ?>

<?php if($row['status'] == "approved"): ?>
<p>🔐 OTP Ready</p>

<a href="otp_page.php?id=<?= $row['id'] ?>" class="btn blue">
Open OTP Page
</a>

<p class="notice">🔐 OTP sent to user</p>
<?php endif; ?>

<a href="chat.php?user=<?= $row['claimant_id'] ?>&item=<?= $row['item_id'] ?>" class="btn blue">
<?= t('chat') ?>
</a>

</div>

<?php endwhile; ?>

</div>

<?php require_once("../layouts/footer.php"); ?>