<?php
	//indicate that this is the main page [needed in modules pages -- to stop calling lib in the module pages]
	$mainpage=true;
	//include lib.php (this file is a liberary for most common modules and function used by the system)
	if(file_exists("lib.php"))
		require("lib.php");
	//if the price option is OFF then redirect to viewcart with no price page (viewcart_np.php)
	if(!chk_storesetting("price"))
		header("location: viewcart_np.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="softex, software, house, egypt, cairo, online, store, e-commerce, commerce" />
<meta name="description" content="Add, organize, show, and sell your products online" />
<meta name="author" content="Ibrahim Samir, himalking@yahoo.com" />
<meta name="copyright" content="softex software house" />
<title>Welcome to OUR online store - View Shopping cart items</title>
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
<script language="javascript" type="text/javascript">
	//this function to accept only numbers for the desired fields
	function onlyNumbers(evt)
	{
		var e = event || evt; // for trans-browser compatibility
		var charCode = e.which || e.keyCode;
	
		if ( charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
	
		return true;
	
	}
	
	//popup print Shopping Cart window
	function printwin(){
			pLeft=(screen.width/2)-320;
			PTop=(screen.height/2)-250;
			detailed=window.open("printcart.php","Print",	"toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=680,height=500,left="+pLeft+",top="+PTop);
			detailed.document.focus();
	}
</script>
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
<?php

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
	
		//caluculate bill info
		//total before discount
		$total=0;
		//total after discount
		$subtotal=0;
		//total discounts
		$saves=0;
		
		//loop through cart items
		foreach($items->node as $node){
			$itemid=(string)$node->attributes()->itemid;
			$itemprice=(int)$node->attributes()->price;
			$itemdiscount=(int)$node->attributes()->discount;
			
			$total+=$itemprice*$_COOKIE['cart'][$itemid];
			if(chk_storesetting("discount")){
				$saves+=$itemdiscount*$_COOKIE['cart'][$itemid];
			}
		}//end foreach
		
		if(chk_storesetting("discount"))
			$subtotal=$total-$saves;
		else
			$subtotal=$total;
?>
<table width="764" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="8" height="11" valign="top"><img src="images/cart_2x2.png" width="8" height="11" /></td>
    <td width="317" valign="top" class="brdr_top"><img src="images/blank.gif" width="1" height="1" /></td>
    <td width="270" rowspan="3" valign="top"><img src="images/cart_2x4.jpg" width="270" height="150" /></td>
    <td width="160" valign="top" class="brdr_top"><img src="images/blank.gif" width="1" height="1" /></td>
    <td width="9" valign="top"><img src="images/cart_2x6.png" width="9" height="11" /></td>
  </tr>
  <tr>
    <td height="124" valign="top" class="brdr_lft"><!--DWLayoutEmptyCell-->&nbsp;</td>
    <td valign="top"><div style="padding-left:15px; line-height:20px; height:60px">
	<?php if(chk_storesetting("discount")){ ?>
		<span class="priceoff" style="text-decoration:none" >Total: </span><span class="priceoff">$<?=$total?></span>
	<?php }//end if ?>
		<br />
        <span class="price">Subtotal: $<?=$subtotal?></span><br />
	<?php if($saves){ ?>
        <span class="bloxtitle1" style="font-size:14px">You save: $<?=$saves?></span>
	<?php }//end if ?>
	</div>
	<div style="padding-left:15px; padding-top:15px">
	<span class="text1">Print this form :</span> <span class="text2"><a href="javascript:printwin();"><strong>PRINT</strong> <img src="images/arrow3.gif" width="16" height="15" border="0" align="absmiddle" /></a></span><br />
    <span class="title1">Update your new changes </span><img src="images/update.png" alt="Update your cart changes" width="87" height="25" border="0" align="absmiddle" onclick="document.getElementById('updatecart').submit()" style="cursor:pointer" /></div></td>
    <td align="center" valign="bottom"><a href="#"></a></td>
    <td valign="top" class="brdr_right"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
  <tr>
    <td height="15" valign="top"><img src="images/cart_5x1.png" width="8" height="15" /></td>
    <td valign="top" class="brdr_botm"><img src="images/blank.gif" width="1" height="1" /></td>
    <td valign="top" class="brdr_botm"><img src="images/blank.gif" width="1" height="1" /></td>
  <td valign="top"><img src="images/cart_5x3.png" width="9" height="15" /></td>
  </tr>
</table>
<div style="height:10px"></div>
<form id="updatecart" name="updatecart" method="get" action="updatecart.php">
  <input name="action" type="hidden" id="action" value="update" />
<table width="764" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="764" height="73" valign="top"><div class="floatdiv"><img src="images/carttable_2x2.png" width="12" height="39" /></div>
    <div class="cartitems_title" style="width:80px">Remove</div>
    <div class="floatdiv"><img src="images/carttable_2x4.png" width="7" height="39" /></div>
    <div class="cartitems_title" style="width:303px">Item</div>
    <div class="floatdiv"><img src="images/carttable_2x4.png" width="7" height="39" /></div>
    <div class="cartitems_title" style="width:80px">Price</div>
	<div class="floatdiv"><img src="images/carttable_2x4.png" width="7" height="39" /></div>
    <div class="cartitems_title" style="width:80px">You Save </div>
	<div class="floatdiv"><img src="images/carttable_2x4.png" width="7" height="39" /></div>
    <div class="cartitems_title" style="width:80px">Quantity</div>
	<div class="floatdiv"><img src="images/carttable_2x4.png" width="7" height="39" /></div>
    <div class="cartitems_title" style="width:80px">Total</div>
	<div class="floatdiv"><img src="images/carttable_2x6.png" width="14" height="39" /></div>
	<?php
		//loop through cart items
		foreach($items->node as $node){
			$itemid=(string)$node->attributes()->itemid;
			$itemprice=(int)$node->attributes()->price;
			$itemdiscount=(int)$node->attributes()->discount;
	?>
	<div class="cartitems_block">
	<div class="floatdiv" style="width:12px"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="floatdiv" style="width:80px; text-align:center">
	  <input name="remove[<?=$itemid?>]" type="checkbox" id="remove[<?=$itemid?>]" value="checkbox" />
	</div>
	<div class="floatdiv" style="width:7px"><img src="images/blank.gif" width="1" height="1" /></div>	
	<div class="floatdiv" style="width:303px;"><span class="title2"><strong><a href="productdetails.php?iid=<?=$itemid?>" target="_blank"><?=$node->attributes()->itemname?></a></strong></span>
	  <div class="text1 size1" style="padding-top:10px; padding-bottom:5px"><strong>Item Code&nbsp;&nbsp;&nbsp;&nbsp; : </strong><?=$node->attributes()->itemcode?><br />
	    <strong>Part Number :</strong> <?=$node->attributes()->partnumber?></div> 
	</div>
	<div class="floatdiv" style="width:7px"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="price floatdiv" style="width:80px; text-align:center; font-weight:normal">
	<?php
			if($itemdiscount && $itemprice && chk_storesetting("discount")){
				echo "<span class='priceoff' style='font-weight:normal'>$".$itemprice."</span><br />";
				$itemprice-=$itemdiscount;
			}
			if($itemprice)
				echo "$".$itemprice;
			else
				echo "&nbsp;"
	  ?>
	</div>
	<div class="floatdiv" style="width:7px"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="floatdiv" style="width:80px; text-align:center">
	<?php
		if(chk_storesetting("discount") && $itemprice && $itemdiscount){
	?>
		<span class="bloxtitle1" style="font-size:14px">
		$<?=$itemdiscount?> </span><span class="text2"> (<?=round(($itemdiscount/$itemprice)*100, 1)?>%)</span>
	<?php
		}//end if
		else echo "<img src='images/blank.gif' width='1' height='1' />";
	?>
	</div>
	<div class="floatdiv" style="width:7px"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="floatdiv" style="width:80px; text-align:center">
	  <input name="quantities[<?=$itemid?>]" type="text" class="fields" id="quantities[<?=$itemid?>]" style="height:15px;width:30px" value="<?=$_COOKIE['cart'][$itemid]?>" onKeyPress="return onlyNumbers();" />
	  <br />
	  <span class="link2"><a href="javascript://" style="text-decoration:underline" onclick="document.getElementById('updatecart').submit()">update</a></span> </div>
	<div class="floatdiv" style="width:7px"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="floatdiv" style="width:80px; text-align:center"><span class="price">
	<?php
		if($itemprice){
			echo "$".$itemprice*$_COOKIE['cart'][$itemid];
		}
	  ?>
	</span></div>
	<div style="clear:both; height:5px; padding-left:4px" ><img src="images/cartsepa.gif" width="755" height="5" /></div>
	</div>
	<?php
		}//end foreach
	?>
	<div class="cartitems_block">
	<div class="floatdiv" style="width:12px"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="floatdiv" style="width:80px; text-align:center"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="floatdiv" style="width:7px"><img src="images/blank.gif" width="1" height="1" /></div>	
	<div align="center" class="floatdiv price " style="width:303px; font-size:14px">
	  SUBTOTALS</div>
	<div class="floatdiv" style="width:7px"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="floatdiv" style="width:80px; text-align:center"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="floatdiv" style="width:7px"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="floatdiv" style="width:80px; text-align:center">
	<?php if($saves){ ?>
		<span class="bloxtitle1" style="font-size:14px">$<?=$saves?></span>
	<?php }//end if ?>
	</div>
	
	<div class="floatdiv" style="width:7px"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="floatdiv" style="width:70px; text-align:center"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="floatdiv" style="width:7px"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="floatdiv" style="width:90px; text-align:center"><span class="price">$<?=$subtotal?></span></div>
	<div style="clear:both; height:5px; padding-left:4px" ><img src="images/blank.gif" width="1" height="1" /></div>
	</div>
	<div>
	<div class="floatdiv"><img src="images/carttable_6x1.png" width="12" height="19" /></div>
	<div class="floatdiv" style="height:19px;width:738px; background-image:url(images/carttable_6x3.png)"></div>
	<div class="floatdiv"><img src="images/carttable_6x5.png" width="14" height="19" /></div>
	</div>
	</td>
  </tr>
</table>

<div align="center">
<div align="right" class="link2" style="width:740px"><a href="#">page top</a></div>
<div style="padding-bottom:10px">
  <input type="image" name="imageField" src="images/blank.gif" />
  <a href="#"><img src="images/cart_4x2.gif" width="115" height="30" border="0" /></a> &nbsp;&nbsp;&nbsp;<a href="index.php"><img src="images/cshopping.gif" width="160" height="29" border="0" /></a></div>
</div>
</form>
<?php
	}//end if isset(cookie[cart])
?>
<div >
<?php
	//include footer
	if(file_exists("footer.php"))
		require("footer.php");
?>
</div>
</body>
</html>