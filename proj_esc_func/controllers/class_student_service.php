<?php
require "autoload.php";

use Helpers\Message;

class ClassStudentService{
	private $con;
	private $class_student;
	private $message;

	public function __construct(connection $con, ClassStudent $class_student){
		$this->connection = $con->connect();
		$this->class_student = $class_student;
	}

	public function insert(){

		$year = $this->class_student->__get('year');
		$id_class = $this->class_student->__get('id_class');
		$id_student = $this->class_student->__get('id_student');
		
		$query = "";

		$array_ids[] = $this->class_student->id_student;

		foreach ($array_ids[0] as $key => $value) {
			$query .= "insert into class_student (id_student, id_class, year) values (:id_student".$key.", :id_class".$key.", :year".$key.");";
		}

		$stmt = $this->connection->prepare($query);
		
		foreach ($array_ids[0] as $key => $value) {
			$stmt->bindValue(":id_student".$key, $value);
			$stmt->bindValue(":id_class".$key, $id_class);
			$stmt->bindValue(":year".$key, $year);
		}
		
		$this->message = new Message();
		if($stmt->execute()){
			$text = 'Aluno(s) cadastrado(s) com sucesso';
			$this->message->success($text);
		}else{
			$err = implode("", $stmt->errorInfo());
			$text = 'Falha ao cadastrar alunos na turma. ' . $err ;
			$this->message->error($text);
		}
		return $this->message->render();

	}

	public function delete(){
		
		$id_ta = $this->class_student->__get('id_ta');
		$query = "delete from class_student where id_ta = " . $id_ta;
		$stmt = $this->connection->prepare($query);

		if($stmt->execute()){
			header("Location: ../../proj_esc/templates/classs_adm.php?&delete=1");
		}else{
			header("Location: ../../proj_esc/templates/classs_adm.php?&delete=0");
		}
	}

	public function update(){

	}

	public function select(){

	}
}

?>