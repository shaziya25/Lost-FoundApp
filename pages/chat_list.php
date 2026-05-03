<?php
session_start();
require_once("../config/db.php");
require_once("../layouts/header.php");

$user = $_SESSION['user_id'];

$q = $conn->query("
SELECT 
    u.id, 
    u.username,
    MAX(m.item_id) as item_id
FROM messages m
JOIN users u ON (
    (u.id = m.sender_id AND m.receiver_id = '$user')
    OR 
    (u.id = m.receiver_id AND m.sender_id = '$user')
)
GROUP BY u.id
ORDER BY MAX(m.id) DESC
");
?>

<div class="container">
<h2>💬 Chats</h2>

<div class="chat-list">

<?php if($q && $q->num_rows > 0): ?>
<?php while($row = $q->fetch_assoc()): ?>

<a class="chat-card" href="chat.php?user=<?= $row['id'] ?>&item=<?= $row['item_id'] ?>">

    <div class="avatar"><?= strtoupper(substr($row['username'],0,1)) ?></div>

    <div class="chat-info">
        <div class="name"><?= $row['username'] ?></div>
        <div class="time">Open chat</div>
    </div>

</a>

<?php endwhile; ?>
<?php else: ?>
<p>No chats yet</p>
<?php endif; ?>

</div>
</div>

<?php require_once("../layouts/footer.php"); ?>