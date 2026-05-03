<?php
session_start();
include("../config/db.php");
include("../layouts/header.php");

// ✅ ADMIN CHECK
if($_SESSION['user_id'] != 1){
    die("Access Denied");
}

// USERS
$users = $conn->query("SELECT * FROM users ORDER BY id DESC");

// ITEMS
$items = $conn->query("SELECT * FROM items ORDER BY id DESC");

// CLAIMS
$claims = $conn->query("
SELECT claims.*, users.username, items.title 
FROM claims
JOIN users ON claims.claimant_id = users.id
JOIN items ON claims.item_id = items.id
ORDER BY claims.id DESC
");
?>

<div class="container">

<h2>🛠 Admin Panel</h2>

<div class="grid">

<!-- USERS -->
<div class="card">
<h3>👤 Users</h3>
<a href="edit_item.php?id=<?= $i['id'] ?>" class="btn blue">Edit</a>
<?php while($u = $users->fetch_assoc()): ?>
<div class="admin-row">
    <div>
        <b><?= $u['username'] ?></b><br>
        <small><?= $u['email'] ?></small>
    </div>

    <div class="actions">
        <a href="ban_user.php?id=<?= $u['id'] ?>" class="btn red">Ban</a>
        <a href="delete_user.php?id=<?= $u['id'] ?>" class="btn dark">Delete</a>
    </div>
</div>
<?php endwhile; ?>

</div>

<!-- ITEMS -->
<div class="card">
<h3>📦 Items</h3>

<?php while($i = $items->fetch_assoc()): ?>
<div class="admin-row">
    <div>
        <b><?= $i['title'] ?></b><br>
        <small>Status: <?= $i['status'] ?></small>
    </div>

    <div class="actions">
        <a href="delete_item.php?id=<?= $i['id'] ?>" class="btn red">Delete</a>
    </div>
</div>
<?php endwhile; ?>

</div>

<!-- CLAIMS -->
<div class="card">
<h3>📥 Claims</h3>

<?php while($c = $claims->fetch_assoc()): ?>
<div class="admin-row">
    <div>
        <b><?= $c['title'] ?></b><br>
        <small><?= $c['username'] ?> → <?= $c['status'] ?></small>
    </div>
</div>
<?php endwhile; ?>

</div>

</div>

</div>

<?php include("../layouts/footer.php"); ?>