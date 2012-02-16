<?php
	//indicate that this is the main page [needed in modules pages -- to stop calling lib in the module pages]
	$mainpage=true;
	//include lib.php (this file is a liberary for most common modules and function used by the system)
	if(file_exists("lib.php"))
		require("lib.php");

	if($action == "submit"){
		if($name == "")
			$error[0]="name required !";
		else if(strlen($name) < 4)
			$error[0]="name length < 4 !";
		//check email
		if(!ereg("^[^@ ]+@[^@\. ]+\.[^@\. ]+$",$email))
			$error[1]="invalid email!";
			
		if(!count($error)){
			$validsubmit=true;
		}
	}//end if send

	//if the form is valid then don't display the output , instade store in a variable
	if($validsubmit)
		ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="softex, software, house, egypt, cairo, online, store, e-commerce, commerce" />
<meta name="description" content="Add, organize, show, and sell your products online" />
<meta name="author" content="Ibrahim Samir, himalking@yahoo.com" />
<meta name="copyright" content="softex software house" />
<title>Quotation Request</title>
<script language="javascript" type="text/javascript">
	function submitform(){
		document.getElementById('action').value="submit";
		document.getElementById('sendemail').submit();
	}
</script>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

form {
	margin: 0px;
	padding: 0px;
}
.fields {
	font-family: Tahoma, Verdana, Arial;
	font-size: 12px;
	color: #666666;
	background-color: #FFFFFF;
	border-width: 1px;
	border-style: solid;
	border-top-color: #787878;
	border-right-color: #BDC9CA;
	border-bottom-color: #BDC9CA;
	border-left-color: #787878;
	height: 17px;
	vertical-align: middle;
}
.text1 {
	font-family: Tahoma, Verdana, Arial;
	font-size: 12px;
	color: #808080;
}
.text2 {
	font-family: Tahoma, Verdana, Arial;
	font-size: 11px;
	color: #F56B29;
}
.text2 a:link, .text2 a:visited, .text2 a:active {
	color: #FE6601;
	text-decoration: none;
}
.text2 a:hover {
	color: #FE6601;
	text-decoration: underline;
}
.link1 {
	font-family: Arial, Tahoma, Verdana;
	font-size: 12px;
	color: #646464;
}

.link1 a:link, .link1 a:visited, .link1 a:active {
	color: #3f6b9b;
	text-decoration: underline;
}
.link1 a:hover {
	color: #6692C1;
	text-decoration: underline;
}
.link2 {
	font-family: Arial, Tahoma, Verdana;
	font-size: 11px;
	color: #646464;
}

.link2 a:link, .link2 a:visited, .link2 a:active {
	color: #4e6176;
	text-decoration: none;
}
.link2 a:hover {
	color: #FB7700;
	text-decoration: underline;
}
.add-link {
	font-family: Arial, Tahoma, Verdana;
	font-size:13px;
	color: #646464;	
	border:#dbdbdb 1px solid;
	padding:2px;
	float:left;
}
.add-link a:link, .add-link a:visited, .add-link a:active {
	color: #4e6176;
	text-decoration: none;
}
.add-link a:hover {
	color: #FB7700;
	text-decoration: none;
}
.paging {
	font-family: Tahoma, Verdana, Arial;
	font-size:14px;
	color: #FB7700;
	font-weight: bold;
}
.paging a:link, .paging a:visited, .paging a:active {
	color: #4e6176;
	text-decoration: none;
}
.paging a:hover {
	color: #FB7700;
	text-decoration: none;
}
.copyright {
	font-family: Arial, Tahoma, Verdana;
	font-size: 11px;
	color: #646464;
}
.copyright a:link, .copyright a:visited, .copyright a:active {
	color: #808080;
	text-decoration: none;
}
.copyright a:hover {
	color: #3C3C3C;
	text-decoration: underline;
}
.footer {
	font-family: Arial, Verdana, "Times New Roman";
	color: #666666;
	font-size: 11px;
}
.footer a:link, .footer a:visited, .footer a:active {
	color: #228DCE;
	text-decoration: underline;
}
.footer a:hover {
	color: #FF6600;
	text-decoration: underline;
}
.border {
	border: 1px solid #a7aeb8;
}

