<?php

class TurmaDiscService{

	private $conexao;
	private $turma_disc;

	public function __construct(Conexao $conexao, TurmaDisc $tur){
		$this->conexao = $conexao->conectar();
		$this->turma_disc = $tur;
	}

	public function insert(){

		require "../../proj_esc/functions.php";

		$ano = $this->turma_disc->__get('ano');

		
			
			$id_turma = $this->turma_disc->__get('id_turma');
			$id_prof = $this->turma_disc->__get('id_prof');
			$id_disc = $this->turma_disc->__get('id_disc');
			$dia_sem = $this->turma_disc->__get('dia');
			$hora = $this->turma_disc->__get('hora');
				
			$query = "insert into disc_turma (id_disc, id_prof, id_turma, ano, dia_sem, hora) values (:id_disc, :id_prof, :id_turma, :ano, :dia_sem, :hora)";

			$stmt = $this->conexao->prepare($query);

			$stmt->bindValue(":id_disc", $id_disc);
			$stmt->bindValue(":id_prof", $id_prof);
			$stmt->bindValue(":id_turma", $id_turma);
			$stmt->bindValue(":ano", $ano);
			$stmt->bindValue(":dia_sem", $dia_sem);
			$stmt->bindValue(":hora", $hora);


			if($stmt->execute()){
				header("Location: ../../proj_esc/templates/cad_disc.php?cad_turma_disc=1");
			}else{
				header("Location: ../../proj_esc/templates/cad_disc.php?cad_turma_disc=0");
			}
		

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

	public function select(){

	}
}

?>