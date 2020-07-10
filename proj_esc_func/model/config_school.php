<?php
class ConfigSchool{
	private $start_time_lesson;
	private $end_time_lesson;
	private $avg_grade;
	private $max_missing;
	private $missing_allowance;
	private $id_adm_insert;
	private $id_adm_update;
	//private $create_at;
	//private $update_at;

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}
?>