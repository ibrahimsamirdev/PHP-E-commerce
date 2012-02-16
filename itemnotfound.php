<?php
	//indicate that this is the main page [needed in modules pages -- to stop calling lib in the module pages]
	$mainpage=true;
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
<title>Welcome to OUR online store - Product Not Found</title>
<link href="osstyles.css" rel="stylesheet" type="text/css" />
<link href="new osstyles.css" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript">
	//popup product large image window
	function viewlargeimage(imageid){
			pLeft=(screen.width/2)-270;
			PTop=(screen.height/2)-250;
			detailed=window.open("previewlargeimage.php?id="+imageid,"Previewimage",	"toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,width=<?=$imgMaxWidth?>,height=<?=$imgMaxHeight?>,left="+pLeft+",top="+PTop);
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
    <td width="231" height="618" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
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
	<div style="height:150px; padding-left:120px">
	  <p>&nbsp;</p>
	    <p><img src="images/box.gif" width="110" height="97" align="absmiddle" /><span class="price">PRODUCT NOT FOUND</span></p>
    </div>	<div align="center" class="link1">please click <a href="index.php">here</a> to go back</div></td>
  </tr>
</table>
<?php
	//include footer
	if(file_exists("footer.php"))
		require("footer.php");
?>
</body>
</html>