<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

include("../layouts/header.php");
?>

<div class="container">

    <h2><?= t('Welcome') ?>, <?php echo $_SESSION['user']; ?> 👋</h2>

    <div class="notice">
        ⚠️ Do not share personal data or location in chat. under any circumstances.
         Always verify item before accepting. Use OTP for handover. For high value items, report to police.
    </div>

    <div class="grid">
<div class="card">
    <h3>🛠 Admin Panel</h3>
    <div class="actions">
        <a href="admin.php" class="btn red">Open</a>
    </div>
</div>
<div class="card">
    <h3>🔐 My OTP</h3>
    <div class="actions">
        <a href="my_otp.php" class="btn blue">Open</a>
    </div>
</div>
        <div class="card">
            <h3>📘 User Guide</h3>
            <div class="actions">
               <a href="guide.php" class="btn blue">Open</a>
            </div>
        </div>

        <div class="card">
            <h3>➕ Post Item</h3>
            <div class="actions">
                <a href="post.php" class="btn green">Post</a>
            </div>
        </div>

        <div class="card">
            <h3>🔍 Browse Items</h3>
            <div class="actions">
                <a href="browse.php" class="btn cyan">Browse</a>
            </div>
        </div>

        <div class="card">
            <h3>💬 Chat Panel</h3>
            <div class="actions">
                <a href="chat_list.php" class="btn dark">Open</a>
            </div>
        </div>

        <div class="card">
            <h3>📥 Inbox</h3>
            <div class="actions">
                <a href="inbox.php" class="btn gray">Claims</a>
            </div>
        </div>

        <div class="card">
            <h3>🚪 Logout</h3>
            <div class="actions">
                <a href="../auth/logout.php" class="btn red">Logout</a>
            </div>
        </div>

    </div>

</div>

<?php include("../layouts/footer.php"); ?>