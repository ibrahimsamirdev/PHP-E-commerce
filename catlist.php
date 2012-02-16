<?php
	//this checks if this page is the main page or not
	//so whether to include the "osstyles.css" or not [i.e. not including it in each call of page parts]
	if(!$mainpage){
		//include lib.php (this file is a liberary for most common modules and function used by the system)
		if(file_exists("lib.php"))
			require("lib.php");
			
		//get list of all categories
		$categories=consumeWebservice("getCategoriesList",array(clientid=>$clientid));
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<link href="osstyles.css" rel="stylesheet" type="text/css">
	<link href="new osstyles.css" rel="stylesheet" type="text/css" />
<?php
	}//end if
?>
<script language="javascript" type="text/javascript">
	function showsubcat(catnumber){
		//offset is "cat" char number
		offset=3;
		id=catnumber.substr(offset);
		subcatdiv=document.getElementById("subcategory"+id);
		//if there sub category for this category
		if(subcatdiv){
			//get the category X position
			newX=calculateOffsetLeft(document.getElementById(catnumber))+187;
			subcatdiv.style.left=newX+"px";
			//get the category Y position
			newY=calculateOffsetTop(document.getElementById(catnumber));
			subcatdiv.style.top=newY+"px";
			subcatdiv.style.display ="block";
		}
	}
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function hidesubcat(catnumber){
		//offset is "cat" char number
		offset=3;
		id=catnumber.substr(offset);
		subcatdiv=document.getElementById("subcategory"+id);
		//if there sub category for this category
		if(subcatdiv){
			subcatdiv.style.display ="none";
		}
	}	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function subcatover(divname){
		document.getElementById(divname).className="catitem_over";
	}
	
	function subcatout(divname){
		document.getElementById(divname).className="catitem";
	}	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function subcatitem_over(subcatitem){
		document.getElementById(subcatitem).className="subcatitem_over";
	}	
	///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function subcatitem_out(subcatitem){
		document.getElementById(subcatitem).className="subcatitem";
	}	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//calculate the X position of an element
	function calculateOffsetLeft(fld) {
		var offset = 0;
		while (fld) {
			if (fld.offsetParent) {
				offset += (fld.offsetLeft - fld.scrollLeft);
			} else {
				offset += fld.offsetLeft;
			}
			fld = fld.offsetParent
		}
		return offset;
	}
	
	//calculate the y position of an element
	function calculateOffsetTop(fld) {
		var offset = 0;
		while (fld) {
			if (fld.offsetParent) {
				offset += (fld.offsetTop - fld.scrollTop);
			} else {
				offset += fld.offsetTop;
			}
			fld = fld.offsetParent
		}
		return offset;
	}

</script>

<div style="padding-left:12px; padding-top:5px">
<div>
  <div style="float:left"><img src="images/theme6_7x2.png" width="19" height="36" /></div>
  <div class="cat_titleblock" style="width:183px"><img src="images/theme6_7x3.png" width="84" height="36" /></div>
  <div style="float:left"><img src="images/theme6_7x6.png" width="8" height="36" /></div>
</div>

<div class="block" style="background-image:url(images/theme6_13x1.png)">
<div style="width:193px">
<div style="padding-left:5px; padding-top:5px">
    <?php
		//get list of all categories
		//counter for categories to name each category div
		$counter1=1;
		foreach($categories->node as $node){
	?>
	<div class="catitem" id="cat<?=$counter1?>" onmouseover="showsubcat(id); subcatover(id)" onmouseout="hidesubcat(id); subcatout(id)" onclick="window.location.href='search.php?category=<?=$node->attributes()->catid?>'">
	    <div style="float:left"><img src="images/arrow2.gif" width="4" height="8" hspace="5" vspace="5" border="0" align="absmiddle" /></div>
	    <?=$node->attributes()->catname?>
	<?php
			//get list of all sub categories
				if(count($categories->node2)){
	?>
    				<div class="subcategory" id="subcategory<?=$counter1?>" style="visibility:hidden">
	<?php
					//counter for subcategories
					$counter2=1;
					foreach($categories->node2 as $node2){
						if((int)$node->attributes()->catid == (int)$node2->attributes()->catid){
							//re display the subcategory div
							echo "<script language='javascript' type='text/javascript'>
									document.getElementById('subcategory$counter1').style.visibility='visible';
									</script>";
	?>
					<a href="search.php?category=<?=$node->attributes()->catid?>&subcategory=<?=$node2->attributes()->subcatid?>" style="text-decoration:none"><div class="subcatitem" id="subcatitem<?=$counter1?>_<?=$counter2?>" onmouseover="subcatitem_over(id)" onmouseout="subcatitem_out(id)"><?=$node2->attributes()->subcatname?></div></a>
	<?php
						$counter2++;
						}//end if
					}//end while subcat
	?>
					</div>
	<?php
				}//end if mysql_num_rows
	?></div>
      <div style="clear:both"></div>
      
    <?php
			$counter1++;
			}//end while
		?>
</div></div>
<div style="height:5px"><img src="images/blank.gif" width="1" height="1" /></div>
</div>
<div>
  <div style="float:left"><img src="images/theme6_14x1.png" width="15" height="13" /></div>
  <div class="block_bottom" style="width:181px"><img src="images/blank.gif" width="1" height="1" /></div>
  <div style="float:left"><img src="images/theme6_14x4.png" width="14" height="13" /></div>
</div>
</div>