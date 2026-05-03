<?php
session_start();
include("../config/db.php");
include("../layouts/header.php");

$user = $_SESSION['user_id'];

// GET USER APPROVED CLAIMS
$q = $conn->query("
SELECT claims.*, items.title, items.location 
FROM claims
JOIN items ON claims.item_id = items.id
WHERE claims.claimant_id='$user' 
AND claims.status='approved'
ORDER BY claims.id DESC
");

?>

<div class="container">

<h2>🔐 Your OTPs</h2>

<?php if($q->num_rows == 0): ?>
<p>No approved claims yet</p>
<?php endif; ?>

<?php while($row = $q->fetch_assoc()): ?>

<div class="card">

<h3>📦 <?= $row['title'] ?></h3>
<p>📍 <?= $row['location'] ?></p>

<p><b>OTP:</b> <?= $row['otp'] ?></p>

<div class="notice">
⚠️ Save this OTP. You must tell this to the owner during item handover.
</div>

<a href="verify_otp.php?id=<?= $row['id'] ?>" class="btn green">
Verify / Complete
</a>

</div>

<?php endwhile; ?>

</div>

<?php include("../layouts/footer.php"); ?>