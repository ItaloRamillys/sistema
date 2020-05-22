<?php

class ClassStudent{

	private $id_class;
	private $id_student;
	private $year;

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}
}

?>