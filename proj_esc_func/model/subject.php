<?php

class Subject{
	private $name_subject;
	private $cod_subject;

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}
}

?>