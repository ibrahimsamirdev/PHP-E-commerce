<?php
	//if the main page is advance search then use asearch in form submition else use search
	if($asearch)
		$searchform="asearch";
	else
		$searchform="search";
		
	//if form action is update shubcategory list then don't display resul ( exit )
	if($action == "update_subcat")
		exit;
		
	//this checks if this page is the main page or not
	//so whether to include the "osstyles.css" or not [i.e. not including it in each call of page parts]
	if(!$mainpage){
		//include lib.php (this file is a liberary for most common modules and function used by the system)
		if(file_exists("lib.php"))
			require("lib.php");
		
		if(!isset($category))
			$category="all";
		
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<link href="osstyles.css" rel="stylesheet" type="text/css">
    <link href="new osstyles.css" rel="stylesheet" type="text/css" />
<?php
	}//end if
?>
<script language="javascript" type="text/javascript">
	//navigate to the desired page [paging] submit search form with the new page offset
	function jumptopage(pageoffset){
		document.getElementById("<?=$searchform?>").page.value=pageoffset;
		document.getElementById("<?=$searchform?>").submit();
	}

	//change the number of results viewed per page	
	function itemsPerPage(selection){ 
	  document.getElementById("<?=$searchform?>").rowsPerPage.value=selection.options[selection.selectedIndex].value;
	  document.getElementById("<?=$searchform?>").submit();
	}
</script>
<?php
	// how many rows (search result) to show per page
	if(!$rowsPerPage)
		$rowsPerPage = 10;

	// first time show first page by default
	$pageNum = 1;
	if(isset($page))
	{
		$pageNum = $page;
	}
	// counting the offset (from where to start the selection)
	$offset = ($pageNum - 1) * $rowsPerPage;
		
?>

	<?php
		//prepare the query condition according to the search mask
		$condition="&clientid=$clientid";
		$condition.="&offset=$offset";
		$condition.="&rowsPerPage=$rowsPerPage";
		if(chk_storesetting("price"))
			$condition.="&priceOn=1";
		if(chk_storesetting("discount"))
			$condition.="&discountOn=1";
			
		if($itemname)
			$condition.="&itemname=$itemname";
		if($category != "all")
			$condition.="&category=$category";
		if($subcategory)
			$condition.="&subcategory=$subcategory";
		if($price){
			$condition.="&price=$price";
		}
		if($partnumber && chk_storesetting("partnumber"))
			$condition.="&partnumber=$partnumber";
		if($manufacturer && chk_storesetting("manufacturer"))
			$condition.="&manufacturer=$manufacturer";
		if($origin && chk_storesetting("origin"))
			$condition.="&origin=$origin";
		//the free search field used to search throwgh the custom specs fields
		if($freesearch)
			$condition.="&freesearch=$freesearch";
		//prepare for order by
		if($orderby){
			$condition.="&orderby=$orderby";
		}
		if($order)
			$condition.="&order=$order";
			
		//get search result
		$result=consumeWebservice2("getSearchResult",$condition);
		$numrows=$result->node2->attributes()->numrows;
	?>
	<div>
  <div style="float:left"><img src="images/theme6_9x1.png" width="21" height="35" /></div>
  <div class="block_title"><div style="float:left"></div>
  
  <div class="title3"><div style="padding-left:10px; padding-top:5px"><strong>Found (<?=$numrows?>) item<?=$numrows == 1 ?"":"s";?></strong></div></div>
  <div class="title3" style="width:130px; padding-top:3px">
	    <label>
	    <select name="itemspp" class="fields" id="itemspp" style="height:20px" onChange="itemsPerPage(this)">
	      <option value="10" <?=$rowsPerPage == "10"? "selected='selected'":""?>>10</option>
	      <option value="20"  <?=$rowsPerPage == "20"? "selected='selected'":""?>>20</option>
	      <option value="40"  <?=$rowsPerPage == "40"? "selected='selected'":""?>>40</option>
        </select>
	    <strong>Items p/p</strong></label>
    </div>
  </div>
  <div style="float:left"><img src="images/theme6_9x5.png" width="8" height="35" /></div>
</div>

