<?php
session_start();
require_once("../config/db.php");
require_once("../layouts/header.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

$receiver = $_GET['user'] ?? 0;
$item_id = $_GET['item'] ?? 0;

if ($receiver == 0) {
    echo "<div class='container'><h3>⚠️ Invalid Chat</h3></div>";
    require_once("../layouts/footer.php");
    exit();
}

$sender = $_SESSION['user_id'];

$user_q = $conn->query("SELECT username FROM users WHERE id='$receiver'");
$user_name = ($user_q && $user_q->num_rows) 
    ? $user_q->fetch_assoc()['username'] 
    : "User";
?>

<div class="container">

<div class="chat-container">

<div class="chat-top">
    <div class="user-info">
        <div class="avatar">
            <?= strtoupper(substr($user_name,0,1)) ?>
        </div>
        <div>
            <b><?= $user_name ?></b>
            <br><small>Online</small>
        </div>
    </div>

    <button onclick="startCall()" class="btn red">📞</button>
</div>

<div id="messages" class="chat-messages"></div>

<form id="chatForm" class="chat-input">
    <input type="text" id="msg" placeholder="Type message..." required>
    <button type="submit">➤</button>
</form>

</div>
</div>

<script>
let receiver = <?= $receiver ?>;
let item_id = <?= $item_id ?>;

function fetchMessages(){
    fetch("get.php?receiver="+receiver+"&item_id="+item_id)
    .then(res=>res.text())
    .then(data=>{
        let box = document.getElementById("messages");
        box.innerHTML = data;
        box.scrollTop = box.scrollHeight;
    });
}

document.getElementById("chatForm").onsubmit = function(e){
    e.preventDefault();

    let msg = document.getElementById("msg").value;

    fetch("send.php", {
        method: "POST",
        headers: {"Content-Type": "application/x-www-form-urlencoded"},
        body: "msg="+encodeURIComponent(msg)+"&receiver="+receiver+"&item_id="+item_id
    })
    .then(()=>{
        document.getElementById("msg").value="";
        fetchMessages();
    });
};

setInterval(fetchMessages, 1000);
fetchMessages();

function startCall(){
    alert("Call feature UI only 📞");
}
</script>

<?php require_once("../layouts/footer.php"); ?>