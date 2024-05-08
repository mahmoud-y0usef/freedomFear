<?php 
    require_once 'connection.php' ;
    class DB {
        
        private function login($username_or_email , $password , $table)
        {
            global $conn;
            $sql = "SELECT * FROM $table WHERE (user = ? OR email = ?) AND password = ?";
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

        public function register($email , $username , $password)
        {
            global $conn;
            $activation = md5(uniqid(rand(), true));
            $subject = 'Registration Confirmation [freedom fear]';
            $body = "
                    <html>
                    <body>
                        To activate your account, please click on this link : <br>
                        https://freedom-fear.com/activate.php <br>
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
            mysqli_stmt_bind_param($stmt, 'ssss', $email, $username, md5($password)  , $activation);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        }



        public function loginAdmin($username_or_email , $password)
        {
            return $this->login($username_or_email , $password , 'admins');
        }

        public function loginUser($username_or_email , $password)
        {
            return $this->login($username_or_email , $password , 'account');
        }


        public function activate($email , $activation)
        {
            global $conn;
            $sql = "SELECT * FROM account WHERE email = ? AND active = ? AND activate = 0";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'ss', $email, $activation);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);
            if($user){
                $sql = "UPDATE account SET activate = 1 WHERE email = ? AND active = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'ss', $email, $activation);
                $result = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                return $result;
            }else{
                return false;
            }
        }

    }
?>