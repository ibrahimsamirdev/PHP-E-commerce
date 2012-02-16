<?php
	//this checks if this page is the main page or not
	//so whether to include the "osstyles.css" or not [i.e. not including it in each call of page parts]
	if(!$mainpage){
		//include lib.php (this file is a liberary for most common modules and function used by the system)
		if(file_exists("lib.php"))
			require("lib.php");	
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="osstyles.css" rel="stylesheet" type="text/css">
<?php
	}//end if
?>
<script language="javascript" type="text/javascript">
	//load sub categories in subcategories combo box after selecting category
	function update_subcat(){
		document.getElementById("asearch").action.value="update_subcat";
		document.getElementById("asearch").submit();
	}
</script>
<div class="asearchdiv">
	<div style="height:45px"></div>
	  <form id="asearch" name="asearch" method="post" action="<?=$_SERVER['PHP_SELF']?>">
	  <div style="float:left">
	  <div style="clear:both">
	    <div class="floatdiv" style="width:200px" >
		  <div class="floatdiv"><img src="images/tfield_A.png" width="7" height="22" /></div>
		  <div class="tfield_div">
		    <input name="itemname" type="text" class="tfield" id="itemname" style="width:170px" value="<?=escapeinput($itemname)?>" />
		  </div>
		  <div class="floatdiv"><img src="images/tfield_B.png" width="7" height="22" /></div>
		</div>
	    <div style="float:left"><select name="category" id="category" style="width:135px" onChange="update_subcat()">
	      <option value="all" selected="selected">-All Categories-</option>
		<?php
			//get list of all categories
			foreach($categories->node as $node){
		?>
			<option value="<?=$node->attributes()->catid?>" <?=$node->attributes()->catid==$category?"selected='selected'":""?>><?=$node->attributes()->catname?></option>
		<?php
			}
		?>
	    </select></div>
	 </div>
	  <div style="clear:both">
		<?php
			//if this spec is on in (Admin settings) then display
			if(chk_storesetting("partnumber")){
		?>
	    <div class="floatdiv" style="width:200px" >
		<div class="tfield_title">Part Number  </div><br />
		  <div class="floatdiv"><img src="images/tfield_A.png" width="7" height="22" /></div>
		  <div class="tfield_div">
		    <input name="partnumber" type="text" class="tfield" id="partnumber" style="width:89px" value="<?=escapeinput($partnumber)?>" />
		  </div>
		  <div class="floatdiv"><img src="images/tfield_B.png" width="7" height="22" /></div>
		</div>
		<?php
			}//end if chk
		?>
		<div style="float:left"><br />
		  <select name="subcategory" id="subcategory" style="width:135px">
			  <option value="0" selected="selected">-Sub Categories-</option>
			  <?php
			  	//get id of first category to get it's sub categories for the first run
			  	/*if(!isset($category)){
					$qresult=mysql_query("SELECT catid FROM categories WHERE clientid = $clientid LIMIT 1");
					$tmpcat=mysql_fetch_array($qresult);
					$category=$tmpcat[catid];
				}*/
				
				//get list of all sub categories
				foreach($categories->node2 as $node2){
					if((int)$node2->attributes()->catid == $category){
			  ?>
			    <option value="<?=$node2->attributes()->subcatid?>" <?=$subcategory == $node2->attributes()->subcatid ? "selected='selected'":""?>><?=$node2->attributes()->subcatname?></option>
			  <?php
					}//end if
				}//end foreach
			  ?>
			    </select>
	    </div>
      </div>
	  <div style="clear:both">
		<?php
			//if this spec is on in (Admin settings) then display
			if(chk_storesetting("manufacturer")){
		?>		
	    <div class="floatdiv" style="width:200px" >
		<div class="tfield_title">Manufacturer</div>
		<br />
		  <div class="floatdiv"><img src="images/tfield_A.png" width="7" height="22" /></div>
		  <div class="tfield_div">
		    <input name="manufacturer" type="text" class="tfield" id="manufacturer" style="width:127px" value="<?=escapeinput($manufacturer)?>" />
		  </div>
		  <div class="floatdiv"><img src="images/tfield_B.png" width="7" height="22" /></div>
		</div>
		<?php
			}//end if chk
				
			//if this spec is on in (Admin settings) then display
			if(chk_storesetting("price")){
		?>
		<div class="floatdiv" style="width:100px" >
          <div class="tfield_title">Price &lt; </div>
		  <br />
          <div class="floatdiv"><img src="images/tfield_A.png" width="7" height="22" /></div>
		  <div class="tfield_div">
            <input name="price" type="text" class="tfield" id="price" style="width:68px" value="<?=escapeinput($price)?>" />
          </div>
		  <div class="floatdiv"><img src="images/tfield_B.png" width="7" height="22" /></div>
	    </div>
		<?
			}//end if chk

			//if this spec is on in (Admin settings) then display
			if(chk_storesetting("origin")){
		?>		
		<div class="floatdiv" style="width:210px" >
		<div class="tfield_title">Origin </div>
		<br />
		  <div class="floatdiv"><img src="images/tfield_A.png" width="7" height="22" /></div>
		  <div class="tfield_div">
		    <input name="origin" type="text" class="tfield" id="origin" style="width:100px" value="<?=escapeinput($origin)?>" />
		  </div>
		  <div class="floatdiv"><img src="images/tfield_B.png" width="7" height="22" /></div>
		</div>
		<?
			}//end if chk
		?>		
	    </div>
		<div style="clear:both">
	    <div class="floatdiv" style="width:200px" >
		<div class="tfield_title" style="color:#FF9900">Search specifications </div>
		<br />
		  <div class="floatdiv"><img src="images/tfield_A.png" width="7" height="22" /></div>
		  <div class="tfield_div">
		    <input name="freesearch" type="text" class="tfield" id="freesearch" style="width:150px" value="<?=escapeinput($freesearch)?>" />
		  </div>
		  <div class="floatdiv"><img src="images/tfield_B.png" width="7" height="22" /></div>
		</div>
		<div class="floatdiv" style="width:210px">
		<div class="tfield_title">Order By </div><br />
		<select name="orderby" id="orderby" style="width:90px; margin-right:8px">
		<?php
			//to select price as default [if price is not (ON) order by name instade]
			if(!isset($orderby)){
				if(chk_storesetting("price"))
					$orderby="price";
				else
					$orderby="itemname";
			}
		?>
		<?php
			if(chk_storesetting("price")){
		?>
		  <option <?=$orderby=="price"? "selected='selected'":""?> value="price">Price</option>
		<?php
			}//end if
		?>
		  <option <?=$orderby=="itemname"? "selected='selected'":""?> value="itemname">Name</option>
		  <option <?=$orderby=="categoryid"? "selected='selected'":""?> value="categoryid">Category</option>
		<?php
			if(chk_storesetting("partnumber")){
		?>		  
		  <option <?=$orderby=="partnumber"? "selected='selected'":""?> value="partnumber">Part Number</option>
		<?php
			}//end if
			
			if(chk_storesetting("manufacturer")){
		?>		  
		  <option <?=$orderby=="manufacturer"? "selected='selected'":""?> value="manufacturer">Manufacturer</option>
		<?php
			}//end if
		?>		  
	    </select>
		<select name="order" id="order" style="width:90px">
		  <option value="ASC" <?=$order=="ASC"? "selected='selected'":""?>>Ascending</option>
		  <option value="DESC" <?=$order=="DESC"? "selected='selected'":""?>>Descending</option>
	    </select>
		</div>
		<div class="floatdiv" style="width:60px; padding-top:18px" >
          <input name="search" type="image" id="search" src="images/asearchbtn.png" />
        </div>
		</div>
		<div style="clear:both; height:15px"></div>
	  <input name="page" type="hidden" id="page" value="1" />
	  <input name="rowsPerPage" type="hidden" id="rowsPerPage" value="<?=$rowsPerPage?>" />
	  <input name="action" type="hidden" id="action" value="search" />
	  </div>
	  </form>
  <div style="clear:both"><img src="../images/blank.gif" width="1" height="1" /></div>  
</div>