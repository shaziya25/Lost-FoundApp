<?php
session_start();
include("../config/db.php");
include("../layouts/header.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

if (isset($_POST['submit'])) {

    $user_id = $_SESSION['user_id'];
    $type = $_POST['type'];
    $title = $_POST['title']; // ✅ now exists
    $description = $_POST['description'];
    $category = $_POST['category'];
    $high = isset($_POST['high_value']) ? 1 : 0;
    $location = $_POST['location'];

    // IMAGE
    $image = '';
    if($_FILES['image']['name']){
        $name = time() . "_" . $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "../uploads/" . $name);

        // ✅ correct path for browser
        $image = "/lf_app/uploads/" . $name;
    }

    // INSERT
    $sql = "INSERT INTO items 
    (user_id, type, title, description, category, image, is_high_value, location)
    VALUES 
    ('$user_id','$type','$title','$description','$category','$image','$high','$location')";

    if ($conn->query($sql)) {
        header("Location: browse.php?posted=1"); // ✅ redirect
        exit();
    } else {
        echo "ERROR: " . $conn->error;
    }
}
?>

<div class="container">
<div class="form-card">

<h2><?= t('post_item') ?></h2>

<form method="POST" enctype="multipart/form-data">

<label>Title</label>
<input type="text" name="title" required>

<label><?= t('type') ?></label>
<select name="type">
    <option value="lost">Lost</option>
    <option value="found">Found</option>
</select>

<label><?= t('location') ?></label>
<input type="text" name="location" placeholder="Mumbai">

<label><?= t('description') ?></label>
<textarea name="description"></textarea>

<label><?= t('category') ?></label>
<select name="category">
    <option>Electronics</option>
    <option>Documents</option>
    <option>Clothing</option>
    <option>Accessories</option>
    <option>Others</option>
</select>

<label>Upload Image</label>
<input type="file" name="image">

<label>
<input type="checkbox" name="high_value">
<?= t('high_value') ?>
</label>

<button class="btn blue" name="submit"><?= t('submit') ?></button>

</form>
</div>
</div>

<?php include("../layouts/footer.php"); ?>