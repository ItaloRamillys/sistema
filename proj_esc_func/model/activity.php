<?php
class Activity{
	private $id_activity;
	private $title_activity;
	private $desc_activity;
	private $references_activity;
	private $id_author_activity;
	private $id_SC_activity;
	private $deadline_activity;
	private $file_activity;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}
?>