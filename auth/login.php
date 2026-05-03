<?php
session_start();
include("../config/db.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../pages/dashboard.php");
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="../assets/css/style.css">
<style>
body {
    margin: 0;
    font-family: 'Segoe UI';
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    height: 100vh;
    display: flex;
    flex-direction: column;
}

/* Header */
.header {
    padding: 15px 40px;
    color: white;
    font-size: 22px;
    font-weight: bold;
}

/* Center Box */
.container {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Glass Card */
.card {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    padding: 40px;
    border-radius: 15px;
    width: 300px;
    color: white;
    text-align: center;
    animation: fadeIn 1s ease;
}

input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: none;
    border-radius: 8px;
}

button {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 8px;
    background: #fff;
    color: #333;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #ddd;
}

a {
    color: #fff;
    text-decoration: underline;
}

/* Footer */
.footer {
    text-align: center;
    padding: 10px;
    color: white;
    font-size: 14px;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}
</style>

</head>

<body>

<div class="header">🔍 Lost & Found</div>

<div class="container">
    <div class="card">
        <h2>Login</h2>

        <?php if(isset($error)) echo "<p>$error</p>"; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button name="login">Login</button>
        </form>

        <p>Don't have an account? 
            <a href="register.php">Register</a>
        </p>
    </div>
</div>

<div class="footer">© 2026 Lost & Found App</div>

</body>
</html>