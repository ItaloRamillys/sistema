<?php
require "autoload.php";
use Helpers\Message;

class SubjectClassService{

	private $conn;
	private $subject_class;
	private $message;

	public function __construct(Connection $conn, SubjectClass $subject_class){
		$this->conn = $conn->connect();
		$this->subject_class = $subject_class;
	}

	public function insert(){
		$id_subject = $this->subject_class->__get('id_subject');			
		$id_class = $this->subject_class->__get('id_class');
		$id_teacher = $this->subject_class->__get('id_teacher');
		$year = $this->subject_class->__get('year');			

		$query = "insert into subject_class_lesson (id_subject, id_class, id_teacher, year, status) values (:id_subject, :id_class, :id_teacher, :year, :status)";
		$stmt = $this->conn->prepare($query);

		$stmt->bindValue(":id_subject", $id_subject);
		$stmt->bindValue(":id_class", $id_class);
		$stmt->bindValue(":id_teacher", $id_teacher);
		$stmt->bindValue(":year", $year);
		$stmt->bindValue(":status", '1');

		$this->message = new Message();

		if($stmt->execute()){
			$text = "Disciplina incluída com sucesso";
			$this->message->success($text);
		}else{
			$text = "Falha ao incluir disciplina";
			$this->message->error($text);
		}

		return $this->message->render();
	}

	public function delete(){
		
		$id_td = $this->subject_class->__get('id_td');
		$query = "delete from disc_turma where id_DT = " . $id_td;
		$stmt = $this->conn->prepare($query);

		if($stmt->execute()){
			header("Location: ../../proj_esc/templates/turmas_adm.php?delete=1");
		}else{
			header("Location: ../../proj_esc/templates/turmas_adm.php?delete=0");
		}
	}

	public function update(){

	}

	public function select($ano=null){
		if($ano == null){
			$query = "select * from disc_turma";
		}else{
			$query = "select * from disc_turma where ano = " . $ano;
		}

		$main_query = "select";
	}
}

?>