<?php
require "autoload.php";

use Helpers\Message;

class ConfigSchoolService{
	private $conn;
	private $config_school;
	private $message;

	public function __construct(Connection $conn, ConfigSchool $config_school){
		$this->conn = $conn->connect();
		$this->config_school = $config_school;
	}

	public function insert(){
		$query = "insert into config_school(avg_grade, max_missing, missing_allowance, id_adm_insert) values(:avg_grade, :max_missing, :missing_allowance, :id_adm_insert)";
	    $stmt = $this->conn->prepare($query);

		$stmt->bindValue(':avg_grade', $this->config_school->__get('avg_grade'));
		$stmt->bindValue(':max_missing', $this->config_school->__get('max_missing'));
		$stmt->bindValue(':missing_allowance', $this->config_school->__get('missing_allowance'));
		$stmt->bindValue(':id_adm_insert', $this->config_school->__get('id_adm_insert'));

		$this->message = new Message();

		if($stmt->execute()){
			$text = 'Configuração cadastrada com sucesso';
			$this->message->success($text);
		}else{
			$err = implode("", $stmt->errorInfo());
			$text = 'Falha ao cadastrar configuração. ' . $err . ' - ' . $this->config_school->__get('id_adm_insert');
			$this->message->error($text);
		}

		return $this->message->render();
	}

	public function delete(){

	}

	public function update(){
		$query = "update config_school set avg_grade = :avg_grade, max_missing = :max_missing, missing_allowance = :missing_allowance, id_adm_update = :id_adm_update";
	    $stmt = $this->conn->prepare($query);

		$stmt->bindValue(':avg_grade', $this->config_school->__get('avg_grade'));
		$stmt->bindValue(':max_missing', $this->config_school->__get('max_missing'));
		$stmt->bindValue(':missing_allowance', $this->config_school->__get('missing_allowance'));
		$stmt->bindValue(':id_adm_update', $this->config_school->__get('id_adm_update'));

		$this->message = new Message();

		if($stmt->execute()){
			$text = 'Configuração atualizada com sucesso';
			$this->message->success($text);
		}else{
			$err = implode("", $stmt->errorInfo());
			$text = 'Falha ao atualizar configuração. ' . $err . ' - ' . $this->config_school->__get('id_adm_insert');
			$this->message->error($text);
		}

		return $this->message->render();
	}

	public function select(){

	}
}

?>