<div class="block">
<div style="width:593px">
<div style="padding-left:5px; padding-top:20px">
		<?php
		foreach($result->node as $node){
			$itemprice=(int)$node->attributes()->price;
			$itemdiscount=(int)$node->attributes()->discount;
			//if the description length is too long then trim it
			if(strlen($node->attributes()->description) > 150)
				$node->attributes()->description=substr($node->attributes()->description,0,150)."...";
	?>
	<div style="height:95px">
        <div class="floatdiv" style="padding-right:10px; height:95px; width:95px"><a href="viewproduct.php?iid=<?=$node->attributes()->itemid?>"><img src="<?=((int)$node->attributes()->picid)? "http://onlinestore.softexsw.net/webservice/viewimage.php?imgtype=itemthumb&id=".$node->attributes()->picid : "images/no photo.jpg"?>" align="left" style="border:#CCCCCC 1px solid" /></a></div>
	  <div class="floatdiv" style="width:250px">
	    <span class="title2"><strong><a href="viewproduct.php?iid=<?=$node->attributes()->itemid?>"><?=$node->attributes()->itemname?></a></strong></span><br />
	    <div class="text1" style="color:#505050; text-align:justify"><?=chk_storesetting("description")? $node->attributes()->description:""?></div> 
      </div>
	  <div class="price floatdiv" style="width:140px ;text-align:center; padding-top:35px">
	  <?php
	  	//check if price setting is "on" in the store settings
		if(chk_storesetting("price")){
			if($itemdiscount && $itemprice && chk_storesetting("discount")){
				echo "<span class='priceoff'>$".$itemprice."</span><br />";
				$itemprice-=$itemdiscount;
			}
			if($itemprice)
				echo "$".$itemprice;
		}
	  ?></div>
	  <div class="floatdiv" style="padding-top:35px"><a href="updatecart.php?action=add&iid=<?=$node->attributes()->itemid?>&ref=viewcart.php"><img src="images/theme6_11x4.png" width="84" height="23" border="0" /></a></div>
	  
    </div>
	<div><img src="images/catsepa2.gif" width="580" height="2" vspace="6" /></div>
	<?php
		}//end while
	?>
<div>
<?php

//total pages number
$maxPage = ceil($numrows/$rowsPerPage);

// print the link to access each page
$self = $_SERVER['PHP_SELF'];
$nav  = '';

for($page = 1; $page <= $maxPage; $page++)
{
   if ($page == $pageNum)
   {
      $nav .= " $page "; // no need to create a link to current page
   }
   else
   {
      $nav .= " <a href=\"javascript:void(0);\" onClick=\"jumptopage($page); return false;\">$page</a> ";
   } 
}

//create previous and next buttons as well first and last
if ($pageNum > 1)
{
   $page  = $pageNum - 1;
   $prev = "<img src='images/prevp.png' alt='Previous' width='15' height='22' hspace='4' align='absmiddle' style='cursor:pointer' onClick=\"jumptopage($page)\" />";
   
   $first  = "<img src='images/firstp.png' alt='First' width='23' height='22' hspace='4' align='absmiddle' style='cursor:pointer' onClick=\"jumptopage(1)\" /> ";
   
} 
else
{
   $prev  = '&nbsp;'; // we're on page one, don't print previous link
   $first = '&nbsp;'; // nor the first page link
}

if ($pageNum < $maxPage)
{
   $page = $pageNum + 1;
   $next = " <img src='images/nextp.png' alt='Next' width='15' height='22' hspace='4' align='absmiddle' style='cursor:pointer' onClick=\"jumptopage($page)\" />";

   $last = "<img src='images/lastp.png' alt='Last' width='23' height='22' hspace='4' align='absmiddle' style='cursor:pointer' onClick=\"jumptopage($maxPage)\" />";
} 
else
{
   $next = '&nbsp;'; // we're on the last page, don't print next link
   $last = '&nbsp;'; // nor the last page link
}

// print the navigation link
//echo $first . $prev . $nav . $next . $last;

?>
</div>
<?php
	//if search result > number of result (items) per page then display pageing navigation
	if($numrows > $rowsPerPage){
?>
<div align="center" style="clear:both; padding-top:5px;"><?=$first.$prev?><span class="paging" style="padding-left:6px; padding-right:6px"><?=$nav?></span><?=$next.$last?></div>
<?php
	}//end if
?>
</div></div></div>
