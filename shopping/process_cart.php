<?php session_start();

	if( isset($_GET["pid"]) && isset($_GET["pnm"]) && isset($_GET["cat"]) && isset($_GET["rate"]) && isset($_GET["qty"]))
	{
		if(ctype_digit($_GET["pid"]) && is_numeric($_GET["rate"]) && is_numeric($_GET["qty"]))
		{
			$_SESSION["cart"][$_GET["pid"]] = array("pid"=>$_GET["pid"],"pnm"=>$_GET["pnm"],"cat"=>$_GET["cat"],"rate"=>$_GET["rate"],"qty"=>$_GET["qty"]);
		}
	}
	else if($_GET["del"])
	{
		unset($_SESSION["cart"][$_GET["del"]]);
	}
	else if( ! empty($_POST)) {
		foreach($_POST as $id=>$new_qty)
		{
			$_SESSION["cart"][$id]["qty"] = $new_qty;
		}
	}
	
	header("location: shoppingcart.php");
?>