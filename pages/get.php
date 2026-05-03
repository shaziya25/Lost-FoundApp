<?php
session_start();
include("../config/db.php");

$user = $_SESSION['user_id'];
$receiver = $_GET['receiver'];
$item_id = $_GET['item_id'];

$q = $conn->query("
SELECT * FROM messages 
WHERE 
(
(sender_id='$user' AND receiver_id='$receiver')
OR 
(sender_id='$receiver' AND receiver_id='$user')
)
AND item_id='$item_id'
ORDER BY id ASC
");

while($row = $q->fetch_assoc()){
    if($row['sender_id'] == $user){
        echo "<div class='msg me'>".$row['message']."</div>";
    } else {
        echo "<div class='msg other'>".$row['message']."</div>";
    }
}
?>