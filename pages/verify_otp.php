<?php
session_start();
include("../config/db.php");
include("../layouts/header.php");

$id = $_GET['id'];

if(isset($_POST['verify'])){

    $entered = $_POST['otp'];

    $q = $conn->query("SELECT * FROM claims WHERE id='$id'");
    $data = $q->fetch_assoc();

    if($entered == $data['otp']){

        $conn->query("UPDATE items SET status='completed' WHERE id='".$data['item_id']."'");

        echo "<script>alert('✅ Item Handed Over Successfully'); window.location='inbox.php';</script>";
        exit();

    } else {
        echo "<script>alert('❌ Wrong OTP');</script>";
    }
}
?>

<div class="container">
<div class="form-card">

<h2>🔐 Verify OTP</h2>

<form method="POST">
<input type="text" name="otp" placeholder="Enter OTP">
<button name="verify" class="btn green">Verify & Complete</button>
</form>

</div>
</div>

<?php include("../layouts/footer.php"); ?>