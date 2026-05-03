<?php
session_start();
require_once("../config/db.php");
require_once("../layouts/header.php");

$user_id = $_SESSION['user_id'] ?? 0;

$search = $_GET['search'] ?? '';

if (!empty($search)) {

    $stmt = $conn->prepare("
        SELECT * FROM items 
        WHERE title LIKE ? OR location LIKE ? 
        ORDER BY id DESC
    ");

    $like = "%$search%";
    $stmt->bind_param("ss", $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();

} else {
    $result = $conn->query("SELECT * FROM items ORDER BY id DESC");
}
?>

<div class="container">

<h2>🔍 Browse Items</h2>

<form method="GET" class="search-bar">
    <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search items...">
    <button class="btn blue">Search</button>
</form>

<div class="grid">

<?php if ($result && $result->num_rows > 0): ?>
<?php while ($row = $result->fetch_assoc()): ?>

<?php
$isOwner = ($row['user_id'] == $user_id);
?>

<div class="card item-card">

    <img src="<?= htmlspecialchars($row['image']) ?>">

    <h3 class="item-title">📦 <?= htmlspecialchars($row['title']) ?></h3>

    <p>📍 <?= htmlspecialchars($row['location']) ?></p>

    <span class="badge <?= $row['type'] == 'lost' ? 'lost' : 'found' ?>">
        <?= ucfirst($row['type']) ?>
    </span>

    <div class="actions">

        <!-- OWNER -->
        <?php if ($isOwner): ?>

            <form method="POST" action="delete.php">
                <input type="hidden" name="item_id" value="<?= $row['id'] ?>">
                <button class="btn red">Delete</button>
            </form>

            <a href="edit.php?id=<?= $row['id'] ?>" class="btn gray">Edit</a>

        <?php else: ?>

            <?php if ($row['type'] == 'found'): ?>
                <form method="POST" action="claim.php">
                    <input type="hidden" name="item_id" value="<?= $row['id'] ?>">
                    <button class="btn green">Claim</button>
                </form>
            <?php else: ?>
                <a href="chat.php?user=<?= $row['user_id'] ?>&item=<?= $row['id'] ?>" class="btn dark">
                    Contact Owner
                </a>
            <?php endif; ?>

        <?php endif; ?>

        <!-- ALWAYS REPORT -->
        <a href="report.php?id=<?= $row['id'] ?>" class="btn red">
            🚨 Report
        </a>

        <!-- ALWAYS CHAT -->
        <a href="chat.php?user=<?= $row['user_id'] ?>&item=<?= $row['id'] ?>" class="btn blue">
            Chat
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