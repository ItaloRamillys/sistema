<?php 
class User{
	private $id;
	private $obs;
	private $login;
	private $pass;
	private $name;
	private $last_name;
	private $birth;
	private $blood;
	private $genre;
	private $document;
	private $email;
	private $id_author_insert;
	private $id_author_update;
	private $address;
	private $img_profile;
	private $type;
	private $std_style;
	private $create_at;
	private $update_at;
	
	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}			
?>