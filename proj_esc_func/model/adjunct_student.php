<?php

class AdjunctStudent{
	private $id_student;
	private $parent_1;
	private $parent_2;
	private $phone_parent_1;
	private $phone_parent_2;
	private $registration;

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}
}

?>