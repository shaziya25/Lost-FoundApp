<?php
session_start();
include("../config/db.php");
include("../layouts/header.php");

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Access Denied");
}

$reports = $conn->query("
SELECT reports.*, users.username, items.title
FROM reports
JOIN users ON reports.reporter_id = users.id
JOIN items ON reports.item_id = items.id
ORDER BY reports.id DESC
");
?>

<div class="container">

<h2 class="page-title">🚨 Safety Reports</h2>
<p class="page-sub">Monitor suspicious activity & protect users</p>

<div class="grid">

<?php if($reports && $reports->num_rows > 0): ?>

<?php while($r = $reports->fetch_assoc()): ?>

<div class="card report-card">

    <div class="report-header">
        <h3>📦 <?= htmlspecialchars($r['title']) ?></h3>

        <?php if($r['status'] == 'pending'): ?>
            <span class="badge warning">Pending</span>
        <?php else: ?>
            <span class="badge success">Reviewed</span>
        <?php endif; ?>
    </div>

    <div class="report-body">
        <p><b>👤 Reporter:</b> <?= htmlspecialchars($r['username']) ?></p>
        <p><b>🚨 Reason:</b> <?= htmlspecialchars($r['reason']) ?></p>
        <p><b>📍 Location:</b> <?= htmlspecialchars($r['location']) ?></p>
        <p><b>⏱ Time:</b> <?= $r['created_at'] ?></p>
    </div>

    <div class="actions">
        <?php if($r['status'] == 'pending'): ?>
            <a href="mark_reviewed.php?id=<?= $r['id'] ?>" class="btn green">
                ✔ Mark Reviewed
            </a>
        <?php endif; ?>

        <a href="browse.php" class="btn dark">View Item</a>
    </div>

</div>

<?php endwhile; ?>

<?php else: ?>
<div class="empty-state">
    <h3>🎉 No Reports Yet</h3>
    <p>System is clean. No suspicious activity detected.</p>
</div>
<?php endif; ?>

</div>
</div>

<?php include("../layouts/footer.php"); ?>