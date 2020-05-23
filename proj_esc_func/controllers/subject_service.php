<?php

class SubjectService{

	private $connect;
	private $subject;

	public function __construct(Connection $connect, Subject $subject){
		$this->connect = $connect->conectar();
		$this->subject = $subject;
	}

	public function insert(){

		$query = "insert into subject(name_subject, cod_subject) values(:name_subject, :cod_subject)";
		
    	$stmt = $this->connect->prepare($query);
	
		$stmt->bindValue(':name_subject', $this->subject->__get('name_subject'));
    	$stmt->bindValue(':cod_subject', $this->subject->__get('cod_subject'));

		return $stmt->execute();
	}

	public function delete(){

	}

	public function update(){

	}

	public function select(){

	}
}

?>