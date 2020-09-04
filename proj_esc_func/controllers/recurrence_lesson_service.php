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
		$count_erro = 0;
		$query_verify = "select * from recurrence_lesson r inner join(select id_sc from subject_class_lesson scl inner join (select id_class, year from subject_class_lesson where id_sc = " . $this->rec_lesson->__get('id_sc') . ")x on x.id_class = scl.id_class)y on y.id_sc = r.id_sc and r.day_of_week = " . $this->rec_lesson->__get('day_of_week') . " and r.order_lesson = " . $this->rec_lesson->__get('order_lesson');

		$stmt_verify = $this->conn->query($query_verify);
		$row_verify = $stmt_verify->fetch(PDO::FETCH_NUM);

		$txt_erro = "";
		if($row_verify){
			$count_erro++;
			$txt_erro = "Já existe uma aula cadastrada nesse horário para esta turma.";
		} 

		$query = "insert into recurrence_lesson(day_of_week,order_lesson,id_sc) values(:day_of_week,:order_lesson,:id_sc)";
			
    	$stmt = $this->conn->prepare($query);

    	$stmt->bindValue(':day_of_week', $this->rec_lesson->__get('day_of_week'));
    	$stmt->bindValue(':order_lesson', $this->rec_lesson->__get('order_lesson'));
    	$stmt->bindValue(':id_sc', $this->rec_lesson->__get('id_sc'));

    	$this->message = new Message();

		if(!$count_erro){
			if($stmt->execute()){
				$text = "Aula cadastrada com sucesso";	
				$this->message->success($text);			
			}else{
				$err = implode('', $stmt->erroInfo());
				$text = "Falha ao cadastrar aula. " . $err;
				$this->message->error($text);
			}
		}else{
			$text = "Falha ao cadastrar aula. " . $txt_erro;
			$this->message->error($text);
		}

		return $this->message->render();
	}

	public function delete(){
			$id_del = $this->rec_lesson->__get('id_recurrence_lesson');
			$query = "delete from recurrence_lesson where id_recurrence_lesson = " . $id_del;
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