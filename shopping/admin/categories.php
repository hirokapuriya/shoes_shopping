<?php session_start(); 

	require_once("classes/dbo.class.php");
	 
	 if(! isset($_SESSION["adid"])) { header("location:login.php"); exit;}

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
	
	
	function print_cat_table($parent_id = 0, $level = 0,$db)
	{
		
		$q = "select * from categories where cat_parent_id = '".$parent_id."'";
		$res = $db->get($q);
		while($row = mysqli_fetch_assoc($res))
		{
			$line = "";
			for($i=0; $i<$level; $i++) { $line .= "-------"; }
			
			echo '
				<tr>
					<td>
						'.$line.$row["cat_name"].'
					</td>
					<td width="20">
						<a href="process_del_cat.php?id='.$row["cat_id"].'&type=cat"><img src="images/cross.png"></a>
					</td>
				</tr>
				<tr><td colspan="2"><hr color="#b1b1b1" size="1" /></td></tr>
								
			';
			
			print_cat_table($row["cat_id"],$level + 1,$db);
		}
		
	}	
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shoes Store - Contact Page</title>
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
    </div>   
    <div id="templatemo_main">
        <div id="content" class="float_r"><br/><br/>
        	<h1>Add Category</h1>
            <div class="content_half float_l">
                
                <div id="contact_form">
                   <form action="process_add_category.php" method="post">
                        
                        <label for="author">Category Name:</label> 
						<input class="required input_field" type="text" name="catnm" />
                        <div class="cleaner h10"></div>
                        <label for="email">Parent:</label>
                        <select class="text" name="parent">
										<option value="0_|0|">No Parent</option>
										<?php  echo categories_dropdown(0,0,$db); 	?>
									</select>
						
						<div class="cleaner h10"></div>
                        
                       <input class="submit" type="submit" value="Save" />
                        
                    </form>
                </div>
            </div>
        
        <div class="cleaner h40"></div>
        
        
            
        </div> 
        <div class="cleaner"></div>
    </div><!--- END of templatemo_main -->
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