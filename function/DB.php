<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once 'connection.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class DB
{

    public function login($username_or_email, $password, $table)
    {
        global $conn;

        // Prepare the query
        $sql = "SELECT * FROM $table WHERE email = ? OR name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $username_or_email, $username_or_email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
            // Password matches
            return $user;
        }

        // Password or username/email doesn't match
        return false;
    }



    public function get_user_by_email($email)
    {
        global $conn;
        $sql = "SELECT * FROM bl_game_users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $user;
    }

    public function get_admin_by_email($email)
    {
        global $conn;
        $sql = "SELECT * FROM admins WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $admin = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $admin;
    }

    public function get_admin_by_username($username)
    {
        global $conn;
        $sql = "SELECT * FROM admins WHERE name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $admin = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $admin;
    }

    public function get_user_by_id($id)
    {
        global $conn;
        $sql = "SELECT * FROM bl_game_users WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $user;
    }

    public function get_admin_by_id($id)
    {
        global $conn;
        $sql = "SELECT * FROM admins WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $admin = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $admin;
    }

    public function get_user_by_username($username)
    {
        global $conn;
        $sql = "SELECT * FROM bl_game_users WHERE name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $user;
    }

    public function update_password_by_id($id, $password)
    {
        global $conn;
        $sql = "UPDATE bl_game_users SET password = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, array(
            'cost' => 10
        ));
        mysqli_stmt_bind_param($stmt, 'si', $hashed_password, $id);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }
    public function update_password_admin_by_id($id, $password)
    {
        global $conn;
        $sql = "UPDATE admins SET password = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, array(
            'cost' => 10
        ));
        mysqli_stmt_bind_param($stmt, 'si', $hashed_password, $id);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }


    public function update_user($id, $name, $nick, $email, $image)
    {
        global $conn;
        $sql = "UPDATE bl_game_users SET name = ?, nick = ?, email = ?, img = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssssi', $name, $nick, $email, $image, $id);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    public function update_admin($id, $name, $email, $image)
    {

        global $conn;
        $sql = "UPDATE admins SET name = ?, email = ?, img = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssi', $name, $email, $image, $id);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    public function check_user_exists($field, $value, $currentUserId)
    {
        // Prepare and execute SQL statement to check if another user has the same name or email
        global $conn;
        $sql = "SELECT COUNT(*) FROM bl_game_users WHERE $field = ? AND id != ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $value, $currentUserId);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count > 0;
    }

    public function check_admin_exists($field, $value, $currentUserId)
    {
        // Prepare and execute SQL statement to check if another user has the same name or email
        global $conn;
        $sql = "SELECT COUNT(*) FROM admins WHERE $field = ? AND id != ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $value, $currentUserId);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

        return $count > 0;
    }


    public function register($email, $username, $password)
    {
        global $conn;
        $activation = md5(uniqid(rand(), true));
        $subject = 'Registration Confirmation [Freedom Fear]';
        $body = "
        <html>
        <body>
            To activate your account, please click on this link:<br>
            <a href='https://freedom-fear.com/activate.php?email=$email&key=$activation' target='_blank'>Activate</a><br>
            Your email: $email<br> 
            Your activation key: $activation
        </body>
        </html>
    ";

        // Initialize PHPMailer and configure SMTP settings
        $mail = new PHPMailer(true);
        $emailSent = false;

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'titan.rar-it.net';
            $mail->SMTPAuth = true;
            $mail->Username = 'support@freedom-fear.com';
            $mail->Password = 'xSUe,R9H9q.*5Mk_';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Recipients
            $mail->setFrom('support@freedom-fear.com', 'Freedom Fear Support');
            $mail->addAddress($email, $username);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            // Send the email
            $mail->send();
            $emailSent = true;
        } catch (Exception $e) {
            error_log("Mailer Error: {$mail->ErrorInfo}");
            $emailSent = false;
        }

        // Attempt to save user to the database
        $sql = "INSERT INTO bl_game_users (email, name, password, code) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt === false) {
            error_log("MySQL Error: " . mysqli_error($conn));
            return false;
        }

        $hashed_password = password_hash($password, PASSWORD_BCRYPT, array(
            'cost' => 10
        ));
        mysqli_stmt_bind_param($stmt, 'ssss', $email, $username, $hashed_password, $activation);
        $result = mysqli_stmt_execute($stmt);
        if ($result === false) {
            error_log("MySQL Execution Error: " . mysqli_stmt_error($stmt));
        }
        mysqli_stmt_close($stmt);

        return [
            'registration_success' => $result,
            'email_sent' => $emailSent
        ];
    }


    public function rest_password($email)
    {
        global $conn;
        $sql = "SELECT * FROM bl_game_users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        if ($user) {
            $activation = md5(uniqid(rand(), true));
            $subject = 'Reset Password [Freedom Fear]';
            $body = "
            <html>
            <body>
                To reset your password, please click on this link:<br>
                <a href='https://freedom-fear.com/reset_password?email=$email&key=$activation' target='_blank'>Reset Password</a><br>
                Your email: $email<br>
                Your reset key: $activation
            </body>
            </html>
        ";

            // Initialize PHPMailer and configure SMTP settings
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'titan.rar-it.net';
                $mail->SMTPAuth = true;
                $mail->Username = 'support@freedom-fear.com';
                $mail->Password = 'xSUe,R9H9q.*5Mk_';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;

                // Recipients
                $mail->setFrom('support@freedom-fear.com', 'Freedom Fear Support');
                $mail->addAddress($email);

                // Content
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body = $body;

                // Send the email
                $mail->send();

                // Save the reset key in the forget_passwords table
                $sql = "INSERT INTO forget_passwords (email, code) VALUES (?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'ss', $email, $activation);
                $result = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                return $result;
            } catch (Exception $e) {
                error_log("Mailer Error: {$mail->ErrorInfo}");
                echo "<script> window.location.href = '../forget-password.php?error=Email sending failed' </script>";
                return false;
            }
        } else {
            return false;
        }
    }



    public function activate($email, $activation)
    {
        global $conn;
        $sql = "SELECT * FROM bl_game_users WHERE email = ? AND code = ? AND active = 0";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $email, $activation);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        if ($user) {
            $sql = "UPDATE bl_game_users SET active = 1 WHERE email = ? AND code = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $email, $activation);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            return false;
        }
    }

    public function update_active($email)
    {
        global $conn;
        $sql = "UPDATE bl_game_users SET code = null  , verify = 'done' WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    public function status($id, $table, $status)
    {
        global $conn;
        $sql = "UPDATE $table SET status = $status WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }


    public function get_email_by_key($email, $key)
    {
        global $conn;
        $sql = "SELECT * FROM forget_passwords WHERE email = ? AND code = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $email, $key);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $user;
    }


    public function update_password($email, $password)
    {
        global $conn;
        $sql = "UPDATE bl_game_users SET password = ? WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, array(
            'cost' => 10
        ));
        mysqli_stmt_bind_param($stmt, 'ss', $hashed_password, $email);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }


    public function delete_key($email)
    {
        global $conn;
        $sql = "DELETE FROM forget_passwords WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    public function get_events()
    {
        // get all the data in table events
        global $conn;
        $sql = 'SELECT * FROM events';
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $events = mysqli_fetch_all($result, MYSQLI_ASSOC);

            mysqli_stmt_close($stmt);
            return $events;
        } else {
            // Handle error in statement preparation
            return array();
        }
    }


    public function get_community()
    {
        global $conn;
        $sql = 'SELECT * FROM communities';
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $events = mysqli_fetch_all($result, MYSQLI_ASSOC);

            mysqli_stmt_close($stmt);
            return $events;
        } else {
            // Handle error in statement preparation
            return array();
        }

    }



    public function get_service()
    {
        global $conn;
        $sql = "SELECT * FROM slides";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            $events = mysqli_fetch_all($result, MYSQLI_ASSOC);

            mysqli_stmt_close($stmt);
            return $events;
        } else {
            // Handle error in statement preparation
            return array();
        }
    }

    public function select_subjects()
    {
        global $conn;
        $sql = "SELECT * FROM sup";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_stmt_close($stmt);
            return $events;
        } else {
            return array();
        }
    }


    public function send_report($email, $subject, $details, $file)
    {
        global $conn;
        $sql = "INSERT INTO reports (email, subject, details, file) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // Bind the parameters
            mysqli_stmt_bind_param($stmt, 'ssss', $email, $subject, $details, $file);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_close($stmt);
                return true; // Report successfully sent
            } else {
                mysqli_stmt_close($stmt);
                return false; // Failed to execute statement
            }
        } else {
            return false; // Failed to prepare statement
        }
    }

    public function select_charges()
    {
        global $conn;
        $sql = 'SELECT * FROM charges';
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $charges = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_stmt_close($stmt);
            return $charges;
        } else {
            return false;
        }

    }


    public function select_charge_by_id($charge_id)
    {
        global $conn;
        $sql = "SELECT * FROM charges WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $charge_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $charge = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $charge;
    }

    public function update_user_coins($id, $newWalletValue)
    {
        global $conn;
        $sql = "UPDATE bl_game_users SET coins = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'si', $newWalletValue, $id);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }


    public function get_all_blogs()
    {
        global $conn;
        $sql = "SELECT * FROM blogs WHERE status = 1";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_stmt_close($stmt);
            return $blogs;
        } else {
            return false;
        }
    }

    public function get_all_category_blog()
    {
        global $conn;
        $sql = "SELECT * FROM catigory_blog";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $category = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_stmt_close($stmt);
            return $category;
        } else {
            return false;
        }
    }


    public function get_blog_by_id($id)
    {
        global $conn;
        $sql = "SELECT * FROM blogs WHERE id = ? and status = 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $blog = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $blog;
    }

    public function get_blog_by_category($category)
    {
        global $conn;
        $sql = "SELECT * FROM blogs WHERE catigory_id = ? and status = 1";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $category);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $blog = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_stmt_close($stmt);
        return $blog;
    }


    public function get_last_4_blogs()
    {
        global $conn;
        $sql = "SELECT * FROM blogs where status = 1  ORDER BY id  DESC LIMIT 4 ";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_stmt_close($stmt);
            return $blogs;
        } else {
            return false;
        }
    }

    public function search_blog($search)
    {
        global $conn;
        $sql = "SELECT * FROM blogs WHERE address LIKE ? OR description LIKE ? and status = 1";
        $stmt = mysqli_prepare($conn, $sql);
        $search = '%' . $search . '%';
        mysqli_stmt_bind_param($stmt, 'ss', $search, $search);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_stmt_close($stmt);
        return $blogs;
    }


    public function get_type_lang_stream()
    {
        global $conn;
        $sql = "SELECT * FROM type_lang_stream";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $type_lang_stream = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_stmt_close($stmt);
            return $type_lang_stream;
        } else {
            return false;
        }
    }

    public function get_streams()
    {
        global $conn;
        $sql = "SELECT * FROM streams WHERE status = 1";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {

            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $streams = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_stmt_close($stmt);
            return $streams;
        } else {
            return false;
        }
    }

    public function addStream($title, $url, $lang, $img, $name)
    {
        global $conn;
        $sql = "INSERT INTO streams (address, embed, lang, img, name) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssiss', $title, $url, $lang, $img, $name);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }
}
?>