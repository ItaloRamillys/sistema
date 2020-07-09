<?php

class RecurrenceLesson{
	private $id_recurrence_lesson;
	private $day_of_week;
	private $start_lesson;
	private $end_lesson;
	private $id_subject_class;	

	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}
}

?>