<?php
require "autoload.php";

use Helpers\Message;

class GradeService{

	private $conn;
	private $grade;
	private $message;

	public function __construct(Connection $conn, Grade $grade){
		$this->conn = $conn->connect();
		$this->grade = $grade;
	}

	public function insert(){

		$query = "";
			
		$array_ids = $this->grade->id_student;
		$array_value_grades = $this->grade->value_grade;

		$id_SC = $this->grade->id_SC;
		$period = $this->grade->period;

		foreach ($array_ids as $key => $value) {
			$query .= "insert into grade(id_SC, id_student, period, value_grade) values(:id_SC".$key.", :id_student".$key.", :period".$key.", :value_grade".$key.");";
		}

		if ($query == "") {
			header('Location: ../../proj_esc/templates/cad_value_grade.php?cadastro=1');
			die;
		}

		$stmt = $this->conn->prepare($query);

    	foreach ($array_ids as $key => $value) {
			$stmt->bindValue(":id_student".$key, $value);
			$stmt->bindValue(":period".$key, $period);
			$stmt->bindValue(":id_SC".$key, $id_SC);
		}
		foreach ($array_value_grades as $key => $value) {
			$stmt->bindValue(":value_grade".$key, $value);
		}

		$this->message = new Message();

		if($stmt->execute()){
			$text = "Nota cadastrada com sucesso.";
			$this->message->success($text);
		}else{
			$text = "Falha ao cadastrar nota.";
			$this->message->error($text);
		}

		return $this->message->render();
	}

	public function delete(){
			
			$id_del = $this->value_grade->__get('id');

			$query = "delete from value_grade where id_ntc = " . $id_del;

			$stmt = $this->conn->prepare($query);

			if($stmt->execute()){
				header('Location: ../../proj_esc/templates/showData.php?src=news&delete=1');
			}else{
				header('Location: ../../proj_esc/templates/showData.php?src=news&delete=0');
			} 
	}

	public function update(){
		try{

			$id_up = $this->value_grade->__get('id');

			$completa_query = "";

			
			if($this->value_grade->__get('path') != ''){

				$completa_query = ", path_img = :path_img";
				$path_img 	 	= $this->value_grade->__get('path');
			}

			$query = "update value_grade set titulo_ntc = :titulo_ntc, desc_ntc = :desc_ntc , update_at = :update_at " .$completa_query. " where id_ntc = " . $id_up;

	    	$stmt = $this->conn->prepare($query);

	    	$tempo = time('d/m/Y');

	    	$titulo_ntc 	= $this->value_grade->__get('titulo');
			$desc_ntc 		= $this->value_grade->__get('desc');
			$update_at 	 	= $this->value_grade->__get('update_at');

	    	$stmt->bindParam(':titulo_ntc', $titulo_ntc, PDO::PARAM_STR); 
	    	$stmt->bindParam(':desc_ntc', $desc_ntc, PDO::PARAM_STR); 
			$stmt->bindParam(':update_at', $update_at, PDO::PARAM_STR);

	    	if($this->value_grade->__get('path') != ''){
	    		$stmt->bindParam(':path_img', $path_img, PDO::PARAM_STR); 
			}

	    	if($stmt->execute()){

			    header('Location: ../../proj_esc/templates/showData.php?src=news&update=1');
	    	}
		}catch(PDOException $e){
			 header('Location: ../../proj_esc/templates/showData.php?src=news&update=0');
		}
	}

	public function select(){

	}
}

?>