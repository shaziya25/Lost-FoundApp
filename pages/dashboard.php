<?php
session_start();
include("../config/db.php");
include("../layouts/header.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$username = $_SESSION['user'];
$role = $_SESSION['role'] ?? 'user';
?>

<div class="container">

    <h2>👋 Welcome, <?= htmlspecialchars($username); ?></h2>

    <!-- SAFETY NOTICE -->
    <div class="notice">
        ⚠️ Do not share personal info.  
        Always verify item before handover using OTP.  
        Suspicious activity will be escalated to admin/police review system.
    </div>

    <div class="grid">

        <!-- CORE FEATURES -->
        <div class="card">
            <h3>➕ Post Item</h3>
            <div class="actions">
                <a href="post.php" class="btn green">Post</a>
            </div>
        </div>

        <div class="card">
            <h3>🔍 Browse Items</h3>
            <div class="actions">
                <a href="browse.php" class="btn cyan">Open</a>
            </div>
        </div>

        <div class="card">
            <h3>💬 Chat</h3>
            <div class="actions">
                <a href="chat_list.php" class="btn dark">Open</a>
            </div>
        </div>

        <div class="card">
            <h3>🔐 OTP System</h3>
            <div class="actions">
                <a href="my_otp.php" class="btn blue">View</a>
            </div>
        </div>

        <!-- REPORT SYSTEM -->
        <div class="card">
            <h3>🚨 Safety Reports</h3>
            <p style="font-size:13px;color:#94a3b8;">
                Items flagged as suspicious are reviewed here.
            </p>
            <div class="actions">
                <a href="report_list.php" class="btn red">Open Reports</a>
            </div>
        </div>

        <!-- ADMIN PANEL -->
        <?php if ($role === 'admin') { ?>
        <div class="card">
            <h3>🛠 Admin Panel</h3>
            <p style="font-size:13px;color:#94a3b8;">
                Manage users, items, reports.
            </p>
            <div class="actions">
                <a href="admin.php" class="btn red">Open</a>
            </div>
        </div>
        <?php } ?>

        <!-- GUIDE -->
        <div class="card">
            <h3>📘 User Guide</h3>
            <div class="actions">
                <a href="guide.php" class="btn blue">Read</a>
            </div>
        </div>

        <!-- LOGOUT -->
        <div class="card">
            <h3>🚪 Logout</h3>
            <div class="actions">
                <a href="../auth/logout.php" class="btn red">Logout</a>
            </div>
        </div>

    </div>
</div>

<?php include("../layouts/footer.php"); ?>