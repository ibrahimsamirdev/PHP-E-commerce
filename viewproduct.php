<?php
	//indicate that this is the main page [needed in modules pages -- to stop calling lib in the module pages]
	$mainpage=true;
	//include lib.php (this file is a liberary for most common modules and function used by the system)
	if(file_exists("lib.php"))
		require("lib.php");
	//for test
	if(!isset($iid))
		$iid=950;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="softex, software, house, egypt, cairo, online, store, e-commerce, commerce" />
<meta name="description" content="Add, organize, show, and sell your products online" />
<meta name="author" content="Ibrahim Samir, himalking@yahoo.com" />
<meta name="copyright" content="softex software house" />
<title>Welcome to OUR online store - Product details</title>
<link href="osstyles.css" rel="stylesheet" type="text/css" />
<link href="new osstyles.css" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript">
	//popup product large image window
	function viewlargeimage(url){
			pLeft=(screen.width/2)-270;
			PTop=(screen.height/2)-250;
			detailed=window.open(url,"Previewimage",	"toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=<?=$imgMaxWidth?>,height=<?=$imgMaxHeight?>,left="+pLeft+",top="+PTop);
			detailed.document.focus();
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
-->
</style>
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
    <td width="231" height="620" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td width="231" height="618" valign="top">
          <?php
			//include categories list
			if(file_exists("catlist.php"))
				require("catlist.php");
		?>		</td>
        </tr>

    </table></td>
    <td width="605" valign="top">
	<?php
		//get item data
		$itemData=consumeWebservice("getItemData",array(id=>$iid,itemPics=>1,customSpecs=>1));
		$item = $itemData->node;
		$itemprice=(int)$item->attributes()->price;
		$itemdiscount=(int)$item->attributes()->discount;
		//if no result redirect to item not found page
		if(!count($item))
			echo "<script language='javascript' type='text/javascript'>window.location.href='itemnotfound.php';</script>";
	?>
	<div style="height:7px"><img src="images/blank.gif" width="1" height="1" /></div>
	<div class="title2" style="padding-bottom:10px"><a href="viewproduct.php?iid=<?=$iid?>"><?=$item[itemname]?></a></div>
	<div>
	  <?php
		$i=1;
		//loop through items pics
		foreach($itemData->node2 as $node){
	?>
	  <div class="floatdiv" style="padding-right:30px; height:95px"><img src="http://onlinestore.softexsw.net/webservice/viewimage.php?imgtype=itemthumb&id=<?=$node->attributes()->picid?>" alt="Click for larger preview" style="cursor:pointer" onclick="viewlargeimage('http://onlinestore.softexsw.net/webservice/previewlargeimage.php?id=<?=$node->attributes()->picid?>')" /></div>
        <?php
			//apply a breaker after each 4 images
			if(!($i%4))
				echo "<div style='clear:both; height:15px'></div>";	
			$i++;
		}//end while
	?>
	  </div>
	<div class="text1 color2" style="clear:both; padding-top:5px">
		<?php
			//if item price is on
			if(chk_storesetting("price") && $itemprice){
		?>
		  <div style="float:left">
			<strong>Price: </strong>
		<?php
			if(chk_storesetting("discount") && $itemdiscount >0){
				echo "<span class='priceoff'>$".$itemprice."</span> &nbsp;&nbsp;";
				$itemprice-=$itemdiscount;
			}
		?>
		  <span class='price' style='clear:both'>$<?=$itemprice?></span></div>
		<?php
			}//end if
		?>		
		  <div align="right" style="float:right; padding-right:20px"><a href="updatecart.php?action=add&iid=<?=$iid?>&ref=<?=$_SERVER['PHP_SELF']?>?iid=<?=$iid?>"><img src="images/theme6_11x4.png" width="84" height="23" border="0" /></a></div>
		  <div style="float:right; padding-top:2px; padding-right:5px"><span class="text2"><a href="productdetails.php?iid=<?=$iid?>" target="_blank"><strong>PRINT</strong> <img src="images/arrow3.gif" width="16" height="15" border="0" align="absmiddle" /></a></span></div>
	  </div>
	<div align="right" style="clear:both; height:20px; padding-right:33px">&nbsp;</div>
	<?php
		//if item description is on
		if(chk_storesetting("description") && (string)$item->attributes()->description){
	?>
	<div class="text1 color2"><strong>Product Description:</strong><br />
	  <br />
	  <div style="text-align:justify"><?=$item->attributes()->description?></div>
      </div>
	<br />
	<?php
		}//end if
	?>
	<div class="block2_A">
	  <div class="block2_B">Technical Information</div>
        <div style="padding-left:30px">
          <br />
          <span class="bloxtitle1" style="color:#666699">Category:</span> 
          <span class="link2" style="font-size:12px"><a href="search.php?category=<?=$item->attributes()->categoryid?>"><?=$item->attributes()->catname?></a></span><br />
          <?php
			//if there is any global items specifications definition
			if(count($GLOBALS[storesettings])){
				foreach($GLOBALS[storesettings] as $key=>$specname){
					//remove spaces from spec name to use as a variable
					$specname2=varformat($specname);
					if((string)$item->attributes()->$specname2 && $specname != "Price" && $specname != "Discount" && $specname != "Stock" && $specname != "Description"){
		?>
          <br />
          <span class="bloxtitle1" style="color:#666699"><?=$specname?>:</span> 
          <?php
						echo $item->attributes()->$specname2."<br/>";
					}//end if
				}//end foreach
			}//end if count
		?>
        </div>
      </div>
	<div style="height:15px"></div>
	<?php
		//get custom specs from specs node
		$customspecs=$itemData->node3;
		//if there is custom specs
		if(count($customspecs)){
	?>
	<div class="block2_A">
	  <div class="block2_B">Technical Specifications </div>
        <div style="padding-left:30px">
          <?php
		  	//loop through items custom specs
			foreach($customspecs as $node){
	?>
          <br />
          <span class="bloxtitle1"><?=$node->attributes()->specname?>:</span> <?=$node->attributes()->specvalue?>
          <br />
          <?php
			}//end foreach
	?>
        </div>
      </div>
	<?php
		}//end if count($customspecs)
	?>
	<div style="height:15px"></div>
	<div class="add-link"><a href="<?=$item->attributes()->url?>" target="_blank">
    <?=$item[linktitle]?></a></div>	<div style="clear:both; height:25px"></div></td>
  </tr>
</table>
<?php
	//include footer
	if(file_exists("footer.php"))
		require("footer.php");
?>
</body>
</html>