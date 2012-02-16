<?php
	//indicate that this is the main page [needed in modules pages -- to stop calling lib in the module pages]
	$mainpage=true;

	//include lib.php (this file is a liberary for most common modules and function used by the system)
	if(file_exists("lib.php"))
		require("lib.php");
	
	if($action == "send"){
		if($name == "")
			$error[0]="required !";
		else if(strlen($name) < 4)
			$error[0]="< 4 !";
		//check email
		if(!ereg("^[^@ ]+@[^@\. ]+\.[^@\. ]+$",$email))
			$error[1]="invalid !";
		
		if($message == "")
			$error[2]="required !";
			
		if(count($error) == 0){
			//echo "send";
			$message=htmlentities(stripslashes($message));
			
			$message="<strong>Name : </strong>$name<br>
			<strong>Email : </strong>$email<br>
			<strong>Company : </strong>$company<br>
			<strong>Message : <br></strong>
			".nl2br($message);
			
			//get client's email to send to
			$clientemail=consumeWebservice("getEmail",array(clientid=>$clientid));
			$clientemail=$clientemail->node->attributes()->email;
			
			//send message
			if(file_exists("send mail/sendmail.php"))
				require("send mail/sendmail.php");
			//call sendmail function
			if(sendmail($email,$name,$clientemail,$message,"New contact from Online Store"))
				//header("Location: messagesent.html");
				echo "<script language=javascript>window.location.href='mail_sent.html'</script>";
			else
				//header("Location: messagefailed.html");
				echo "<script language=javascript>window.location.href='mail_failed.html'</script>";				
		}
	}//end if send
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="softex, software, house, egypt, cairo, online, store, e-commerce, commerce" />
<meta name="description" content="Add, organize, show, and sell your products online" />
<meta name="author" content="Ibrahim Samir, himalking@yahoo.com" />
<meta name="copyright" content="softex software house" />
<title>Welcome to OUR online store - Home</title>
<link href="osstyles.css" rel="stylesheet" type="text/css" />
<link href="new osstyles.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
<link href="contact styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
	//include header
	if(file_exists("header.php"))
		require("header.php");
	//include search bar
	if(file_exists("searchbar.php"))
		require("searchbar.php");
?>

<table width="836" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="231" height="199" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td width="231" height="136" valign="top">
            <?php
			//include categories list
			if(file_exists("catlist.php"))
				require("catlist.php");
		?>		</td>
        </tr>
      <tr>
        <td height="63">&nbsp;</td>
      </tr>
      
      
       
    </table></td>
    <td width="605" valign="top">
	<div style="height:5px"><img src="images/blank.gif" width="1" height="1" /></div>
	<div>
		<table width="557" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="24" height="12"></td>
    <td width="510"></td>
    <td width="23"></td>
  </tr>
  <tr>
    <td height="62"></td>
    <td valign="top"><img src="images/contactform.gif" width="510" height="62" /></td>
    <td></td>
  </tr>
  
  
  <tr>
    <td height="338">&nbsp;</td>
    <td valign="top"><form id="cont" name="cont" method="post" action="<?=$_SERVER['PHP_SELF'] ?>" style="padding:0px; margin:0px">
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="tabletxt">
        <!--DWLayoutTable-->
        <tr>
          <td width="8" height="12" valign="top"><img src="images/contact_2x2.png" width="8" height="12" /></td>
            <td colspan="2" valign="top" class="tdtop"><img src="images/blank.gif" width="1" height="1" /></td>
            <td width="11" valign="top"><img src="images/contact_2x4.png" width="11" height="12" /></td>
          </tr>
        <tr>
          <td height="45" colspan="2" valign="top" class="tdleft1" style="padding-left:80px">Name</td>
            <td colspan="2" valign="top" class="tdright1">
              <input name="name" type="text" id="name" value="<?=$name ;?>" size="34" />
            <span class="error"><?=$error[0]; ?></span></td>
          </tr>
        <tr>
          <td height="45" colspan="2" valign="top" class="tdleft1" style="padding-left:80px">E-mail</td>
            <td colspan="2" valign="top" class="tdright1"><input name="email" type="text" id="email" value="<?=$email ;?>" size="34" />
            <span class="error"><?=$error[1]; ?></span></td>
          </tr>
        <tr>
          <td height="45" colspan="2" valign="top" class="tdleft1" style="padding-left:80px">Company</td>
            <td colspan="2" valign="top" class="tdright1"><input name="company" type="text" id="company" value="<?=$company ;?>" size="34" /></td>
          </tr>
        <tr>
          <td height="116" colspan="2" valign="top" class="tdleft1" style="padding-left:80px">Message</td>
            <td colspan="2" valign="top" class="tdright1"><textarea name="message" cols="27" rows="5" id="message"><?=$message;?></textarea>
            <span class="error"><?=$error[2]; ?></span></td>
          </tr>
        
        <tr>
          <td height="64" colspan="4" align="center" valign="middle" class="tdedges"><input name="send" type="image" id="send" src="images/submit.png" />
            <input name="action" type="hidden" id="action" value="send" />
            <input name="p" type="hidden" id="p" value="contact form.php" /></td>
          </tr>
        <tr>
          <td height="10" valign="top"><img src="images/contact_4x1.png" width="8" height="10" /></td>
            <td colspan="2" valign="top" class="tdbottom"><img src="images/blank.gif" width="1" height="1" /></td>
            <td valign="top"><img src="images/contact_4x3.png" width="11" height="10" /></td>
          </tr>
        <tr>
          <td height="1"></td>
            <td width="181"></td>
            <td width="310"></td>
            <td></td>
          </tr>
        </table>
    </form></td>
    <td></td>
  </tr>
  <tr>
    <td height="28">&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
</table>
	</div>
    <div style="clear:both; height:25px"></div></td>
  </tr>
</table>
<?php
	//include footer
	if(file_exists("footer.php"))
		require("footer.php");
?>
</body>
</html>