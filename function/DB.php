<?php 
    require_once('connection.php');
    class DB {
        
        private function login($username_or_email , $password , $table)
        {
            global $conn;
            $sql = "SELECT * FROM $table WHERE (user = ? OR email = ?) AND password = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'sss', $username_or_email, $username_or_email, $password);
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
            $sql = "INSERT INTO account (email , user , password) VALUES (? , ? , ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'sss', $email, $username, $password);
            $result = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $result;
        }



        public function loginAdmin()
        {
            return $this->login($username_or_email , $password , 'admins');
        }

        public function loginUser($username_or_email , $password)
        {
            return $this->login($username_or_email , $password , 'account');
        }



    }
?>