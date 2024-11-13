<?php 

    if (isset($_POST['current_password']) && isset($_POST['new_password'])) {
        require_once 'DB.php';
        $db = new DB();
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $id = $_POST['id'];

        $user = $db->get_user_by_id($id);
        if ($user) {
            if (password_verify($current_password, $user['password'])) {
                $new_password_ = md5($new_password);
                $db->update_password_by_id($id, $new_password_);
                header('Location: ../user/ps.php?success=Password updated successfully');
            } else {
                header('Location: ../user/ps.php?error=Current password is incorrect');
            }
        } else {
            header('Location: ../user/ps.php?error=User not found');
        }

    } else {
        header('Location: ../user/ps.php?error=Please fill all fields');
    }



?>