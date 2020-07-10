<?php
class ClassStudent{
	private $id_class_student;
	private $id_class;
	private $id_student;
	private $year;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}
?>