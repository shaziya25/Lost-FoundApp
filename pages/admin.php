<?php
session_start();
include("../config/db.php");
include("../layouts/header.php");

// ✅ ROLE CHECK
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    die("Access Denied");
}

// ===== DATA =====
$users = $conn->query("SELECT * FROM users ORDER BY id DESC");
$items = $conn->query("SELECT * FROM items ORDER BY id DESC");
$reports = $conn->query("SELECT * FROM reports WHERE status='pending'");

// COUNTS (dashboard stats)
$totalUsers = $conn->query("SELECT COUNT(*) as c FROM users")->fetch_assoc()['c'];
$totalItems = $conn->query("SELECT COUNT(*) as c FROM items")->fetch_assoc()['c'];
$totalReports = $conn->query("SELECT COUNT(*) as c FROM reports WHERE status='pending'")->fetch_assoc()['c'];
?>

<div class="container">

<h2 class="page-title">🛠 Admin Dashboard</h2>
<p class="page-sub">Control panel for managing users, items & safety</p>

<!-- 🔢 STATS -->
<div class="grid stats">

<div class="stat-card">
    <h3>👤 Users</h3>
    <p><?= $totalUsers ?></p>
</div>

<div class="stat-card">
    <h3>📦 Items</h3>
    <p><?= $totalItems ?></p>
</div>

<div class="stat-card danger">
    <h3>🚨 Open Reports</h3>
    <p><?= $totalReports ?></p>
</div>

</div>

<!-- 🚨 QUICK ACTION -->
<div class="quick-actions">
    <a href="report_list.php" class="btn red">🚨 View Reports</a>
</div>

<div class="grid">

<!-- 👤 USERS -->
<div class="card admin-section">

<h3>👤 Users</h3>

<?php while($u = $users->fetch_assoc()): ?>
<div class="admin-row">
    <div>
        <b><?= htmlspecialchars($u['username']) ?></b><br>
        <small><?= htmlspecialchars($u['email']) ?></small>
    </div>

    <div class="actions">
        <a href="ban_user.php?id=<?= $u['id'] ?>" class="btn red">Ban</a>
        <a href="delete_user.php?id=<?= $u['id'] ?>" class="btn dark">Delete</a>
    </div>
</div>
<?php endwhile; ?>

</div>

<!-- 📦 ITEMS -->
<div class="card admin-section">

<h3>📦 Items</h3>

<?php while($i = $items->fetch_assoc()): ?>
<div class="admin-row">
    <div>
        <b><?= htmlspecialchars($i['title']) ?></b><br>
        <small><?= htmlspecialchars($i['location']) ?></small>
    </div>

    <div class="actions">
        <a href="delete_item.php?id=<?= $i['id'] ?>" class="btn red">Delete</a>
    </div>
</div>
<?php endwhile; ?>

</div>

<!-- 🚨 REPORTS PREVIEW -->
<div class="card admin-section">

<h3>🚨 Recent Reports</h3>

<?php if($reports->num_rows > 0): ?>
<?php while($r = $reports->fetch_assoc()): ?>
<div class="admin-row">
    <div>
        <b>Item ID: <?= $r['item_id'] ?></b><br>
        <small><?= htmlspecialchars($r['reason']) ?></small>
    </div>

    <div class="actions">
        <a href="mark_reviewed.php?id=<?= $r['id'] ?>" class="btn green">Resolve</a>
    </div>
</div>
<?php endwhile; ?>
<?php else: ?>
<p style="color:#9ca3af;">No active reports 🎉</p>
<?php endif; ?>

</div>

</div>

</div>

<?php include("../layouts/footer.php"); ?>