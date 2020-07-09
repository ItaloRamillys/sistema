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

		$query_verify = "select * from recurrence_lesson where id_subject_class = " . $this->rec_lesson->__get('id_subject_class') . " and day_of_week = " . $this->rec_lesson->__get('day_of_week');

		$stmt_v = $this->conn->query($query_verify);

		$hour_start_inserted = strtotime($this->rec_lesson->__get('start_time_lesson'));
		$hour_end_inserted = strtotime($this->rec_lesson->__get('end_time_lesson'));

		$msg_error = "";

		$array_times = ['07:00-07:50', '07:50-08:40', '09:00-09:50', '09:50-10:40', 
                '13:00-13:50', '13:50-14:40', '15:00-15:50', '15:50-16:40'];

		if(!in_array($this->rec_lesson->__get('start_time_lesson') . "-" . $this->rec_lesson->__get('end_time_lesson'), $array_times)){
			$msg_error .= " Os horáros inseridos não estão de acordo com os horários normais das aulas.";
		}

		while ($dados = $stmt_v->fetch(PDO::FETCH_ASSOC)) {
			$start_time_lesson_bd = strtotime($dados['start_time_lesson']);
			$end_time_lesson_bd = strtotime($dados['end_time_lesson']);

			if($hour_start_inserted >= $hour_end_inserted){
				$msg_error .= " Os horários não podem ser iguais e o de início deve ser maior que o de término.";
			}
			if(($hour_start_inserted == $start_time_lesson_bd) || ($hour_start_inserted == $end_time_lesson_bd) || 
				(($hour_start_inserted > $start_time_lesson_bd) &&
				($hour_start_inserted < $end_time_lesson_bd))){
				$msg_error .= " A aula não pode iniciar no horário " . $this->rec_lesson->__get('start_time_lesson') . ", pois já existe uma aula cadastrada no mesmo dia e no intervalo de " . $dados['start_time_lesson'] . " - " . $dados['end_time_lesson'] . ".";
			}
			if(($hour_end_inserted == $start_time_lesson_bd) || ($hour_end_inserted == $end_time_lesson_bd) || 
				(($hour_end_inserted > $start_time_lesson_bd) &&
				($hour_end_inserted < $end_time_lesson_bd))){
				$msg_error .= "  A aula não pode terminar no horário " . $this->rec_lesson->__get('end_time_lesson') . ", pois á existe uma aula cadastrada no mesmo dia e no intervalo de " . $dados['start_time_lesson'] . " - " . $dados['end_time_lesson'] . ".";
			}
		}

		$query = "insert into recurrence_lesson(day_of_week,start_time_lesson,end_time_lesson,id_subject_class) values(:day_of_week,:start_time_lesson,:end_time_lesson,:id_subject_class)";
			
    	$stmt = $this->conn->prepare($query);

    	$stmt->bindValue(':day_of_week', $this->rec_lesson->__get('day_of_week'));
    	$stmt->bindValue(':start_time_lesson', $this->rec_lesson->__get('start_time_lesson'));
    	$stmt->bindValue(':end_time_lesson', $this->rec_lesson->__get('end_time_lesson'));
    	$stmt->bindValue(':id_subject_class', $this->rec_lesson->__get('id_subject_class'));

    	$this->message = new Message();

		if($msg_error == ""){
			if($stmt->execute()){
				$text = "Aula cadastrada com sucesso";	
				$this->message->success($text);			
			}else{
				$text = "Falha ao cadastrar aula. Erro no banco de dados ou na conexão.";
				$this->message->error($text);
			}
		}else{
			$text = "Falha ao cadastrar aula. Erros:" .$msg_error;
			$this->message->error($text);
		}

		return $this->message->render();
	}

	public function delete(){
			
			$id_del = $this->rec_lesson->__get('id');

			$query = "delete from rec_lesson where id_rec_lesson = " . $id_del;

			$stmt = $this->conn->prepare($query);

			if($stmt->execute()){
				header('Location: ../../proj_esc/templates/showData.php?src=rec_lesson&delete=1');
			}else{
				header('Location: ../../proj_esc/templates/showData.php?src=rec_lesson&delete=0');
			} 
	}

	public function update(){
		try{

			$id_up = $this->rec_lesson->__get('id');

			$adjunct_query = "";

			if($this->rec_lesson->__get('path') != ''){
				$adjunct_query = ", path_img = :path_img";
				$path_img 	 	= $this->rec_lesson->__get('path');
			}

			$query = "update rec_lesson set title_rec_lesson = :title_rec_lesson, desc_rec_lesson = :desc_rec_lesson , update_at = :update_at " .$adjunct_query. " where id_rec_lesson = " . $id_up;

	    	$stmt = $this->conn->prepare($query);

	    	$title_rec_lesson 	= $this->rec_lesson->__get('title');
			$desc_rec_lesson 		= $this->rec_lesson->__get('desc');
			$update_at 	 	= $this->rec_lesson->__get('update_at');

	    	$stmt->bindParam(':title_rec_lesson', $title_rec_lesson, PDO::PARAM_STR); 
	    	$stmt->bindParam(':desc_rec_lesson', $desc_rec_lesson, PDO::PARAM_STR); 
			$stmt->bindParam(':update_at', $update_at, PDO::PARAM_STR);

	    	if($this->rec_lesson->__get('path') != ''){
	    		$stmt->bindParam(':path_img', $path_img, PDO::PARAM_STR); 
			}

	    	if($stmt->execute()){

			    header('Location: ../../proj_esc/templates/showData.php?src=rec_lesson&update=1');
	    	}
		}catch(PDOException $e){
			 header('Location: ../../proj_esc/templates/showData.php?src=rec_lesson&update=0');
		}
	}

	public function select(){

	}
}

?>