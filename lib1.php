<?php
	//for test
	$clientid=1;
	//get list of client's store settings [price, orign, ... etc] [return array of all specs]
	$GLOBALS[storesettings]=get_storesettings();//array of all settings
	
	//items partnumber of items to be displaied on the main page
	//$items=array("5124-6521","1256-2653","2326-2315","2658-6325");
	//categories id of categories to displaied on the main page
	//$categories=array(17,26,27,14);
	//item large image(item preview image) maximum width and height
	$imgMaxWidth=500;
	$imgMaxHeight=350;
	
	//this function to allow php variables to access the query string variables
	import_request_variables("gP", "");	
	
	/************************************************ consume webservice ***************************************************/
	//consume a given webservice
	//consumeWebservice("getImages",array(clientid=>"12",'class'=>"4"))
	function consumeWebservice($webservice,$parameters="NUL"){
		//generate websrvice query string (URL)
		$urlquery="http://onlinestore.softexsw.net/webservice/webservice.php?me=".$webservice;
		if(is_array($parameters)){
			foreach($parameters as $param => $value){
				$urlquery.="&$param=$value";
			}
		}
		
		//$string= file_get_contents($urlquery);
		//$xml = simplexml_load_string($string);

		$xml = simplexml_load_file($urlquery);
		return $xml;
	}
/********************************************* consume webservice2 FOR CART *************************************************/
	//consume a given webservice using given $parametars string
	//consumeWebservice("getImages","&clientid=1")
	function consumeWebservice2($webservice,$parameters=0){
		//generate websrvice query string (URL)
		$urlquery="http://onlinestore.softexsw.net/webservice/webservice.php?me=".$webservice;
		if($parameters)
			$urlquery.=$parameters;

		$xml = simplexml_load_file($urlquery);
		return $xml;
	}
	/************************************************* get_storesettings *****************************************************/
	//get list of client's store settings [price, orign, ... etc] [return array of all specs]
	function get_storesettings(){
		//if there is no cookie defiened then create a new cookie
		/*if(!isset($_COOKIE[storecode])){
			//get store fields settings
			$storecode=consumeWebservice("getStoreFields",array(clientid=>$clientid));
			$storecode=(string)$storecode->node->attributes()->storefields;
			
			//Store the Store code in a cookie for 5 Minutes
			setcookie("cart[storecode]",$storecode,time()+300);
		}
		else{
			//get store fields settings
			$storecode=consumeWebservice("getStoreFields",array(clientid=>$clientid));
			$storecode=(string)$storecode->node->attributes()->storefields;
		}*/
		
		//get store fields settings
		$storecode=consumeWebservice("getStoreFields",array(clientid=>$GLOBALS[clientid]));
		$storecode=(string)$storecode->node->attributes()->storefields;
		
		//generate specs(storefields)array with value of store specifications
		$specs= array();
		
		if($storecode[0])
			$specs[0]="Item Code";

		if($storecode[1])
			$specs[1]="Part Number";

		if($storecode[2])
			$specs[2]="Price";

		if($storecode[3])
			$specs[3]="Discount";

		if($storecode[4])
			$specs[4]="Stock";

		if($storecode[5])
			$specs[5]="Manufacturer";

		if($storecode[6])
			$specs[6]="Origin";
			
		if($storecode[7])
			$specs[7]="Availability";

		if($storecode[8])
			$specs[8]="Description";			
			
		//return array of settings(specifications)
		return $specs;
		
	}// end get_storesettings()
	
	/**************************************************** varformat *********************************************************/	
	//apply format to a variable (element of array) [converts string to lowercase and removes whitespace]
	//{used in chk_storesetting}
	function varformat($var){
		return strtolower(str_replace(" ","",$var));
	}//end of varformat
	
	/************************************************* chk_storesetting ******************************************************/
	//check client's store settings whether "on" or "off" [price, orign, ... etc]
	function chk_storesetting($setting){
		$clientid=$GLOBALS[clientid];
		//get list of client's store settings [price, orign, ... etc] [return array of all specs]
		$specs=$GLOBALS[storesettings];
		//apply format to each element of the array [converts string to lowercase and removes whitespace]
		$specs=array_map("varformat",$specs);
			
		//check if the setting is on or not
		if(in_array($setting, $specs))
			return true;
		else
			return false;
	}// end chk_storesetting()
	
	/*************************************************** escape input ******************************************************/
	//escape $string (input field) with htmlspecialchars and stripslashes to display (" ' \)
	function escapeinput($string){
		return htmlspecialchars(stripslashes($string));
	}//end escapeinput()	
	
	/**********************************************  [[[[ cart functions  ]]]]  *********************************************/
	/**************************************************** cart_getitemqty ***************************************************/
	//get item quantity
	function cart_getitemqty($item){
		if($_COOKIE['cart'][$item])
			return $_COOKIE['cart'][$item];
		else
			return 0;
	}// end cart_getitemqty()
?>