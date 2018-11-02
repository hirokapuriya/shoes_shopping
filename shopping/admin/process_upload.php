<?php session_start();
			require_once("classes/fileupload.class.php");
			require_once("classes/dbo.class.php");
	
	if(empty($_POST)){ header("location: upload.php"); exit; }
	$_FILES["other_images"] = diverse_array($_FILES["other_images"]);
	
	$msg = array();
	
	if(empty($_POST["cat"]))
		$msg[] = "Category was empty";
	if(empty($_POST["code"]))
		$msg[] = "Code was empty";
	if(empty($_POST["nm"]))
		$msg[] = "Name was empty";
	if(empty($_POST["descr"]))
		$msg[] = "Description was empty";
	if( ! isset($_POST["ltype"]))
		$msg[] = "Look type was empty";
		
	$f_main = new fileupload($_FILES["main_image"], "Main Image", "jpg,jpeg,gif,png", 10);
	if( ! $f_main->validate()) {
		$msg = array_merge($msg, $f_main->errors());
	}
	
	foreach($_FILES["other_images"] as $file) {
		$f = new fileupload($file, "Other Image", "jpg,jpeg,gif,png", 10, true);
		if( ! $f->validate()) {
			$msg = array_merge($msg, $f->errors());
		}
	}
		
	if( ! empty($msg)) {
		print_r(array_unique($msg));
		exit;
	}  
		
	//-- Data Insert -----------------------------------------------------
	
	//Upload File
	$main_img = $f_main->upload();
	$other_img = array();
	
	foreach($_FILES["other_images"] as $file) {
		$f = new fileupload($file, "Other Image", "jpg,jpeg,gif,png", 10, true);
		$other_img[] = $f->upload();
	}
	$other_img = array_filter($other_img);
	

	//Product Insert
	$pq = "insert into products(p_cat_id,p_fb_id,p_lt_id,p_code,p_name,p_desc,p_rate,p_main_img)
		values('".$_POST["cat"]."','".$_POST["fb"]."','".$_POST["ltype"]."','".$_POST["code"]."',
		'".$_POST["nm"]."','".$_POST["descr"]."','".$_POST["rate"]."','".$main_img."')
	";
	$pid = $db->dml($pq);
	
	//Product Sizes
	if( isset($_POST["sizes"])) {
		$pc_q = "insert into product_sizes (ps_p_id, ps_sz_id) values ";
		foreach($_POST["sizes"] as $s) {
			$pc_q .= "('".$pid."','".$s."'),";
		}
		$pc_q = rtrim($pc_q, ",");
		$db->dml($pc_q);
	}
	
	//Product Occasions
	if( isset($_POST["occasions"])) {
		$oc_q = "insert into product_occasions (po_p_id, po_oc_id) values ";
		foreach($_POST["occasions"] as $o) {
			$oc_q .= "('".$pid."','".$o."'),";
		}
		$oc_q = rtrim($oc_q, ",");
		$db->dml($oc_q);
	}
	
	//Product Colors
	if( isset($_POST["colors"])) {
		$cl_q = "insert into product_colors (pc_p_id, pc_cl_id) values ";
		foreach($_POST["colors"] as $c) {
			$cl_q .= "('".$pid."','".$c."'),";
		}
		$cl_q = rtrim($cl_q, ",");
		$db->dml($cl_q);
	}
	
	//Product Images
	if( ! empty($other_img)) {
		$oi_q = "insert into product_images (pi_p_id, pi_img) values ";
		foreach($other_img as $oi) {
			$oi_q .= "('".$pid."','".$oi."'),";
		}
		$oi_q = rtrim($oi_q, ",");
		$db->dml($oi_q);
	}
	
	//-- HELPER FUNCTIONS ------------------------------------------------
	
	function diverse_array($vector) {
	
		$result = array();
		
		foreach($vector as $key1 => $value1)
			foreach($value1 as $key2 => $value2)
				$result[$key2][$key1] = $value2;
				
		return $result;
	} 
	header("location: upload.php");
	
?>