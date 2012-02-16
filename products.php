<?php
	//this checks if this page is the main page or not
	//so whether to include the "osstyles.css" or not [i.e. not including it in each call of page parts]
	if(!$mainpage){
		//include lib.php (this file is a liberary for most common modules and function used by the system)
		if(file_exists("lib.php"))
			require("lib.php");
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<link href="osstyles.css" rel="stylesheet" type="text/css">
	<link href="new osstyles.css" rel="stylesheet" type="text/css" />
<?php
	}//end if
?>

<div>
  <div style="float:left"><img src="images/theme6_9x1.png" width="21" height="35" /></div>
  <div class="block_title"><img src="images/featured prod.gif" width="156" height="35" /></div>
  <div style="float:left"><img src="images/theme6_9x5.png" width="8" height="35" /></div>
</div>
<div class="block">
<div style="width:593px">
<div style="padding-left:5px; padding-top:20px">
<?php

		//get 4 random products
		$items=consumeWebservice("getItems",array(clientid=>$clientid,limit=>4));
		
		$i=1;
		foreach($items->node as $node){
			//if the description length is too long then trim it
			if(strlen($node->attributes()->description) > 120)
				$node->attributes()->description=substr($node->attributes()->description,0,120)."...";
	?>
	<div class="prodiv<?=($i % 2)? '':2 ?>">
	  <div >
	    <div class="floatdiv" style="padding-right:5px; height:100px"><a href="viewproduct.php?iid=<?=$node->attributes()->itemid?>"><img src="<?=((int)$node->attributes()->picid)? "http://onlinestore.softexsw.net/webservice/viewimage.php?imgtype=itemthumb&id=".$node->attributes()->picid : "images/no photo2.jpg"?>" align="left" style="border:#CCCCCC 1px solid" /></a></div>
	    <div class="floatdiv" style="width:178px; height:100px">
	      <span class="title2"><strong><a href="viewproduct.php?iid=<?=$node->attributes()->itemid?>"><?=$node->attributes()->itemname?></a></strong></span><br />
	      <div class="text1" style="color:#505050; text-align:justify"><?=chk_storesetting("description")? $node->attributes()->description:""?></div> </div>
	  </div>
	    <div style="clear:both; padding-top:5px"><div class="price floatdiv" style="width:120px; text-align:center">
		<?php
	  	//check if price setting is "on" in the store settings
		if(chk_storesetting("price")){
			if((int)$node->attributes()->discount && (int)$node->attributes()->price && chk_storesetting("discount")){
				echo "<span class='priceoff'>$".$node->attributes()->price."</span> &nbsp;";
				$node->attributes()->price-=$node->attributes()->price=$node->attributes()->discount;
			}
			if((int)$node->attributes()->price)
				echo "$".$node->attributes()->price;
		}
	  ?>
		  <img src="images/blank.gif" width="1" height="1" />
		</div>
	    <div class="floatdiv" style="width:70px;"><a href="viewproduct.php?iid=<?=$node->attributes()->itemid?>"><img src="images/theme6_11x2.png" width="61" height="23" border="0"  /></a></div>
	    <div><a href="updatecart.php?action=add&iid=<?=$node->attributes()->itemid?>&ref=<?=$_SERVER['PHP_SELF']?>"><img src="images/theme6_11x4.png" width="84" height="23" border="0" /></a></div>
	    </div>
</div>
<?php
		//apply a breaker div using " odd or even " check after each 2 items (products)
		if(!($i % 2)){
				echo "<div style='height:30px;clear:both'><img src='images/blank.gif' /></div>";
			}
		$i++;
	}//end while
?>
<div style="height:15px; clear:both"></div>
</div>
</div>
</div>
