<?php session_start();require_once("classes/dbo.class.php");

	if( ! isset($_SESSION["adid"])) { header("location: login.php"); exit; }

	
		function categories_dropdown($parent_id = 0, $level = 0,$db)
	{	
		global $cat_s;
		$q = "select * from categories where cat_parent_id = '".$parent_id."'";
		$res = $db->get($q);
		
		while($row = mysqli_fetch_assoc($res))
		{
			
			$line = "";
			for($i=0; $i<$level; $i++) { $line .= "- - "; }
			$cat_s.= '<option value="'.$row["cat_id"].'">'.$line.$row["cat_nm"].'</option>';
			categories_dropdown($row["cat_id"],$level + 1,$db);
		}
		return $cat_s;
	}
	


	function categories_list($parent = 0, $level = 0)
	{
		global $db;
	
		$line = "";
		
		for($i=0; $i<$level; $i++) { $line .= "------"; }
	
		$res = $db->get("select * from categories where cat_parent_id = '".$parent."'");
		while($row = mysqli_fetch_assoc($res))
		{
		
			echo '
			<img src="images/cross.png"> '.$line.$row["cat_nm"].'
			<hr color="#b1b1b1" size="1" />
			';
		
			categories_list($row["cat_id"], $level + 1);
		}
	}
	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping Site - Admin Login</title>
<meta name="keywords" content="shoes store, contact, maps, addresses, contact form, free template, ecommerce, CSS, HTML" />
<meta name="description" content="Shoes Store, Contact Page, free template provided by templatemo.com" />
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
    	<?php
				require_once("header.inc.php");
		?>
	</div> <!-- END of templatemo_header -->
	
	<div id="templatemo_menubar">
    	<div id="top_nav" class="ddsmoothmenu">
            <?php
				require_once("inc/menu.php");
			?>
            <br style="clear: left" />
        </div> <!-- end of ddsmoothmenu -->
        
    </div> <!-- END of templatemo_menubar -->
    
    <div id="templatemo_main">
		<form action="process_upload.php" method="post" enctype="multipart/form-data">
							<table  width="100%" align="center">
								<tr>
									<td colspan="2" align="center">
										<font color="#000000" size="5">Upload Product</font>
									</td>
								</tr>
								<td colspan="2"><hr color="#a1a1a1" size="2" /></td></tr>

								<tr>
									<td width="98">Category:</td>
									<td>
									
									<select class="text" name="cat">
										<?php  echo categories_dropdown(0,0,$db); 	?>
									</select>
									</td>
									
								</tr>
								
								<td colspan="2"><hr color="#a1a1a1" size="2" /></td></tr>
								<tr>
									<td>Category Code:</td>
									<td>
										<input type="text" name="code" />
									</td>
								</tr>
								<td colspan="2"><hr color="#a1a1a1" size="2" /></td></tr>
								<tr>
									<td>Category Name:</td>
									<td>
										<input type="text" name="nm" />
									</td>
								</tr>
								<td colspan="2"><hr color="#a1a1a1" size="2" /></td></tr>
								<tr>
									<td>Category Rate:</td>
									<td>
										<input type="text" name="rate" />
									</td>
								</tr>
								<td colspan="2"><hr color="#a1a1a1" size="2" /></td></tr>
								<tr>
									<td>Category Desc:</td>
									<td>
										<textarea name="descr"></textarea>
									</td>
								</tr>
								<td colspan="2"><hr color="#a1a1a1" size="2" /></td></tr>
								<tr>
									<td>Fabrics:</td>
									<td>
										<select name="fb">
											<?php echo $db->get_options("fabrics","fb_id","fb_nm"); ?>
										</select>
									</td>
								</tr>
								<td colspan="2"><hr color="#a1a1a1" size="2" /></td></tr>
								<tr>
									<td>Look Type:</td>
									<td>									
										<?php echo $db->get_radios("ltype","look_types","lt_id","lt_nm","","",""); ?>
									</td>
								</tr>
								<td colspan="2"><hr color="#a1a1a1" size="2" /></td></tr>
								<tr>
									<td>Colors:</td>
									<td>
										<?php echo $db->get_checkboxes("colors","colors","cl_id","cl_nm","","",""); ?>
									</td>
								</tr>
								<td colspan="2"><hr color="#a1a1a1" size="2" /></td></tr>
								<tr>
									<td>Sizes: </td>
									<td>
										<?php echo $db->get_checkboxes("sizes","sizes","sz_id","sz_nm","","",""); ?>
									</td>
								</tr>
								<td colspan="2"><hr color="#a1a1a1" size="2" /></td></tr>
								<tr>
									<td>Occasions: </td>
									<td>
										<?php echo $db->get_checkboxes("occasions","occasions","oc_id","oc_nm","","",""); ?>
									</td>
								</tr>
								<td colspan="2"><hr color="#a1a1a1" size="2" /></td></tr>
								<tr>
									<td>Image Main:</td>
									<td><input type="file" name="main_image" /></td>
								</tr>
								<td colspan="2"><hr color="#a1a1a1" size="2" /></td></tr>
								<tr>
									<td>Other Image:</td>
									<td><a href="#" id="add_more">Add More</a><br />
										<div id="images_container">
											<input type="file" name="other_images[]" /><br />
											<input type="file" name="other_images[]" /><br />
											<input type="file" name="other_images[]" /><br />
										</div>
									</td>
								</tr>
								<td colspan="2"><hr color="#a1a1a1" size="2" /></td></tr>
								<tr>
									<td colspan="2" align="center">
										<input type="submit" value="Save" />
									</td>
									
								</tr>
								<td colspan="2"><hr color="#a1a1a1" size="2" /></td></tr>
							</table>
						</form>	
        
    <div class="cleaner"></div>
    </div> <!-- END of templatemo_main -->
     <div id="templatemo_footer">
		<?php
			require_once("inc/footer.php");
		?>
	</div> <!-- END of templatemo_footer -->
    
</div> <!-- END of templatemo_wrapper -->
</div> <!-- END of templatemo_body_wrapper -->


<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>