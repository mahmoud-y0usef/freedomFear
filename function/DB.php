<?php
require_once 'connection.php';
class DB
{

    public function login($username_or_email, $password, $table)
    {
        global $conn;
        $sql = "SELECT * FROM $table WHERE (email = ? OR user = ?) AND password = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sss', $username_or_email, $username_or_email, md5($password));
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $user;

    }


    public function get_user_by_email($email)
    {
        global $conn;
        $sql = "SELECT * FROM account WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $user;
    }

    public function get_user_by_username($username)
    {
        global $conn;
        $sql = "SELECT * FROM account WHERE user = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        return $user;
    }

    public function register($email, $username, $password)
    {
        global $conn;
        $activation = md5(uniqid(rand(), true));
        $subject = 'Registration Confirmation [freedom fear]';
        $body = "
                    <html>
                    <body>
                        To activate your account, please click on this link : <br>
                        <a href='https://freedom-fear.com/activate.php' target='_blanc'>activate</a> <br>
                        your email = $email <br> and your key= $activation
                    </body>
                    </html>
                ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: <support@freedom-fear.com>" . "\r\n";
        $recipientEmail = $email;
        mail($recipientEmail, $subject, $body, $headers);

        $sql = "INSERT INTO account (email , user , password , active) VALUES (? , ? , ? , ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssss', $email, $username, md5($password), $activation);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    public function rest_password($email)
    {
        global $conn;

        // Prepare and execute the query to check if the email exists
        $sql = "SELECT * FROM account WHERE email = ?";
        if (!$stmt = mysqli_prepare($conn, $sql)) {
            error_log("MySQL prepare error: " . mysqli_error($conn));
            return false;
        }
        if (!mysqli_stmt_bind_param($stmt, 's', $email)) {
            error_log("MySQL bind param error: " . mysqli_stmt_error($stmt));
            return false;
        }
        if (!mysqli_stmt_execute($stmt)) {
            error_log("MySQL execute error: " . mysqli_stmt_error($stmt));
            return false;
        }
        if (!$result = mysqli_stmt_get_result($stmt)) {
            error_log("MySQL get result error: " . mysqli_stmt_error($stmt));
            return false;
        }
        if (!$user = mysqli_fetch_assoc($result)) {
            error_log("MySQL fetch assoc error: " . mysqli_stmt_error($stmt));
            return false;
        }
        mysqli_stmt_close($stmt);

        // If the user exists, generate the activation code and send the email
        if ($user) {
            $activation = md5(uniqid(rand(), true));
            $subject = 'Reset Password [freedom fear]';
            $body = "
            <html>
            <body>
                To reset your password, please click on this link : <br>
                <a href='https://freedom-fear.com/reset_password.php' target='_blank'>reset password</a> <br>
                Your email: $email <br> Your key: $activation
            </body>
            </html>
        ";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: <support@freedom-fear.com>" . "\r\n";

            if (!mail($email, $subject, $body, $headers)) {
                error_log("Failed to send email to $email");
                return false;
            }

            // Insert the activation code into the forget_passwords table
            $sql = "INSERT INTO forget_passwords (email, code) VALUES (?, ?)";
            if (!$stmt = mysqli_prepare($conn, $sql)) {
                error_log("MySQL prepare error: " . mysqli_error($conn));
                return false;
            }
            if (!mysqli_stmt_bind_param($stmt, 'ss', $email, $activation)) {
                error_log("MySQL bind param error: " . mysqli_stmt_error($stmt));
                return false;
            }
            if (!mysqli_stmt_execute($stmt)) {
                error_log("MySQL execute error: " . mysqli_stmt_error($stmt));
                return false;
            }
            mysqli_stmt_close($stmt);
            return true;
        } else {
            error_log("User not found with email: $email");
            return false;
        }
    }

    public function activate($email, $activation)
    {
        global $conn;
        $sql = "SELECT * FROM account WHERE email = ? AND active = ? AND activate = 0";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $email, $activation);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        if ($user) {
            $sql = "UPDATE account SET activate = 1 WHERE email = ? AND active = ?";
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
        $sql = "UPDATE account SET active = null WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }

    public function status($id, $table)
    {
        global $conn;
        $sql = "UPDATE $table SET status = 1 WHERE id = ?";
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
        $sql = "UPDATE account SET password = ? WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', md5($password), $email);
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


}
?>