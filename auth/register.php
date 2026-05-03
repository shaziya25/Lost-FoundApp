<?php
session_start();
require_once("../config/db.php");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - LF App</title>

<link rel="stylesheet" href="/lf_app/assets/css/style.css?v=20">

<style>
body{
    background: linear-gradient(135deg,#0f172a,#020617);
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    margin:0;
    font-family: sans-serif;
}

.auth-box{
    background:#111827;
    padding:40px;
    border-radius:20px;
    width:350px;
    box-shadow:0 0 30px rgba(0,0,0,0.6);
    text-align:center;
}

.auth-box h2{
    color:#fff;
    margin-bottom:10px;
}

.auth-box p{
    color:#9ca3af;
    margin-bottom:20px;
}

.auth-box input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border:none;
    border-radius:10px;
    background:#1f2937;
    color:#fff;
}

.auth-box button{
    width:100%;
    padding:12px;
    border:none;
    border-radius:10px;
    background:#3b82f6;
    color:#fff;
    font-weight:bold;
    cursor:pointer;
    margin-top:10px;
}

.auth-box button:hover{
    background:#2563eb;
}

.auth-box a{
    color:#60a5fa;
    text-decoration:none;
}

.auth-box a:hover{
    text-decoration:underline;
}
</style>

</head>
<body>

<div class="auth-box">

<h2>👋 Welcome to LF App</h2>
<p>Create your account</p>

<form method="POST">

<input type="text" name="username" placeholder="Username" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="register">Register</button>

</form>

<p style="margin-top:15px;">
Already have an account? <a href="login.php">Login</a>
</p>

</div>

</body>
</html>

<?php
if(isset($_POST['register'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if($check->num_rows > 0){
        echo "<script>alert('Email already exists');</script>";
    } else {
        $conn->query("INSERT INTO users (username,email,password) VALUES ('$username','$email','$password')");
        echo "<script>alert('Registered Successfully'); window.location='login.php';</script>";
    }
}
?>