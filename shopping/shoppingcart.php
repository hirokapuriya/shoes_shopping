<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php session_start(); require_once("classes/dbo.class.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shoes Store - Shopping Cart</title>
<meta name="keywords" content="shoes store, shopping cart, free template, ecommerce, online shop, website templates, CSS, HTML" />
<meta name="description" content="Shoes Store, Shopping Cart, online store template by templatemo.com" />
<link href="templatemo_style.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="css/ddsmoothmenu.css" />

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/ddsmoothmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "top_nav", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script>

</head>

<body>

<div id="templatemo_body_wrapper">
<div id="templatemo_wrapper">

	<div id="templatemo_header">
    	<div id="site_title"><h1><a href="http://www.templatemo.com" rel="nofollow">Online Shoes Store</a></h1></div>
        <div id="header_right">
        	<p>
	        <a href="#">My Account</a> | <a href="#">My Wishlist</a> | <a href="#">My Cart</a> | <a href="#">Checkout</a> | <a href="#">Log In</a></p>
            <p>
            	Shopping Cart: <strong>3 items</strong> ( <a href="shoppingcart.html">Show Cart</a> )
			</p>
		</div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_header -->
    
    <div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <?php require_once("inc/menu.inc.php")?>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        <div id="templatemo_search">
            <form action="#" method="get">
              <input type="text" value=" " name="keyword" id="keyword" title="keyword" onfocus="clearText(this)" onblur="clearText(this)" class="txt_field" />
              <input type="submit" name="Search" value=" " alt="Search" id="searchbutton" title="Search" class="sub_btn"  />
            </form>
        </div>
    </div> <!-- END of templatemo_menubar -->
    
    <div id="templatemo_main">
    	<div id="sidebar" class="float_l">
        	<div class="sidebar_box"><span class="bottom"></span>
            	<h3><a href="http://www.onlyimage.com" title="OnlyImage"  class="sidebar_box_icon" ><img src="images/templatemo_sidebar_header.png" title="OnlyImage" alt="OnlyImage" /></a>Categories</h3>   
                <div class="content"> 
                	<ul class="sidebar_list">
                    	<li class="first"><a href="#">Sed eget purus</a></li>
                        <li><a href="#">Vestibulum eleifend</a></li>
                        <li><a href="#">Nulla odio ipsum</a></li>
                        <li><a href="#">Suspendisse posuere</a></li>
                        <li><a href="#">Nunc a dui sed</a></li>
                        <li><a href="#">Curabitur ac mauris</a></li>
                        <li><a href="#">Mauris nulla tortor</a></li>
                        <li><a href="#">Nullam ultrices</a></li>
                        <li><a href="#">Nulla odio ipsum</a></li>
                        <li><a href="#">Suspendisse posuere</a></li>
                        <li><a href="#">Nunc a dui sed</a></li>
                        <li><a href="#">Curabitur ac mauris</a></li>
                        <li><a href="#">Mauris nulla tortor</a></li>
                        <li><a href="#">Nullam ultrices</a></li>
                        <li class="last"><a href="#">Sed eget purus</a></li>
                    </ul>
                </div>
            </div>
            
        </div>
        <div id="content" class="float_r">
        	<h1>Shopping Cart</h1>
			<form action="process_cart.php" method="post" style="border: 2px solid brown;" >
				<table width="100%" cellspacing="0" cellpadding="3">
                   	  <tr bgcolor="#ddd">
                        	<td align="center">SrNo </td> 
                       	  	<td align="center">Name </td> 
                        	<td align="center">Rate </td> 
                        	<td align="center">Qty </td> 
                        	<td align="center">Total </td> 
                        	<td align="center">Action </td> 
                        	
                            
                      </tr>
					    <?php
							$i = 1;
							$tot = 0;
							
							foreach($_SESSION["cart"] as $c)
							{
							echo '
							<tr align="center">
						         	<td>'.$i++.'</td>
									<td>'.$c["pnm"].'</td>
									<td>'.$c["rate"].'</td>
									<td><input type="text" name="'.$c["pid"].'" value="'.$c["qty"].'" size="2" /></td>
									<td>'.($c["rate"] * $c["qty"]).'</td>
									<td> <a href="process_cart.php?del='.$c["pid"].'"><img src="images/remove_x.gif" alt="remove" /><br />Remove</a></td>
							</tr>
							';
							$tot += ($c["rate"] * $c["qty"]);
							}
						?>
                        <tr><td colspan="7"><hr color="#a1a1a1" size="2" /></td></tr>
                        <tr>
                        	<td><input type="submit" value="Refresh" /></td>
                        	<td colspan="2" align="right"  height="30px">Have you modified your basket? </a>&nbsp;&nbsp;</td>
                            <td colspan="1" align="right" style="background:#ddd; font-weight:bold"> Total </td>
                            <td colspan="" align="left" style="background:#ddd; font-weight:bold"><?php echo $tot; ?></td>
                            <td style="background:#ddd; font-weight:bold"> </td>
						</tr>
						<tr><td colspan="7"><hr color="#a1a1a1" size="2" /></td></tr>
				</table>
                    <div style="float:right; width: 215px; margin-top: 20px;">
                    	<p style="margin: 0 0 10px -34px;"><a href="index.php">Continue shopping</a> ||<a href="checkout.php">Proceed to checkout</a></p>
                    </div>
					<div class="cleaner"></div>
					
			</form>
           
			</div>
        <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
    
    <div id="templatemo_footer">
    	<p><a href="#">Home</a> | <a href="#">Products</a> | <a href="#">About</a> | <a href="#">FAQs</a> | <a href="#">Checkout</a> | <a href="#">Contact Us</a>
		</p>

		Copyright © 2072 <a href="#">Your Company Name</a> | <a rel="nofollow" href="http://www.templatemo.com/preview/templatemo_367_shoes">Shoes Theme</a> by <a href="http://www.templatemo.com" rel="nofollow" target="_parent" title="free css templates">templatemo</a>
    	
    </div> <!-- END of templatemo_footer -->
    
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->


<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>