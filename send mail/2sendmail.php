<?php 
function sendmail($to,$link){
	require_once("class.phpmailer.php"); 
	
	$mail = new PHPMailer(); 
	
	$mail->IsSMTP(); // send via SMTP 
	$mail->Host = "mail.softexsw.net"; // SMTP servers 
	$mail->SMTPAuth = true; // turn on SMTP authentication 
	$mail->Username = "newsletter@softexsw.net"; // SMTP username 
	$mail->Password = "sswnllogin"; // SMTP password 
	
	$mail->From = "info@stylishholidays.com"; 
	$mail->FromName = "Stylish support"; 
	$mail->AddAddress("$to",""); 
	$mail->AddReplyTo("info@stylishholidays.com","Stylish support"); 
	
	$mail->WordWrap = 50; // set word wrap 
	
	$mail->IsHTML(true); // send as HTML 
	
	$mail->Subject = "Your newsletter subscription activation link"; 
	$mail->Body = "Thank you for subscribing with our newsletter<br>Our newsletter you will provide you with the latest news and events of our company, but first you need to activate your subscription.<br>To activate your subscription please click the link below<p><a href='$link'>$link</a></p>if the link doesn't work please copy and paste it in the address bar then press enter"; 
	$mail->AltBody = "Thank you for subscribing with our newsletter \n Our newsletter you will provide you with the latest news and events of our company, but first you need to activate your subscription.\n To activate your subscription please copy and paste the link below in the address bar then press enter \n $link"; 
	
	if(!$mail->Send()){ 
		//echo "<p style='color:#FF0000'>Message was not sent <br>"; 
		//echo "Mailer Error: " . $mail->ErrorInfo."</p>"; 
		//exit; 
		return false;
	} 
	
	//echo "Message has been sent";
	return true;
}
//sendmail("hellooooooooooooooooooooooooooooo");
?> 