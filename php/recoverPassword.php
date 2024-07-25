<?php
	require_once("config.php");
	

	$auth_host = $GLOBALS['auth_host'];
	$auth_user = $GLOBALS['auth_user'];
	$auth_pass = $GLOBALS['auth_pass'];
	$auth_dbase = $GLOBALS['auth_dbase'];

	$db = mysqli_connect($auth_host, $auth_user, $auth_pass,$auth_dbase) or die("Error " . mysqli_error($db));
	
	
	$email = mysqli_real_escape_string($db,$_POST['email']);

	$sql = mysqli_query($db,"SELECT * FROM account WHERE email = '$email'");
	$rows= mysqli_num_rows($sql);

	if($rows < 1){
		echo "false";
	}else{
		$row = mysqli_fetch_row($sql);
		$message = "Your password is:\n\n";
		 //Initialize the random password
  		$password = '';

  		//Initialize a random desired length
  		$desired_length = rand(8, 12);

  		for($length = 0; $length < $desired_length; $length++) {
    			//Append a random ASCII character (including symbols)
    			$password .= chr(rand(32, 126));
  		}

                $message .= $password;



                $subject = 'FreeDomFear [Recover Password]';

                // Construct the email body
                $body = "
                    <html>
                    <body>
                       $message;
                       
                    </body>
                    </html>
                ";

                // Set the email headers
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "From: $store <support@freedom-fear.com>" . "\r\n";

                // Set the recipient's email address
                $recipientEmail = $email;

                // Send the email
                mail($recipientEmail, $subject, $body, $headers);

		$q = "UPDATE account SET password = MD5('".$password."') WHERE(email ='$email')";
    		$result_activate_account = mysqli_query($db,$q);

		echo "true";	
	}
	mysqli_close($db);
?> 
 