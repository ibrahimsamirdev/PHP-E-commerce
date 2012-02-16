<?php
	//indicate that this is the main page [needed in modules pages -- to stop calling lib in the module pages]
	$mainpage=true;
	//indicate that this is advance search page [needed in itemsperpage combobox -> so that not to submit search form but asearch]
	$asearch=true;
	
	//include lib.php (this file is a liberary for most common modules and function used by the system)
	if(file_exists("lib.php"))
		require("lib.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="softex, software, house, egypt, cairo, online, store, e-commerce, commerce" />
<meta name="description" content="Add, organize, show, and sell your products online" />
<meta name="author" content="Ibrahim Samir, himalking@yahoo.com" />
<meta name="copyright" content="softex software house" />
<title>Welcome to OUR online store - Advanced Search</title>
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
    <td width="231" height="203" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <!--DWLayoutTable-->
      <tr>
        <td width="231" height="154" valign="top">
          <?php
			//include categories list
			if(file_exists("catlist.php"))
				require("catlist.php");
		?>		</td>
        </tr>
      <tr>
        <td height="49">&nbsp;</td>
      </tr>
      
      
       
    </table></td>
    <td width="605" valign="top">
	<div style="height:7px"><img src="images/blank.gif" width="1" height="1" /></div>
	<?php
		//include advanced search bar
			if(file_exists("asearchbar.php"))
				require("asearchbar.php");
			//include search result generator
			if($action){
				if(file_exists("searchresult.php"))
					require("searchresult.php");
			}
	?>
	<div style="clear:both; height:25px"></div></td>
  </tr>
</table>
<?php
	//include footer
	if(file_exists("footer.php"))
		require("footer.php");
?>
</body>
</html>