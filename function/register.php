<?php
require_once('../Php/phpmailer/PHPMailer.php');
require_once('../Php/phpmailer/SMTP.php');
require_once('../Php/phpmailer/POP3.php');
require_once('../Php/phpmailer/Exception.php');
require_once 'DB.php';
$db = new DB();

if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['g-recaptcha-response'])) {
    // Verify reCAPTCHA response
    $recaptchaSecret = '6LcI43oqAAAAADUNDzY6S9Hqk7fuAG7Y-5bCbmOc';
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    
    $recaptchaURL = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptchaResponseData = file_get_contents($recaptchaURL . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
    $recaptchaResult = json_decode($recaptchaResponseData, true);

    if (!$recaptchaResult['success']) {
        echo "<script> window.location.href = '../register.php?error=CAPTCHA verification failed' </script>";
        exit;
    }

    try {
        $email = trim($_POST['email']);
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        // Input Validation
        if (empty($email) || empty($username) || empty($password)) {
            echo "<script> window.location.href = '../register.php?error=Please fill out the data' </script>";
            exit;
        }

        // Check email domain
        $domain = explode('@', $email);
        if (!in_array($domain[1], ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com'])) {
            echo "<script> window.location.href = '../register.php?error=Invalid email domain' </script>";
            exit;
        }

        // Check username length
        if (strlen($username) < 6) {
            echo "<script> window.location.href = '../register.php?error=Username must be at least 6 characters' </script>";
            exit;
        }

        // Check password complexity
        if (!preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password) || strlen($password) < 6) {
            echo "<script> window.location.href = '../register.php?error=Password must be at least 6 characters and a mix of letters and numbers' </script>";
            exit;
        }

        // Sanitize inputs
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);

        // Check if email or username already exists
        if ($db->get_user_by_email($email)) {
            echo "<script> window.location.href = '../register.php?error=This email already exists' </script>";
            exit;
        }
        if ($db->get_user_by_username($username)) {
            echo "<script> window.location.href = '../register.php?error=Username already exists' </script>";
            exit;
        }

        if($db->get_admin_by_email($email)){
            echo "<script> window.location.href = '../register.php?error=This email already exists' </script>";
            exit;
        }

        if($db->get_admin_by_username($username)){
            echo "<script> window.location.href = '../register.php?error=Username already exists' </script>";
            exit;
        }

        // Register user and send email
        $result = $db->register($email, $username, $password);
        if ($result['registration_success']) {
            if ($result['email_sent']) {
                echo "<script> window.location.href = '../activate.php' </script>";
            } else {
                echo "<script> window.location.href = '../register.php?error=Account created, but activation email failed to send' </script>";
            }
        } else {
            echo "<script> window.location.href = '../register.php?error=Account creation failed' </script>";
        }
        exit;

    } catch (Exception $e) {
        error_log("Registration error: " . $e->getMessage());
        echo "<script> window.location.href = '../register.php?error=Request failed' </script>";
        exit;
    }
} else {
    echo "<script> window.location.href = '../register.php?error=CAPTCHA verification failed' </script>";
    exit;
}
?>
