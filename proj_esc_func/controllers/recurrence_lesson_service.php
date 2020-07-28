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

		$stmt_v = $this->conn->query($query_verify);

		$query = "insert into recurrence_lesson(day_of_week,,order_lesson,id_subject_class) values(:day_of_week,:,:order_lesson,:id_subject_class)";
			
    	$stmt = $this->conn->prepare($query);

    	$stmt->bindValue(':day_of_week', $this->rec_lesson->__get('day_of_week'));
    	$stmt->bindValue(':order_lesson', $this->rec_lesson->__get('order_lesson'));
    	$stmt->bindValue(':id_subject_class', $this->rec_lesson->__get('id_subject_class'));

    	$this->message = new Message();

		if($stmt->execute()){
			$text = "Aula cadastrada com sucesso";	
			$this->message->success($text);			
		}else{
			$text = "Falha ao cadastrar aula. Erro no banco de dados ou na conexão.";
			$this->message->error($text);
		}

		return $this->message->render();
	}

	public function delete(){
			
			$id_del = $this->rec_lesson->__get('id');

			$query = "delete from rec_lesson where id_rec_lesson = " . $id_del;

			$stmt = $this->conn->prepare($query);

			if($stmt->execute()){
				
			}else{

			} 
	}

	public function update(){
		
	}

	public function select(){

	}
}

?>