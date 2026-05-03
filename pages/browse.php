<?php
session_start();
require_once("../config/db.php");
require_once("../layouts/header.php");

$search = $_GET['search'] ?? '';

if($search){
    $result = $conn->query("SELECT * FROM items 
        WHERE title LIKE '%$search%' OR location LIKE '%$search%' 
        ORDER BY id DESC");
} else {
    $result = $conn->query("SELECT * FROM items ORDER BY id DESC");
}
?>

<div class="container">

<h2><?= t('browse') ?></h2>

<?php if(isset($_GET['posted'])): ?>
<div class="notice">✅ Item posted successfully</div>
<?php endif; ?>

<form method="GET" class="search-bar">
    <input type="text" name="search" value="<?= $search ?>" placeholder="<?= t('search_items') ?>">
    <button class="btn blue"><?= t('search') ?></button>
</form>

<div class="grid">

<?php if($result && $result->num_rows > 0): ?>
<?php while($row = $result->fetch_assoc()): ?>

<div class="card item-card">

<img src="<?= $row['image'] ?>">

<h3 class="item-title">📦 <?= $row['title'] ?></h3>
<p>📍 <?= $row['location'] ?></p>

<span class="badge <?= $row['type']=='lost' ? 'lost' : 'found' ?>">
<?= ucfirst($row['type']) ?>
</span>

<div class="actions">

<?php if($row['user_id'] == $_SESSION['user_id']): ?>

<form method="POST" action="delete.php">
<input type="hidden" name="item_id" value="<?= $row['id'] ?>">
<button class="btn red">Delete</button>
</form>

<a href="edit.php?id=<?= $row['id'] ?>" class="btn gray">Edit</a>

<?php elseif($row['type']=='found'): ?>

<form method="POST" action="claim.php">
<input type="hidden" name="item_id" value="<?= $row['id'] ?>">
<button class="btn green"><?= t('claim') ?></button>
</form>

<?php else: ?>

<a href="chat.php?user=<?= $row['user_id'] ?>&item=<?= $row['id'] ?>" class="btn dark">
<?= t('contact_owner') ?>
</a>

<?php endif; ?>

<a href="chat.php?user=<?= $row['user_id'] ?>&item=<?= $row['id'] ?>" class="btn blue">
<?= t('chat') ?>
</a>

</div>
</div>

<?php endwhile; ?>
<?php else: ?>
<p>No items found</p>
<?php endif; ?>

</div>
</div>

<?php require_once("../layouts/footer.php"); ?>