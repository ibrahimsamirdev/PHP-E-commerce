<?php
	//this checks if this page is the main page or not
	//so whether to include the "osstyles.css" or not [i.e. not including it in each call of page parts]
	if(!$mainpage){
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<link href="osstyles.css" rel="stylesheet" type="text/css">
	<link href="new osstyles.css" rel="stylesheet" type="text/css" />
<?php
	}//end if
?>
<div style="background-image:url(images/tileup.png); background-repeat:repeat-x">
<table width="840" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="326" height="102" align="center" valign="top" ><div style="padding-top:34px"><a href="index.php"><img src="images/logo.gif" width="251" height="50" border="0" /></a></div></td>
    <td width="39" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td width="54" valign="middle"><a href="viewcart.php"><img src="images/cart.gif" alt="View cart" width="46" height="40" border="0" /></a></td>
    <td width="178" valign="top">
	<div  class="text1" style="padding-top:33px"><strong>Shopping Cart </strong></div>	<span class="text2" style="font-size:12px"><a href="viewcart.php"><?=count($_COOKIE['cart'])?> items</a></span></td>
    <td width="243" valign="top"><img src="images/theme6_2x2.png" width="243" height="102" /></td>
    </tr>
</table>
</div>