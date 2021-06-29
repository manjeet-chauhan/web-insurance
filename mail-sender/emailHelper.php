<?php


{
   	require 'PHPMailer-master/PHPMailerAutoload.php';
   	
   	// $from = "manjeet@webitexperts.com";
    // $sender_name = "Boxing";
    // $ci = &get_instance();
    // $config = Array(
    //     'mailpath' => '/usr/sbin/sendmail',
    //     'protocol' => 'sendmail',
    //     'smtp_host' => 'uitgaande.email',
    //     'smtp_port' => '587',
    //     'smtp_user' => 'manjeet@webitexperts.com',
    //     'smtp_pass' => ';5?U]wtLtDi6',
    //     'mailtype'  => 'html', 
    //     'charset'   => 'iso-8859-1',
    // );
    
	
	function sendMail($to,$message, $type)
	{
		$mail = new PHPMailer;
		//Enable SMTP debugging. 
		$mail->SMTPDebug = 1;                               
		//Set PHPMailer to use SMTP.
	    $mail->IsMail();
// 		$mail->IsSMTP();
		//Set SMTP host name                          
		$mail->Host = "uitgaande.email";
// 		"smtp.gmail.com";

		//Set this to true if SMTP host requires authentication to send email
		$mail->SMTPAuth = true;                       
		//Provide username and password
		$mail->Username =  "manjeet@webitexperts.com";
		$mail->Password =  ";5?U]wtLtDi6";
		//If SMTP requires TLS encryption then set it
		$mail->SMTPSecure = "TLS";                     
		//Set TCP port to connect to 
		$mail->Port = 587;
// 		$mail->Port = 465;
		$mail->From = "manjeet@webitexperts.com";
		$mail->FromName = "Insurance Website";

		$mail->addAddress($to, "Insurance Website");

		$mail->isHTML(true);

		$mail->Subject = $type;
		$mail->Body = "<i>".$message."</i>";
		$mail->AltBody = "This is the plain text version of the email content";

		if(!$mail->send()){
			return "error";
		} 
		else{
		    return "success";
		}
	}

	// $mas = sendMail("rajamanjeet91@gmail.com", "hello India", "Testinggggg"); 
	// echo $mas;
}

?>