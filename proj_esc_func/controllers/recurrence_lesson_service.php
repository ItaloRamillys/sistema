<?php
require "autoload.php";

use Helpers\Message;

class RecurrenceLessonService{

	private $conn;
	private $rec_lesson;
	private $message;

	public function __construct(Connection $conn, RecurrenceLesson $rec_lesson){
		$this->conn = $conn->connect();
		$this->rec_lesson = $rec_lesson;
	}

	public function insert(){
		$query_verify = "select count(*) from recurrence_lesson where order_lesson = " . $this->rec_lesson->__get('order_lesson') . " and day_of_week = " . $this->rec_lesson->__get('day_of_week') . " and id_class = " . $this->rec_lesson->__get('id_class');
		$stmt_verify = $this->conn->query($query_verify);
		$row_verify = $stmt_verify->fetch(PDO::FETCH_NUM);

		$txt_erro = "";
		if($row_verify[0] > 0){
			$txt_erro = "Já existe uma aula cadastrada nesse horário para esta turma.";
		} 

		$query = "insert into recurrence_lesson(day_of_week,order_lesson,id_subject, id_class, id_teacher, year) values(:day_of_week,:order_lesson,:id_subject, :id_class, :id_teacher, :year)";
			
    	$stmt = $this->conn->prepare($query);

    	$stmt->bindValue(':day_of_week', $this->rec_lesson->__get('day_of_week'));
    	$stmt->bindValue(':order_lesson', $this->rec_lesson->__get('order_lesson'));
    	$stmt->bindValue(':id_subject', $this->rec_lesson->__get('id_subject'));
    	$stmt->bindValue(':id_class', $this->rec_lesson->__get('id_class'));
    	$stmt->bindValue(':id_teacher', $this->rec_lesson->__get('id_teacher'));
    	$stmt->bindValue(':year', $this->rec_lesson->__get('year'));

    	$this->message = new Message();

		if($stmt->execute()){
			$text = "Aula cadastrada com sucesso";	
			$this->message->success($text);			
		}else{
			$text = "Falha ao cadastrar aula. " . $txt_erro;
			$this->message->error($text);
		}

		return $this->message->render();
	}

	public function delete(){
			$id_del = $this->rec_lesson->__get('id_recurrence_lesson');
			$query = "delete from recurrence_lesson where id_rec_lesson = " . $id_del;
			$stmt = $this->conn->prepare($query);

			$this->message = new Message();

			if($stmt->execute()){
				$text = "Aula removida com sucesso";	
				$this->message->success($text);			
			}else{
				$err = implode('', $stmt->erroInfo());
				$text = "Falha ao remover aula. " . $err;
				$this->message->error($text);
			}

			return $this->message->render();
	}

	public function update(){
		
	}

	public function select(){

	}
}

?>