<?php

class Grade{
	private $id_grade;
	private $id_subj_class;
	private $id_student;
	private $value_grade;
	private $period;
	private $create_at;

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}
}

?>