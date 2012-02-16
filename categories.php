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
  <div class="block_title"><img src="images/theme6_9x2.png" width="156" height="35" /></div>
  <div style="float:left"><img src="images/theme6_9x5.png" width="8" height="35" /></div>
</div>
<div class="block">
<div style="width:593px">
<div style="padding-left:5px; padding-top:20px">
	<?php
		//get 4 random categories
		$categories=consumeWebservice("getCategories",array(clientid=>$clientid,limit=>4));

		$i=1;
		foreach($categories->node as $node){
			//category id
			$cid=$node->attributes()->catid;
			
			//if the description length is too long then trim it
			if(strlen($node->attributes()->description) > 100)
				$node->attributes()->description=substr($node->attributes()->description,0,100)."...";
	?>
	<div class="prodiv<?=($i % 2)? '':2 ?>">
        <div class="floatdiv" style="padding-right:10px"><a href="search.php?category=<?=$cid?>"><img src="<?=((string)$node->attributes()->imagetype)? "http://onlinestore.softexsw.net/webservice/viewimage.php?imgtype=catthumb&id=".$cid : "images/no photo.jpg"?>" width="78" height="78" border="0" class="border" /></a></div>
	  <div class="floatdiv" style="width:188px">
	    <span class="title2"><strong><a href="search.php?category=<?=$cid?>"><?=$node->attributes()->catname?></a></strong></span><br />
	    <div class="text1" style="color:#505050; text-align:justify"><?=$node->attributes()->description?>
		 <div style="padding-top:10px">
		 <?php
		 	//if there is items then display min and max price , if there is only one item then display only min
		 	if((int)$node->attributes()->minprice && (int)$node->attributes()->maxprice && chk_storesetting("price")){
		 ?> 
		 		<strong>from</strong> <span class="price">$<?=$node->attributes()->minprice?></span>
			 <?php
				if((int)$node->attributes()->minprice != (int)$node->attributes()->maxprice){
			 ?> 
			 	<strong>to</strong> <span class="price">$<?=$node->attributes()->maxprice?></span>
		 <?php
		 		}//end second if
		 	}
		 ?>
		</div>
	        <div align="right" style="padding-top:6px"><a href="search.php?category=<?=$cid?>"><img src="images/theme6_11x2.png" width="61" height="23" border="0" /></a></div>
        </div> 
      </div>
</div>
	<?php
			//apply a breaker div using " odd or even " check after each 2 categories
			if(!($i % 2)){
				echo "<div style='height:30px;clear:both'><img src='images/blank.gif' /></div>";
			}
			$i++;
		}//end foreach
	?>
<div style="height:15px; clear:both"></div>
</div>
</div>
</div>
