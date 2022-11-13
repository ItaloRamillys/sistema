<?php

class Attendance{
	private $id_attendance;
	private $id_student;
	private $type_attenndance;
	private $date;
	private $id_subj_class;

	public function __get($attr){
		return $this->$attr;
	}

	public function __set($attr, $value){
		$this->$attr = $value;
	}
}

?>