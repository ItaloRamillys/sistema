<?php
require "autoload.php";

use Helpers\Message;

class AttendanceService{

	private $conn;
	private $attendance;
	private $message;

	public function __construct(Connection $conn, Attendance $attendance){
		$this->conn = $conn->connect();
		$this->attendance = $attendance;
	}

	public function insert(){

		$query = "";
		$this->message = new Message();

		$array_ids = $this->attendance->__get('id_user');
		$array_tipos = $this->attendance->__get('type_attendance');
		$id_subj_class = $this->attendance->__get('id_subj_class');
		$date = $this->attendance->__get('date');

		$query_verify = "select count(*) as qtde_freq from attendance where date = '{$date}' and id_SC = {$id_subj_class}";

		$stmt_verify = $this->conn->query($query_verify);

		$result = $stmt_verify->fetchAll(PDO::FETCH_ASSOC);

		if($result[0]['qtde_freq'] > 0){
			$text = "Já existe uma frequência cadastrada neste dia.";
			$this->message->warning($text);
			return $this->message->render();
		}

		foreach ($array_ids[0] as $key => $value) {
			$query .= "insert into attendance(id_user, date, type, id_SC) values(:id_user".$key.", :date".$key.", :type".$key.",  :id_SC".$key.");";
		}

		if ($query == "") {
			$text = "Frequência cadastrada com sucesso.";
			$this->message->success($text);
		}
			
    	$stmt = $this->conn->prepare($query);

    	foreach ($array_ids[0] as $key => $value) {
			$stmt->bindValue(":id_user".$key, $value);
			$stmt->bindValue(":date".$key, $date);
			$stmt->bindValue(":id_SC".$key, $id_subj_class);
		}

		foreach ($array_tipos[0] as $key => $value) {
			$stmt->bindValue(":type".$key, $value);
		}

		if($stmt->execute()){
			$text = "Frequência cadastrada com sucesso.";
			$this->message->success($text);
		}else{
			$text = "Falha ao cadastrar frequência.";
			$this->message->error($text);
		}

		return $this->message->render();
	}

	public function delete(){
			
			$id_del = $this->frequencia->__get('id');

			$query = "delete from frequencia where id_ntc = " . $id_del;

			$stmt = $this->conexao->prepare($query);

			if($stmt->execute()){
				header('Location: ../../proj_esc/templates/showData.php?src=news&delete=1');
			}else{
				header('Location: ../../proj_esc/templates/showData.php?src=news&delete=0');
			} 
	}

	public function update(){
		try{

			$id_up = $this->frequencia->__get('id');

			$completa_query = "";

			
			if($this->frequencia->__get('path') != ''){

				$completa_query = ", path_img = :path_img";
				$path_img 	 	= $this->frequencia->__get('path');
			}

			$query = "update frequencia set titulo_ntc = :titulo_ntc, desc_ntc = :desc_ntc , update_at = :update_at " .$completa_query. " where id_ntc = " . $id_up;

	    	$stmt = $this->conexao->prepare($query);

	    	$tempo = time('d/m/Y');

	    	$titulo_ntc 	= $this->frequencia->__get('titulo');
			$desc_ntc 		= $this->frequencia->__get('desc');
			$update_at 	 	= $this->frequencia->__get('update_at');

	    	$stmt->bindParam(':titulo_ntc', $titulo_ntc, PDO::PARAM_STR); 
	    	$stmt->bindParam(':desc_ntc', $desc_ntc, PDO::PARAM_STR); 
			$stmt->bindParam(':update_at', $update_at, PDO::PARAM_STR);

	    	if($this->frequencia->__get('path') != ''){
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