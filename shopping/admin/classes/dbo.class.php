<?php
	
	class dbo
	{
		private $host = "localhost";
		private $user = "root";
		private $password = "";
		private $db = "shoppingtest";
		
		private $link="";
		
		function dml($q)
		{
			if(!$this->link)
				$this->link = mysqli_connect($this->host, $this->user, $this->password, $this->db) or die(mysqli_connect_error());
				
			mysqli_query($this->link, $q) or die(mysqli_error($this->link).$q);
			
			return mysqli_insert_id($this->link);
		}
		
		function get($q)
		{	
			if(!$this->link)
				$this->link = mysqli_connect($this->host, $this->user, $this->password, $this->db) or die(mysqli_connect_error());
						
			$res = mysqli_query($this->link, $q) or die(mysqli_error($this->link));
			return $res;
		}
		
		function get_scalar($q)
		{
			$res = $this->get($q);
			$row = mysqli_fetch_array($res);
			return $row[0];
		}
		
		function found($q)
		{
			$res=$this->get($q);
			return ( mysqli_num_rows($res)==0 )? false : true;
		}
		
		function get_options($table, $pk_col, $display_col, $selected_val = -1)
		{
			$res = $this->get("select ".$pk_col.", ".$display_col." from ".$table);
			
			$st = "";
			
			while($row = mysqli_fetch_assoc($res))
			{
				if($row[$pk_col] == $selected_val)
					$st .= "<option value='".$row[$pk_col]."' selected='selected'>".$row[$display_col]."</option>";
				else
					$st .= "<option value='".$row[$pk_col]."'>".$row[$display_col]."</option>";
			}
			
			return $st;
		}
		
		function get_radios($group_name, $table, $pk_col, $display_col, $selected_val = -1, $design_prefix = "", $design_postfix = "")
		{
			$res = $this->get("select ".$pk_col.", ".$display_col." from ".$table);
			
			$st = "";
			
			while($row = mysqli_fetch_assoc($res))
			{
				if($row[$pk_col] == $selected_val)
					$st .= $design_prefix."<input name='".$group_name."' id='".$table."_".$row[$pk_col]."' type='radio' value='".$row[$pk_col]."' checked='checked'> ";
				else
					$st .= $design_prefix."<input name='".$group_name."' id='".$table."_".$row[$pk_col]."' type='radio' value='".$row[$pk_col]."'> ";
					
				$st .= "<label for='".$table."_".$row[$pk_col]."'>".$row[$display_col]."</label>".$design_postfix;
			}
			
			return $st;
		}
		
		function get_checkboxes($group_name, $table, $pk_col, $display_col, $selected_val = -1, $design_prefix = "", $design_postfix = "")
		{
			$res = $this->get("select ".$pk_col.", ".$display_col." from ".$table);
			
			$st = "";
			
			while($row = mysqli_fetch_assoc($res))
			{
			
				if(is_array($selected_val) && in_array($row[$pk_col],$selected_val))
				{
					$st .= $design_prefix."<input name='".$group_name."[]' id='".$table."_".$row[$pk_col]."' type='checkbox' value='".$row[$pk_col]."' checked='checked'> ";
				}
				else if( ! is_array($selected_val) && $row[$pk_col] == $selected_val)
				{
					$st .= $design_prefix."<input name='".$group_name."[]' id='".$table."_".$row[$pk_col]."' type='checkbox' value='".$row[$pk_col]."' checked='checked'> ";
				}
				else
					$st .= $design_prefix."<input name='".$group_name."[]' id='".$table."_".$row[$pk_col]."' type='checkbox' value='".$row[$pk_col]."'> ";
				
				$st .= "<label for='".$table."_".$row[$pk_col]."'>".$row[$display_col]."</label>".$design_postfix;
			}
			
			return $st;
		}
		
	}
	$db = new dbo();
?>