.blox1 {
	border: 1px solid #c0c0c0;
	background-image: url(images/blocktile.png);
	background-repeat: repeat-x;
}
.blox2 {
	border: 1px solid #FFFFFF;
}
.bloxtitle1 {
	font-family: Tahoma, Verdana, Arial;
	font-size: 13px;
	font-weight: bold;
	color: #71980e;
}

.titlediv {
	background-image: url(images/titleback.gif);
	background-repeat: no-repeat;
	height: 35px;
	padding-top: 16px;
	padding-left: 42px;
}
.title1 {
	font-family: Tahoma, Verdana, Arial;
	font-size: 14px;
	color: #2a74a9;
}
.title1 a:link, .title1 a:visited, .title1 a:active {
	color: #2a74a9;
	text-decoration: none;
}
.title1 a:hover {
	color: #2a74a9;
	text-decoration: underline;
}
.title2 {
	font-family: Tahoma, Verdana, Arial;
	font-size: 12px;
	color: #2a74a9;
	font-weight: bold;
}
.title2 a:link, .title2 a:visited, .title2 a:active {
	color: #2a74a9;
	text-decoration: underline;
}
.title2 a:hover {
	color: #2a74a9;
	text-decoration: none;
}
.floatdiv {
	float: left;
}

.prodiv {
	float: left;
	width: 288px;
	border-right-width: 1px;
	border-right-style: solid;
	border-right-color: #c0c0c0;
}
.prodiv2 {
	float: left;
	width: 288px;
	padding-left: 10px;
}
.price {
	font-family: Tahoma, Verdana, Arial;
	font-size: 16px;
	font-weight: bold;
	color: #FE6601;
}
.color1 {
	color: #FE6601;
}
.resultblock {
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #CCCCCC;
	padding-top: 5px;
}
.priceoff {
	text-decoration: line-through;
	font-size: 14px;
	color: #999999;
	font-weight: bold;
	font-family: Tahoma, Verdana, Arial;
}.color2 {

	color: #505050;
}
.block2_A {
	border: 1px solid #dbdbdb;
	font-family: Tahoma, Verdana, Arial;
	font-size: 13px;
	color: #5a5a5a;
	padding-bottom: 15px;
}
.block2_B {
	font-family: Arial, Tahoma, Verdana;
	font-size: 13px;
	font-weight: bold;
	color: #666666;
	background-color: #eeeced;
	height: 20px;
	padding-left: 15px;
	border-top-width: 1px;
	border-bottom-width: 1px;
	border-top-style: solid;
	border-bottom-style: solid;
	border-top-color: #FFFFFF;
	border-bottom-color: #dbdbdb;
	padding-top: 3px;
}
.asearchdiv {
	background-image: url(images/asearchback.gif);
	background-repeat: no-repeat;
	padding-left: 50px;
}
.tfield_div {
	background-image: url(images/tfield_tile.png);
	background-repeat: repeat-x;
	float: left;
	height: 22px;
}
.tfield {
	font-family: Tahoma, Verdana, Arial;
	font-size: 12px;
	color: #666666;
	border: 0px solid #FFFFFF;
	background-color: transparent;
}
.tfield_title {
	font-family: Tahoma, Verdana, Arial;
	font-size: 11px;
	font-weight: bold;
	color: #666666;
	float: left;
	padding-top: 4px;
	padding-right: 10px;
}
.brdr_lft {
	border-left-width: 1px;
	border-left-style: solid;
	border-left-color: #ccd7da;
}
.brdr_right {
	border-right-width: 1px;
	border-right-style: solid;
	border-right-color: #ccd7da;
}
.brdr_top {
	border-top-width: 1px;
	border-top-style: solid;
	border-top-color: #ccd7da;
}
.brdr_botm {
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #ccd7da;
}
.cartitems_title {
	background-image: url(images/carttable_2x3.png);
	background-repeat: repeat-x;
	float: left;
	text-align: center;
	font-family: Tahoma, Verdana, Arial;
	font-size: 13px;
	color: #5F6783;
	font-weight: bold;
	padding-top: 10px;
	height: 29px;
}
.cartitems_block {
	background-image: url(images/carttable_4x1.png);
	background-repeat: repeat-y;
	clear: both;
	width: 764px;
	padding-top: 10px;
}
.cartitems_block2 {
	clear: both;
	width: 650px;
	padding-top: 10px;
	padding-bottom: 5px;
	border-bottom-width: 1px;
	border-bottom-style: solid;
	border-bottom-color: #B4B4B4;
}
.cartitems_sepa {
	background-image: url(images/catsepa.gif);
	background-position: 20px;
	height: 5px;
	clear: both;
}
.size1 {font-size: 11px}
.block2_B2 {

	font-family: Arial, Tahoma, Verdana;
	font-size: 13px;
	font-weight: bold;
	color: #5F6783;
	background-color: #eeeced;
	border-top-width: 1px;
	border-bottom-width: 1px;
	border-top-style: solid;
	border-bottom-style: solid;
	border-top-color: #FFFFFF;
	border-bottom-color: #B5B5B5;
	
	float: left;
	text-align: center;
	color: #5F6783;
	padding-top: 10px;
	height: 25px;
}
.title3 {
	font-family: "Times New Roman", Georgia, Arial;
	font-size: 18px;
	color: #414141;
}

