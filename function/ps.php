<?php 
    session_start();
    if (isset($_POST['current_password']) && isset($_POST['new_password'])) {
        require_once 'DB.php';
        $db = new DB();
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $id = $_POST['id'];
        if (isset($_SESSION['user']))
        {
            
            $user = $db->get_user_by_id($id);
        }
        else
        {
            $user = $db->get_admin_by_id($id);
        }

        if ($user) {
            
            if (password_verify($current_password, $user['password'])) {
                $new_password_ = $new_password;
                if (isset($_SESSION['user']))
                {
                    $db->update_password_by_id($id, $new_password_);
                }
                else
                {
                    $db->update_password_admin_by_id($id, $new_password_);
                }

                if (isset($_SESSION['user']))
                {
                    header('Location: ../user/ps.php?success=Password updated successfully');
                }
                else
                {
                    header('Location: ../admin/ps.php?success=Password updated successfully');
                }

            } else {
                if (isset($_SESSION['user']))
                {
                    header('Location: ../user/ps.php?error=Current password is incorrect');
                }
                else
                {
                    header('Location: ../admin/ps.php?error=Current password is incorrect');
                }
            }
        } else {

            if (isset($_SESSION['user']))
            {
                header('Location: ../user/ps.php?error=User not found');
            }
            else
            {
                header('Location: ../admin/ps.php?error=User not found');
            }

        }

    } else {

        if (isset($_SESSION['user']))
        {
            header('Location: ../user/ps.php?error=Please fill all fields');
        }
        else
        {
            header('Location: ../admin/ps.php?error=Please fill all fields');
        }

    }



?>