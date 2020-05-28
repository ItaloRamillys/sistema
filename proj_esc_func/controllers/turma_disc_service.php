<?php
require "autoload.php";

use Helpers\Message;

class TurmaDiscService{

	private $conexao;
	private $turma_disc;
	private $message;

	public function __construct(Conexao $conexao, TurmaDisc $tur){
		$this->conexao = $conexao->conectar();
		$this->turma_disc = $tur;
	}

	public function insert(){

		$ano = $this->turma_disc->__get('ano');			
		$id_turma = $this->turma_disc->__get('id_turma');
		$id_prof = $this->turma_disc->__get('id_prof');
		$id_disc = $this->turma_disc->__get('id_disc');			

		$query = "insert into disc_turma (id_disc, id_prof, id_turma, ano) values (:id_disc, :id_prof, :id_turma, :ano)";
		$stmt = $this->conexao->prepare($query);

		$stmt->bindValue(":id_disc", $id_disc);
		$stmt->bindValue(":id_prof", $id_prof);
		$stmt->bindValue(":id_turma", $id_turma);
		$stmt->bindValue(":ano", $ano);

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
		
		$id_td = $this->turma_disc->__get('id_td');
		$query = "delete from disc_turma where id_DT = " . $id_td;
		$stmt = $this->conexao->prepare($query);

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