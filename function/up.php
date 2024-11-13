<?php 
if (isset($_POST['name']) && isset($_POST['nick']) && isset($_POST['email']) && isset($_POST['id'])) {
    require_once 'DB.php';
    $db = new DB();
    $name = $_POST['name'];
    $nick = $_POST['nick'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    $user = $db->get_user_by_id($id);
    $new_name_image = $user['img']; // Retain old image if no new image is uploaded

    // Check if another user has the same name or email
    $nameExists = $db->check_user_exists('name', $name, $id);
    $emailExists = $db->check_user_exists('email', $email, $id);

    if ($nameExists) {
        echo "<script>window.location.href = '../user/up.php?error=Username already taken';</script>";
        exit;
    }
    if ($emailExists) {
        echo "<script>window.location.href = '../user/up.php?error=Email already in use';</script>";
        exit;
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $img = $_FILES['image']['name'];
        $new_name_image = time() . '_' . $img;
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, '../assets/img/' . $new_name_image);
    }

    $update = $db->update_user($id, $name, $nick, $email, $new_name_image);
    if ($update) {
        echo "<script>window.location.href = '../user/up.php?success=Account updated successfully';</script>";
        exit;
    } else {
        echo "<script>window.location.href = '../user/up.php?error=Account update failed';</script>";
        exit;
    }
} else {
    echo "<script>window.location.href = '../user/up.php?error=Please fill out the data';</script>";
    exit;
}
?>
