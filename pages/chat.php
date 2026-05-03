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

<!-- TOP -->
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

    <button onclick="startCall()" class="call-btn">📞</button>
</div>

<!-- MESSAGES -->
<div id="messages" class="chat-messages"></div>

<!-- INPUT -->
<form id="chatForm" class="chat-input">

    <input type="text" id="msg" placeholder="Type message...">

    <input type="file" id="image" accept="image/*" hidden>

    <label for="image" class="img-btn">📎</label>

    <button type="submit">➤</button>

</form>

</div>
</div>

<!-- CALL UI -->
<div id="callOverlay" class="call-overlay">
    <div class="call-card">

        <div class="pulse-ring"></div>

        <div class="caller-avatar">
            <?= strtoupper(substr($user_name,0,1)) ?>
        </div>

        <h2><?= $user_name ?></h2>
        <p id="callStatus">Calling...</p>

        <div class="call-actions">
            <button class="btn gray">🎤 Mute</button>
            <button class="btn red" onclick="endCall()">❌ End Call</button>
        </div>

    </div>
</div>

<script>
let receiver = <?= $receiver ?>;
let item_id = <?= $item_id ?>;

/* SEND MESSAGE */
document.getElementById("chatForm").addEventListener("submit", function(e){
    e.preventDefault();

    let msg = document.getElementById("msg").value;
    let image = document.getElementById("image").files[0];

    let formData = new FormData();
    formData.append("msg", msg);
    formData.append("receiver", receiver);
    formData.append("item_id", item_id);

    if(image){
        formData.append("image", image);
    }

    fetch("send.php", {
        method: "POST",
        body: formData
    })
    .then(() => {
        document.getElementById("msg").value = "";
        document.getElementById("image").value = "";
        fetchMessages();
    });
});

/* REALTIME CHAT */
function fetchMessages(){
    fetch("get.php?receiver="+receiver+"&item_id="+item_id+"&t="+Date.now())
    .then(res => res.text())
    .then(data => {
        let box = document.getElementById("messages");

        let shouldScroll = (box.scrollTop + box.clientHeight === box.scrollHeight);

        box.innerHTML = data;

        if(shouldScroll){
            box.scrollTop = box.scrollHeight;
        }
    });
}

setInterval(fetchMessages, 800);
fetchMessages();

/* CALL SYSTEM */
function startCall(){
    document.getElementById("callOverlay").style.display = "flex";

    setTimeout(()=>{
        document.getElementById("callStatus").innerText = "Ringing...";
    }, 1200);

    setTimeout(()=>{
        document.getElementById("callStatus").innerText = "Connecting...";
    }, 3000);
}

function endCall(){
    document.getElementById("callOverlay").style.display = "none";
    document.getElementById("callStatus").innerText = "Calling...";
}
function deleteMsg(id){
    fetch("delete_msg.php?id="+id)
    .then(res => res.json())
    .then(data => {
        if(data.status === "success"){
            fetchMessages();
        } else {
            alert("Cannot delete message");
        }
    });
}
</script>

<?php require_once("../layouts/footer.php"); ?>