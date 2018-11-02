<?php session_start(); 
require_once("classes/dbo.class.php");

	if( ! isset($_GET["pid"]) || ! ctype_digit($_GET["pid"])) { header("location: index.php"); exit; }
	
	
	$id = $_GET['pid'];
	
	$res = $db->get("select * from products, fabrics, look_types, categories
					where p_cat_id = cat_id
					and p_fb_id = fb_id
					and p_lt_id = lt_id
					and p_id = '".$id."'");
	
	if( mysqli_num_rows($res) == 0) { header("location: index.php"); exit; }
	
	$det_row = mysqli_fetch_assoc($res);
	
	$colors = "";
	$colors_res = $db->get("select * from colors where cl_id in ( select pc_cl_id from product_colors where pc_p_id = '".$_GET["pid"]."' )");
	while($colors_row = mysqli_fetch_assoc($colors_res)){
		$colors .= $colors_row["cl_nm"].", ";
	}
	$colors = rtrim($colors, ", ");
	
	$sizes = "";
	$sizes_res = $db->get("select * from sizes where sz_id in ( select ps_sz_id from product_sizes where ps_p_id = '".$_GET["pid"]."' )");
	while($sizes_row = mysqli_fetch_assoc($sizes_res)){
		$sizes .= $sizes_row["sz_nm"].", ";
	}
	$sizes = rtrim($sizes, ", ");
	
	$occasions = "";
	$occasions_res = $db->get("select * from occasions where oc_id in ( select po_oc_id from product_occasions where po_p_id = '".$_GET["pid"]."' )");
	while($occasions_row = mysqli_fetch_assoc($occasions_res)){
		$occasions .= $occasions_row["oc_nm"].", ";
	}
	$occasions = rtrim($occasions, ", ");
	
	$images_res = $db->get("select * from product_images where pi_p_id = '".$id."'");	
	

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shoes Store - Product Detail</title>
<meta name="keywords" content="shoes store, product detail, free template, ecommerce, online shop, website templates, CSS, HTML" />
<meta name="description" content="Shoes Store, Product Detail, free ecommerce template provided by templatemo.com" />
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

<script type="text/javascript" src="js/jquery-1-4-2.min.js"></script> 
<link rel="stylesheet" href="css/slimbox2.css" type="text/css" media="screen" /> 
<script type="text/JavaScript" src="js/slimbox2.js"></script> 


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
            	<h3>Categories</h3>   
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
            <div class="sidebar_box"><span class="bottom"></span>
            	<h3><a class="sidebar_box_icon" href="http://www.onlyimage.com/free-images/wallpaper" title="Wallpaper"  target="_blank"><img src="images/templatemo_sidebar_header.png" alt="Wallpaper from www.onlyimage.com" title="Wallpaper from www.onlyimage.com" /></a>Bestsellers </h3>   
                <div class="content"> 
                	<div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
                        <h4><a href="#">Donec nunc nisl</a></h4>
                        <p class="price">$10</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
                        <h4><a href="#">Lorem ipsum dolor sit</a></h4>
                        <p class="price">$12</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
                        <h4><a href="#">Phasellus ut dui</a></h4>
                        <p class="price">$20</p>
                        <div class="cleaner"></div>
                    </div>
                    <div class="bs_box">
                    	<a href="#"><img src="images/templatemo_image_01.jpg" alt="image" /></a>
                        <h4><a href="#">Vestibulum ante</a></h4>
                        <p class="price">$8</p>
                        <div class="cleaner"></div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" class="float_r">
        	<h1>Product Detail</h1>
            <div class="content_half float_l">
			
        	<a  rel="lightbox[portfolio]" href="#"><img src="admin/uploads/<?php echo $det_row['p_main_img'] ?>" alt="image" /></a>
			<?php
									while($images_row = mysqli_fetch_assoc($images_res))
									{
										echo '<img src="admin/uploads/'.$images_row["pi_img"].'" height="100" width="106" />';
									}
								?>
			
			<!--<a  rel="lightbox[portfolio]" href=""><img src="<?php //echo $pimg ?>" alt="image" height="290px" width="290px"/></a>-->
            </div>
            <div class="content_half float_r">
               <table>
                    <tr>
						</td>
                        Name: <b><?php echo $det_row["p_name"] ?></b>
						<hr color="#c1c1c1" size="1" />
						</td>
					</tr>
					<tr>
						</td>
                        Category: <b><?php echo $det_row["cat_nm"] ?></b>
								<hr color="#c1c1c1" size="1" />
						</td>
					</tr>
                    <tr>
						</td>
                        Code: <b><?php echo $det_row["p_code"] ?></b>
								<hr color="#c1c1c1" size="1" />
						</td>
					</tr>
                    <tr>
						<td>
                        Rate: <b><?php echo $det_row["p_rate"] ?></b>
							 <hr color="#c1c1c1" size="1" />
						</td>
					</tr>
                    <tr>
						<td>
                        Fabrics: <b><?php echo $det_row["fb_nm"] ?></b>
								<hr color="#c1c1c1" size="1" />
						</td>
					</tr>
					<tr>
                        <td>
						Look types: <b><?php echo $det_row["lt_nm"] ?></b>
								<hr color="#c1c1c1" size="1" />
						</td>
                    </tr>
					<tr>
                        <td>
						Colors: <b><?php echo $colors; ?></b>
								<hr color="#c1c1c1" size="1" />
						</td>
                    </tr>
					<tr>
                        <td>
						Occasions: <b><?php echo $occasions ?></b>
								<hr color="#c1c1c1" size="1" />
						</td>
                    </tr>
					<tr>
                        <td>
							Sizes: <b><?php echo $sizes ?></b>
								<hr color="#c1c1c1" size="1" />
						</td>
                    </tr>
                    
                </table>
                

              

			</div>
            <div class="cleaner h30"></div>
            
            <h5>Product Description</h5>
            <p><?php echo $det_row["p_desc"] ?></p>	
            <form action="process_cart.php" method="get">
						<input type="hidden" value="<?php echo $det_row["p_id"]; ?>" name="pid" />
						<input type="hidden" value="<?php echo $det_row["p_name"]; ?>" name="pnm" />
						<input type="hidden" value="<?php echo $det_row["cat_nm"]; ?>" name="cat" />
						<input type="hidden" value="<?php echo $det_row["p_rate"]; ?>" name="rate" />
						<input type="text" value="1" name="qty" size="2" />
						<input type="submit" value="Add to Cart &rarr;" />
			</form>
          <div class="cleaner h50"></div>
            
              
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