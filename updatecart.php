<?php
	//include lib.php (this file is a liberary for most common modules and function used by the system)
	if(file_exists("lib.php"))
		require("lib.php");
	
	//extract file name from $ref
	$ref=basename($ref);
	
	//add new items to cart
	if($action == "add"){
		//if there is no cookie defiened then create a new cookie
		if(!isset($_COOKIE['cart'][$iid])){
			//add the item into cart with a quantity of 1 and expiration time 90 days
			setcookie("cart[$iid]","1",time()+7776000);
			//return to the calling page
			header('Location: '.$ref);
			//echo "not set: ".cart_getitemqty($iid);
		}
		//else if this item already exists then increment its quantity
		else{
			$itemquantity=cart_getitemqty($iid)+1;
			setcookie("cart[$iid]","$itemquantity",time()+7776000);
			header('Location: '.$ref);
			//echo "set: ".cart_getitemqty($iid);
		}
	}//end if add
	else if($action == "update"){
		//$quantities is the cart form from viewcart.php
		foreach($quantities as $itemid => $quantity){
			//if (remove) this item or item quantity is 0 then remove the item from cart (delet its cookie)
			if($remove[$itemid] || !$quantity){
				setcookie("cart[$itemid]","0",time()-3600);
			}
			else
				setcookie("cart[$itemid]","$quantity",time()+7776000);
		}//end for each
		//return to the calling page (viewcart.php)
		header('Location: viewcart.php');
	}//end if update
?>