-->
</style>
</head>

<body>
<?php
	//get client's company name for header title
	//$company=consumeWebservice("getCompany",array(clientid=>$clientid));
	//$company=$company->node->attributes()->company;
	
	//get all items of the cart
	//get cart items from the cookie
	//if there is a cookie defiened and there is items in the cart
	if(isset($_COOKIE['cart']) && count($_COOKIE['cart'])){
		//generate list of IDs
		foreach($_COOKIE['cart'] as $itemid => $quantity){
			$id_list.="&id[]=".$itemid;
		}
		//consume a given webservice using given $parametars string
		$items=consumeWebservice2("getCartItems",$id_list);
?>
<div style="height:30px"></div>
<div align="center">
  <form id="sendemail" name="sendemail" method="get" action="<?=$_SERVER['PHP_SELF']?>">
  <div style="width:570px;border:#CFCFCF 1px solid">
		<div class="block2_B2" style="width:550px; border-right:#BCBCBC 1px solid; text-align:left; padding-left:20px">
		Please fill in the following form</div>
	<div class="text1" style="clear:both; width:490px; padding:40px; text-align:left; color:#999900">
	<div class="floatdiv" style="width:100px; padding-top:2px; font-size:16px">Name</div>
	<div class="floatdiv" style="width:350px"><input name="name" type="text" class="fields" id="name" style="width:200px; color:#333333" value="<?=$name?>" /> 
	  <span style="color:#FF0000" ><?=$error[0]; ?></span> </div>
	<div style="clear:both; height:6px"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="floatdiv" style="width:100px; padding-top:2px; font-size:16px">Email</div>
	<div class="floatdiv" style="width:350px"><input name="email" type="text" class="fields" id="email" style="width:200px; color:#333333" value="<?=$email?>" /> 
	<span style="color:#FF0000" ><?=$error[1]; ?></span>	</div>
	<div style="clear:both; height:6px"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="floatdiv" style="width:100px; padding-top:2px; font-size:16px">Company</div>
	<div class="floatdiv" style="width:350px"><input name="company" type="text" class="fields" id="company" style="width:200px; color:#333333" value="<?=$company?>" />
	</div>
	<div style="clear:both; height:6px"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="floatdiv" style="width:100px; padding-top:2px; font-size:16px">Comment</div>
	<div class="floatdiv" style="width:350px">
	  <textarea name="comment" rows="3" class="fields" id="comment" style="width:200px; height:50px; color:#333333"><?=$comment?></textarea>
	</div>
	<div style="clear:both; height:6px"><img src="images/blank.gif" width="1" height="1" /></div>
	
	</div>
	<div style="clear:both"><img src="images/blank.gif" width="1" height="1" /></div>
  </div>
  <input name="action" type="hidden" id="action" />
  </form>
</div>

<div style="height:30px"></div>
<div align="center" class="title3" >You have requested quotation for</div>
<div style="height:10px"></div>

<input name="action" type="hidden" id="action" value="update" />
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="650" height="180" valign="top">
	<div style="width:650px;border:#CFCFCF 1px solid">
	
		<div class="block2_B2" style="width:570px; border-right:#BCBCBC 1px solid">Item</div>
		<div class="block2_B2" style="width:78px;border-left:#FFFFFF 1px solid;">Quantity</div>
		<?php
		//loop through cart items
		foreach($items->node as $node){
	?>
<div class="cartitems_block2">
        <div class="floatdiv" style="width:550px; padding-left:10px; padding-right:10px"><span class="title2"><strong><a href="productdetails.php?iid=<?=$itemid?>" target="_blank"><?=$node->attributes()->itemname?></a></strong></span>
          <div class="text1 size1" style="padding-top:10px; padding-bottom:5px"><strong>Item Code&nbsp;&nbsp;&nbsp;&nbsp; : </strong><?=$node->attributes()->itemcode?><br />
            <strong>Part Number :</strong> <?=$node->attributes()->partnumber?></div> 
	  </div>
	    <div class="floatdiv" style="width:80px; text-align:center">
	    <input name="quantities[<?=$itemid?>]" type="text" class="fields" id="quantities[<?=$itemid?>]" style="height:15px;width:30px" value="<?=$_COOKIE['cart'][$itemid]?>" onKeyPress="return false" />
	    </div>
	    <div style="clear:both; height:5px"><img src="images/blank.gif" width="1" height="1" /></div>
	  </div>
      <?php
		}//end foreach
	?>
	</div></td>
  </tr>
</table>
<div align="center">
<?php
	//so that not to display those links in the email
	if(!$validsubmit){
?>
  <div class="link1" style="padding-top:15px"><a href="javascript:submitform()"><strong>SUBMIT</strong> <img src="images/arrow3.gif" width="16" height="15" border="0" align="absmiddle" /></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="javascript:window.close();"><strong>CANCEL</strong> <img src="images/arrow3.gif" width="16" height="15" border="0" align="absmiddle" /></a></div>
<?php
	}//end if
?>
</div>
  <?php
	}//end if isset(cookie[cart])
?>
<div align="center" class="footer" style="padding:20px"><br />
<a href="http://www.softexsw.com" target="_blank">Powered by SOFTEXSW </a></div>

</body>
</html>
<?php
	
	//if the form is valid then don't display the output , instade store in a variable
	if($validsubmit){
		$bodycontent=ob_get_contents();
		ob_end_clean();

			if(file_exists("send mail/sendmail.php"))
				require("send mail/sendmail.php");
				
			//get client's email to send to
			$clientemail=consumeWebservice("getEmail",array(clientid=>$clientid));
			$clientemail=$clientemail->node->attributes()->email;
			
			//call sendmail function
			//sendmail($from,$name,$to,$message)
			if(sendmail($email,$name,$clientemail,$bodycontent))
				//header("Location: message_sent.html");
				echo "<script language=javascript>window.location.href='message_sent.html'</script>";
				//echo "message has been sent";
			else
				//header("Location: message_failed.html");
				echo "<script language=javascript>window.location.href='message_failed.html'</script>";
				//echo "error sending message";
	}
?>