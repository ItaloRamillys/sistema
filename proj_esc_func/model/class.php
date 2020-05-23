<?php

class Class{
	private $id_class;
	private $name_class;
	private $year;
	private $class;

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}
}

?>