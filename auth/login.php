<?php
session_start();
include("../config/db.php");

$error = "";

if(isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result && $result->num_rows > 0){

        $user = $result->fetch_assoc();

        // ✅ FIX: supports BOTH bcrypt + old MD5 users
        if (
            password_verify($password, $user['password']) 
            || $user['password'] === md5($password)
        ) {

            $_SESSION['user'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'] ?? 'user';

            header("Location: ../pages/dashboard.php");
            exit();

        } else {
            $error = "❌ Invalid password!";
        }

    } else {
        $error = "❌ User not found!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<style>
body{
    margin:0;
    font-family:Segoe UI;
    background: linear-gradient(135deg,#0f172a,#020617);
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.auth-box{
    width:360px;
    padding:35px;
    border-radius:18px;
    background: rgba(255,255,255,0.06);
    border:1px solid rgba(255,255,255,0.1);
    backdrop-filter: blur(12px);
    color:white;
    text-align:center;
}

input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border-radius:10px;
    border:1px solid rgba(255,255,255,0.1);
    background:#0b1220;
    color:white;
}

button{
    width:100%;
    padding:12px;
    background:#3b82f6;
    border:none;
    border-radius:10px;
    color:white;
    font-weight:bold;
    cursor:pointer;
}

.error{
    background: rgba(239,68,68,0.15);
    padding:10px;
    border-radius:8px;
    margin-bottom:10px;
}
</style>
</head>

<body>

<div class="auth-box">

<h2>🔍 Login</h2>

<?php if($error != ""): ?>
<div class="error"><?= $error ?></div>
<?php endif; ?>

<form method="POST">

<input type="email" name="email" placeholder="Email" required>

<div style="position:relative;">
    <input type="password" id="password" name="password" placeholder="Password" required>

    <span onclick="togglePassword()" 
          style="position:absolute; right:12px; top:50%; transform:translateY(-50%); cursor:pointer;">
        👁
    </span>
</div>

<button type="submit" name="login">Login</button>

</form>

<p style="margin-top:15px;">
No account? <a href="register.php">Register</a>
</p>

</div>

<script>
function togglePassword(){
    const pass = document.getElementById("password");
    pass.type = pass.type === "password" ? "text" : "password";
}
</script>

</body>
</html>