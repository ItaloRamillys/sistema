<?php 

class User{
	private $login;
	private $senha;
	private $first_name;
	private $last_name;
	private $birth;
	private $blood;
	private $genre;
	private $cpf;
	private $address;
	private $email;
	private $create_at;
	private $update_at;
	private $type;
	private $img_profile;
	
	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}
}	

		
?>