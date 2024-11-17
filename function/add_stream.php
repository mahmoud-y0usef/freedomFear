<?php
require_once 'DB.php';
$db = new DB();

// Retrieve and validate inputs
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$url = isset($_POST['url']) ? trim($_POST['url']) : '';
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$lang = isset($_POST['lang']) ? trim($_POST['lang']) : '';
$img = isset($_FILES['img']['name']) ? $_FILES['img']['name'] : '';
$tmp = isset($_FILES['img']['tmp_name']) ? $_FILES['img']['tmp_name'] : '';
$path = '../assets/img/streams/';

if (empty($title) || empty($url) || empty($id) || empty($lang) || empty($img)) {
    header('Location: ../user/ads.php?error=All fields are required');
    exit;
}

// Validate image type
$allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
$fileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));

if (!in_array($fileType, $allowedTypes)) {
    header('Location: ../user/ads.php?error=Invalid image type');
    exit;
}

// Move uploaded image
$newImgName = time() . '_' . $img;
if (!move_uploaded_file($tmp, $path . $newImgName)) {
    header('Location: ../user/ads.php?error=Failed to upload the image');
    exit;
}

// Verify user existence
$user = $db->get_user_by_id($id);
if (!$user) {
    header('Location: ../user/ads.php?error=Invalid user ID');
    exit;
}

// Add the stream to the database
if ($db->addStream($title, $url, $lang, $newImgName, $user['name'])) {
    header('Location: ../user/ads.php?success=The stream has been added and is waiting for admin approval');
    exit;
} else {
    header('Location: ../user/ads.php?error=Failed to add the stream');
    exit;
}
?>
