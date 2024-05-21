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
        $sql = "SELECT * FROM account WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        if ($user) {
            global $conn;
            $activation = md5(uniqid(rand(), true));
            $subject = 'Rest Password [freedom fear]';
            $body = "
                    <html>
                    <body>
                        To activate your account, please click on this link : <br>
                        <a href='https://freedom-fear.com/reset_password' target='_blanc'>Rest Password</a> <br>
                        your email = $email <br> and your key= $activation
                    </body>
                    </html>
                ";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: <support@freedom-fear.com>" . "\r\n";
            $recipientEmail = $email;
            if (mail($recipientEmail, $subject, $body, $headers)) {
                $sql = "INSERT INTO forget_passwords (email , code) VALUES (? , ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'ss', $email, $activation);
                $result = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                return true;
            } else {
                return false;
            }
        } else {
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