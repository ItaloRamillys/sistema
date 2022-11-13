<?php

class AdjunctTeacher{
	private $id_user;
	private $salary;
	private $graduation;
	private $description;
	private $validate;

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}
}

?>