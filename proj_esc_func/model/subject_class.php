<?php

class SubjectClass{

	private $id_class;
	private $id_subject;
	private $id_teacher;
	private $year;

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}
}

?>