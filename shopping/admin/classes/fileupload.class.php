<?php

	class fileupload
	{
		private $upload_dir = "uploads/";
		
		//-- DO NOT EDIT BELOW THIS LINE ---------------------------------
		
		private $file;
		private $id;
		private $allowd_ext;
		private $file_ext = "";
		private $size_limit;
		private $is_optional;
		
		private $errors;
		
		function __construct($file, $id, $allowed_ext, $size_limit = 10, $is_optional = false)
		{
			//Get all variables			
			$this->file = $file;			
			$this->id = $id;
			$this->allowed_ext = $allowed_ext;
			$this->size_limit = $size_limit;
			$this->is_optional = $is_optional;
			
			//Get extension of this file
			if( ! empty($this->file["name"])) {
				
				$pathinfo = pathinfo($this->file["name"]);
				$this->file_ext = strtolower($pathinfo["extension"]);
				
			}
			
			//Make sure we have trailing "/" in upload directory
			$this->upload_dir = rtrim($this->upload_dir,"/")."/";
		}
		
		function validate()
		{
			if( ! empty($this->file["name"]) ) { 
		
				if( empty($this->file["name"]) )
					$this->errors[] = $this->id." was empty.";
				
				if( $this->file["error"] != 0 )
					$this->errors[] = "Error uploading ".$this->id.". Try again later.";
					
				if( ( $this->file["size"] / ( 1024 * 1024 ) ) > $this->size_limit )
					$this->errors[] = $this->id." cannot exceed ".$this->size_limit." MB.";
					
				$allowed_extensions = explode(",",$this->allowed_ext);
				if( ! in_array($this->file_ext , $allowed_extensions) )			
					$this->errors[] = "Wrong file for ".$this->id.". Give: ".$this->allowed_ext;
					
				return empty($this->errors);
			}
			else if( ! $this->is_optional) {
			
				$this->errors[] = $this->id." was empty.";
				return empty($this->errors);
				
			}
			
			return true;
		}
		
		function upload()
		{
			if( ! $this->validate()) { die("Cannot Upload File. Reason: Not validated properly."); }
			if( empty($this->file["name"])) { return ""; }
			
			$fnm = time().rand(1111,9999).".".$this->file_ext;
			move_uploaded_file($this->file["tmp_name"],$this->upload_dir.$fnm);
			
			return $fnm;
		}
		
		function errors()
		{
			return $this->errors;
		}
	}

?>