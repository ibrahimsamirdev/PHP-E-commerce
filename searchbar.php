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
<?php
	}//end if
?>
<form id="search" name="search" method="post" action="search.php">
  <input name="page" type="hidden" id="page" value="1" />
  <input name="rowsPerPage" type="hidden" id="rowsPerPage" value="<?=$rowsPerPage?>" />
  <div style="padding-left:10px">
<table width="825" border="0" align="center" cellpadding="0" cellspacing="0" style="background-image:url(images/theme6_3x10.png); background-repeat:repeat-x" >
  <!--DWLayoutTable-->
  <tr>
    <td width="50" height="52" valign="top"><img src="images/theme6_3x2.png" width="11" height="52" /></td>
    <td width="68" valign="top"><img src="images/theme6_3x4.png" width="56" height="52" /></td>
    <td width="243" valign="top" style="padding-top:16px">
      <input name="itemname" type="text" id="itemname" style="width:230px; color:#666666; height:15px" value="<?=escapeinput($itemname)?>" />    </td>
    <td width="174" valign="top" style="padding-top:17px">
	<?php
		//get all the categories to fill the category combobox
		$categories=consumeWebservice("getCategoriesList",array(clientid=>$clientid));
	?>
	<select name="category" class="footer" id="category" style="width:160px; height:20px">
	  <option value="all" selected="selected">-All Categories-</option>
	  <?php
	  	foreach($categories->node as $node){
	?>
	  <option value="<?=$node->attributes()->catid?>" <?=(int)$node->attributes()->catid==$category?"selected='selected'":""?>><?=$node->attributes()->catname?></option>
	  <?php
		}
	?>
	  </select>    </td>
    <td width="56" valign="top" style="padding-top:19px"><input type="image" name="imageField" src="images/theme6_4x1.png" />    </td>
    <td width="225" valign="top" class="link1" style="padding-top:19px"><a href="asearch.php"><img src="images/theme6_4x3.png" width="87" height="20" border="0" /></a> </td>
  <td width="9" valign="top"><img src="images/theme6_3x11.png" width="9" height="52" /></td>
  </tr>
  <tr>
    <td height="11" colspan="7" align="center" valign="top"><img src="images/theme5_8x2.png" width="484" height="11" /></td>
    </tr>
</table>
  </div>
</form>
