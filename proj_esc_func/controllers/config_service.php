<?php

class ConfigService{

	private $conn;
	private $config;

	public function __construct(Connection $conn, Config $config){
		$this->conn = $conn->connect();
		$this->config = $config;
	}

	public function insert(){

	}

	public function delete(){

	}

	public function update(){

		$q_img_school = "";
		$q_img_featured_1 = "";
		$q_img_featured_2 = "";
		$q_img_featured_3 = "";
		$img_school = "";
		$phone_school_1 = "";
		$phone_school_2 = "";
		$phone_school_3 = "";
		//$img_local = "";
		$img_featured_1 = "";
		$img_featured_2 = "";
		$img_featured_3 = "";

		if($this->config->__get('img_school') != ""){
			$img_school = $this->config->__get('img_school');
			$q_img_school = " img_school = :img_school, ";
		}

		if($this->config->__get('img_featured_1') != ""){
			$img_featured_1 = $this->config->__get('img_featured_1');
			$q_img_featured_1 = " img_featured_1 = :img_featured_1, ";
		}

		if($this->config->__get('img_featured_2') != ""){
			$img_featured_2 = $this->config->__get('img_featured_2');
			$q_img_featured_2 = " img_featured_2 = :img_featured_2, ";
		}

		if($this->config->__get('img_featured_3') != ""){
			$img_featured_3 = $this->config->__get('img_featured_3');
			$q_img_featured_3 = " img_featured_3 = :img_featured_3, ";
		}

			$query = "update config set title_site = :title_site, " . $q_img_school . $q_img_featured_1 .  $q_img_featured_2 . $q_img_featured_3  . " txt_img_1 = :txt_img_featured_1, txt_img_2 = :txt_img_featured_2, txt_img_3 = :txt_img_featured_3, desc_school = :desc_school, phone_school_1 = :phone_school_1, phone_school_2 = :phone_school_2, phone_school_3 = :phone_school_3, style = :style";
			
			$title_site = $this->config->__get('title_site');
			
			$txt_img_featured_1 = $this->config->__get('txt_img_featured_1');
			$txt_img_featured_2 = $this->config->__get('txt_img_featured_2');
			$txt_img_featured_3 = $this->config->__get('txt_img_featured_3');
			//$img_local = $this->config->__get('img_local');
			$phone_school_1 = $this->config->__get('phone_school_1');
			$phone_school_2 = $this->config->__get('phone_school_2');
			$phone_school_3 = $this->config->__get('phone_school_3');
			$desc_school    = $this->config->__get('desc_school');
			$style          = $this->config->__get('style');

	    	$stmt = $this->conn->prepare($query);

	    	$stmt->bindParam(':title_site', $title_site, PDO::PARAM_STR);

	    	if($img_school != ""){
		    	$stmt->bindParam(':img_school', $img_school, PDO::PARAM_STR); 
	    	} 
	    	if($img_featured_1 != ""){
		    	$stmt->bindParam(':img_featured_1', $img_featured_1, PDO::PARAM_STR); 
	    	} 
	    	if($img_featured_2 != ""){
		    	$stmt->bindParam(':img_featured_2', $img_featured_2, PDO::PARAM_STR); 
	    	} 
	    	if($img_featured_3 != ""){
		    	$stmt->bindParam(':img_featured_3', $img_featured_3, PDO::PARAM_STR); 
	    	}            
	    	$stmt->bindParam(':txt_img_featured_1', $txt_img_featured_1, PDO::PARAM_STR);       
	    	$stmt->bindParam(':txt_img_featured_2', $txt_img_featured_2, PDO::PARAM_STR);       
	    	$stmt->bindParam(':txt_img_featured_3', $txt_img_featured_3, PDO::PARAM_STR);       
	    	$stmt->bindParam(':desc_school', $desc_school, PDO::PARAM_STR);       
	    	//$stmt->bindParam(':img_local', $img_local, PDO::PARAM_STR);       
	    	$stmt->bindParam(':phone_school_1', $phone_school_1, PDO::PARAM_STR);    
	    	$stmt->bindParam(':phone_school_2', $phone_school_2, PDO::PARAM_STR);    
	    	$stmt->bindParam(':phone_school_3', $phone_school_3, PDO::PARAM_STR);    
	    	$stmt->bindValue(':style', $style);    

			return $stmt->execute();	
	}

	public function select(){

	}
}

?>