<?php
	require "config.php";


    $username = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
	
	
    $sql_company = "SELECT * FROM account WHERE user = '$username' ";
    $result_company = $conn->query($sql_company);



  if ($result_company->num_rows > 0) {
		echo "false";
	}else{
        
		
		$url  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
		$url .= $_SERVER['SERVER_NAME'];
		$url .= $_SERVER['REQUEST_URI'];

		$activation = md5(uniqid(rand(), true));
		mysqli_query($conn,"INSERT INTO account(user,password,email,active) VALUES ('$username',MD5('".$password."'),'$email','$activation')");
		$message = " To activate your account, please click on this link:\n\n";
                $message .= dirname($url). '/activate.php?email=' . urlencode($email) . "&key=$activation";

		// $mail = new PHPMailer;
		// $smtp_auth = $GLOBALS['smtp_auth'];

		// if($smtp_auth){
		// 	$mail->isSMTP();                                   
		// 	$mail->Host = $GLOBALS['smtp_host'];
		// 	$mail->SMTPAuth = true;                              
		// 	$mail->Username = $GLOBALS['smtp_user'];                 
		// 	$mail->Password = $GLOBALS['smtp_password'];                           
		// 	$mail->SMTPSecure = "tls";                           
		// 	$mail->Port = $GLOBALS['smtp_port'];     
		// }

		// $mail->setFrom($GLOBALS['smtp_user'], 'Support');
		// $mail->addAddress($email);
		// $mail->Subject  = 'Registration Confirmation';
		// $mail->Body     = $message;

		// $mail->Send();

		echo "true";
	}
	mysqli_close($conn);
?> 
 