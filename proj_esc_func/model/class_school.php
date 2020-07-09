<?php
class ClassSchool{
	private $id_class;
	private $name_class;
	private $year;
	private $room;
	private $organizer_class;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}
?>