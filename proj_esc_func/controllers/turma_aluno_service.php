<?php
require "autoload.php";

use Helpers\Message;

class ClassStudentService{

	private $conn;
	private $class_student;
	private $message;

	public function __construct(Connection $conn, ClassStudent $class_student){
		$this->conn = $conn->connect();
		$this->class_student = $class_student;
	}

	public function insert(){
		$year = $this->class_student->__get('year');
		$id_class = $this->class_student->__get('id_class');
		$id_student = $this->class_student->__get('id_student');
		
		$query .= "insert into class_student (id_student, id_class, year) values (:id_student, :id_class, :year);";
	
		$stmt = $this->conn->prepare($query);
		
		$stmt->bindValue(":id_student", $value);
		$stmt->bindValue(":id_class", $id_class);
		$stmt->bindValue(":year", $year);
	
		$this->message = new Message();
		if($stmt->execute()){
			$text = 'Aluno cadastrado com sucesso na turma';
			$this->message->success($text);
		}else{
			$err = implode("", $stmt->errorInfo());
			$text = 'Falha ao cadastrar aluno na turma. '.$errors;
			$this->message->error($text . " - > " . $err);
		}

		return $this->message->render(); 
	}

	public function delete(){
		
		$id_ta = $this->class_student->__get('id_ta');
		$query = "delete from class_student where id_ta = " . $id_ta;
		$stmt = $this->conn->prepare($query);

		if($stmt->execute()){
			header("Location: ../../proj_esc/templates/turmas_adm.php?&delete=1");
		}else{
			header("Location: ../../proj_esc/templates/turmas_adm.php?&delete=0");
		}
	}

	public function update(){

	}

	public function select(){

	}
}

?>