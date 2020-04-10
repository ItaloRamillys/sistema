<?php

class ConfigService{

	private $conexao;
	private $config;

	public function __construct(Conexao $conexao, Configuracao $config){
		$this->conexao = $conexao->conectar();
		$this->config = $config;
	}

	public function insert(){

	}

	public function delete(){

	}

	public function update(){

		$q_img_esc = "";
		$q_img1 = "";
		$q_img2 = "";
		$q_img3 = "";
		$img_esc = "";
		$img1 = "";
		$img2 = "";
		$img3 = "";

		if($this->config->__get('img_esc') != ""){
			$img_esc = $this->config->__get('img_esc');
			$q_img_esc = "img_escola = :img_esc, ";
		}

		if($this->config->__get('img1') != ""){
			$img1 = $this->config->__get('img1');
			$q_img1 = "img_dest1 = :img1, ";
		}

		if($this->config->__get('img2') != ""){
			$img2 = $this->config->__get('img2');
			$q_img2 = "img_dest2 = :img2, ";
		}

		if($this->config->__get('img3') != ""){
			$img3 = $this->config->__get('img3');
			$q_img3 = "img_dest3 = :img3, ";
		}

			$query = "update config set titulo_site = :titulo, " . $q_img_esc . " " . $q_img1 . " " .  $q_img2  . " " . $q_img3  . " txt_img1 = :txt1, txt_img2 = :txt2, txt_img3 = :txt3, desc_esc = :desc, img_local = :local, contato = :contato";
			
			$titulo = $this->config->__get('titulo');
			
			$txt_img1 = $this->config->__get('txt_img1');
			$txt_img2 = $this->config->__get('txt_img2');
			$txt_img3 = $this->config->__get('txt_img3');
			$local = $this->config->__get('local');
			$contato = $this->config->__get('contato');
			$desc_esc = $this->config->__get('desc_esc');

	    	$stmt = $this->conexao->prepare($query);

	    	$stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
	    	if($img_esc != ""){
		    	$stmt->bindParam(':img_esc', $img_esc, PDO::PARAM_STR); 
	    	} 
	    	if($img1 != ""){
		    	$stmt->bindParam(':img1', $img1, PDO::PARAM_STR); 
	    	} 
	    	if($img2 != ""){
		    	$stmt->bindParam(':img2', $img2, PDO::PARAM_STR); 
	    	} 
	    	if($img3 != ""){
		    	$stmt->bindParam(':img3', $img3, PDO::PARAM_STR); 
	    	}            
	    	$stmt->bindParam(':txt1', $txt_img1, PDO::PARAM_STR);       
	    	$stmt->bindParam(':txt2', $txt_img2, PDO::PARAM_STR);       
	    	$stmt->bindParam(':txt3', $txt_img3, PDO::PARAM_STR);       
	    	$stmt->bindParam(':desc', $desc_esc, PDO::PARAM_STR);       
	    	$stmt->bindParam(':local', $local, PDO::PARAM_STR);       
	    	$stmt->bindParam(':contato', $contato, PDO::PARAM_STR);    

			return $stmt->execute();
			
			
	}

	public function select(){

	}
}

?>