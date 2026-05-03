<?php
session_start();
include("../config/db.php");
include("../layouts/header.php");

$id = $_GET['id'];

$q = $conn->query("SELECT * FROM items WHERE id='$id'");
$data = $q->fetch_assoc();

if(isset($_POST['update'])){

$title = $_POST['title'];
$type = $_POST['type'];
$location = $_POST['location'];
$category = $_POST['category'];
$desc = $_POST['description'];

$conn->query("
UPDATE items SET 
title='$title',
type='$type',
location='$location',
category='$category',
description='$desc'
WHERE id='$id'
");

echo "<div class='notice'>✅ Updated</div>";
}
?>

<div class="container">
<div class="form-card">

<h2>Edit Item</h2>

<form method="POST">

<input name="title" value="<?= $data['title'] ?>">

<select name="type">
<option value="lost" <?= $data['type']=='lost'?'selected':'' ?>>Lost</option>
<option value="found" <?= $data['type']=='found'?'selected':'' ?>>Found</option>
</select>

<input name="location" value="<?= $data['location'] ?>">

<select name="category">
<option>Electronics</option>
<option>Documents</option>
<option>Clothing</option>
<option>Accessories</option>
<option>Others</option>
</select>

<textarea name="description"><?= $data['description'] ?></textarea>

<button name="update" class="btn green">Update</button>

</form>

</div>
</div>

<?php include("../layouts/footer.php"); ?>