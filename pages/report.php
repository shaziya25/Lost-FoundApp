<?php
session_start();
include("../config/db.php");
include("../layouts/header.php");

$item_id = $_GET['id'] ?? null;

if (!$item_id) {
    die("<div class='container'><h3>❌ Invalid request</h3></div>");
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['submit'])) {

    $reason = $_POST['reason'];
    $location = $_POST['location'];

    $conn->query("
        INSERT INTO reports(item_id, reporter_id, reason, location)
        VALUES('$item_id','$user_id','$reason','$location')
    ");

    echo "<script>
        alert('Report submitted successfully');
        window.location='browse.php';
    </script>";
}
?>

<div class="container">

<div class="form-card">

    <h2>🚨 Report Suspicious Item</h2>

    <form method="POST">

        <label>Reason</label>
        <textarea name="reason" placeholder="Explain issue..." required></textarea>

        <label>Your Location</label>
        <input type="text" name="location" placeholder="e.g. Mumbai, Andheri West" required>

        <button name="submit" class="btn red">Submit Report</button>

    </form>

</div>

</div>

<?php include("../layouts/footer.php"); ?>