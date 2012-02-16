<?php
	//this checks if this page is the main page or not
	//so whether to include the "osstyles.css" or not [i.e. not including it in each call of page parts]
	if(!$mainpage){
?>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<link href="osstyles.css" rel="stylesheet" type="text/css">
	<link href="new osstyles.css" rel="stylesheet" type="text/css" />
<?php
	}//end if
?>
<div style="background-image:url(images/tilebottom.png); background-repeat:repeat-x; background-position:bottom">
<table width="764" border="0" align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="764" height="101" align="center" valign="middle"><div class="link3" ><a href="index.php">Home</a> &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;<a href="about.html">About Us</a> &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;<a href="asearch.php">Advance Search</a> &nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;<a href="contact.php">Contact Us</a></div>
      <hr width="280" color="#c0c0c0" />
      <span class="copyright">Copyright &copy; 2008 <a href="#">Company Name</a>, All rights reserved</span><br />
      <div class="footer"><a href="http://www.softexsw.com" target="_blank">Powered by SOFTEXSW </a></div></td>
    </tr>
</table>
</div>