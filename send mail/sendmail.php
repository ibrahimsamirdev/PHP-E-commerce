<?php 
function sendmail($from,$name,$toEmails,$message,$subject,$ccEmails=""){
	require_once("class.phpmailer.php"); 
	
	$mail = new PHPMailer(); 
	
	$mail->IsSMTP(); // send via SMTP 
	$mail->Host = "mail.softexsw.net"; // SMTP servers 
	$mail->SMTPAuth = true; // turn on SMTP authentication 
	$mail->Username = "newsletter@softexsw.net"; // SMTP username 
	$mail->Password = "sswnllogin"; // SMTP password 
	
	$mail->From = "$from"; 
	$mail->FromName = "$name";
	
	$emails=explode(",", $toEmails);
	for($i=0; $i < count($emails); $i++){
		$mail->AddAddress($emails[$i],"");
	}
	
	if($ccEmails){
		$emails=explode(",", $ccEmails);
		for($i=0; $i < count($emails); $i++){
			$mail->AddCC($emails[$i],"");
		}
	}	
	//$mail->AddReplyTo("$to","New Contact"); 
	
	$mail->WordWrap = 50; // set word wrap 
	
	$mail->IsHTML(true); // send as HTML 
	
	$mail->Subject = "$subject"; 
	$mail->Body = "$message";
	$mail->AltBody = "$message"; 
	
	if(!$mail->Send()){ 
		return false;
	} 
	
	return true;
}
//sendmail("hellooooooooooooooooooooooooooooo");
?> 
