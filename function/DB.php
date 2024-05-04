<?php 
    require_once('connection.php');
    class DB {
        private function login($username_or_email , $password , $table)
        {
            global $conn;
            $sql = "SELECT * FROM $table WHERE (username = ? OR email = ?) AND password = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'sss', $username_or_email, $username_or_email, $password);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);
            return $user;
        }

        private function loginWithGoogle($email)
        {
            global $conn;
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);
            return $user;
        }

        public function googleClient()

        
        {
            return $this->login($username_or_email , $password , 'admins');
        }

        public function loginUser($username_or_email , $password)
        {
            return $this->login($username_or_email , $password , 'users');
        }



    }
?>