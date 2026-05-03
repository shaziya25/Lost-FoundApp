<?php


// If user already logged in → go to dashboard
if (isset($_SESSION['user'])) {
    header("Location: pages/dashboard.php");
} else {
    header("Location: auth/login.php");
}
exit();
?>
