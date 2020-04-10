<?php

class TurmaAlunoService{

	private $conexao;
	private $turma_aluno;

	public function __construct(Conexao $conexao, TurmaAluno $tur){
		$this->conexao = $conexao->conectar();
		$this->turma_aluno = $tur;
	}

	public function insert(){

		$ano = $this->turma_aluno->__get('ano');
		$id_turma = $this->turma_aluno->__get('id_turma');
		$id_aluno = $this->turma_aluno->__get('id_aluno');
		
		$query = "";

		$array_ids[] = $this->turma_aluno->id_aluno;

		foreach ($array_ids[0] as $key => $value) {

			$query .= "insert into turma_aluno (id_aluno, id_turma, ano) values (:id_aluno".$key.", :id_turma".$key.", :ano".$key.");";
		}

		$stmt = $this->conexao->prepare($query);
		
		foreach ($array_ids[0] as $key => $value) {
			$stmt->bindValue(":id_aluno".$key, $value);
			$stmt->bindValue(":id_turma".$key, $id_turma);
			$stmt->bindValue(":ano".$key, $ano);
		}
		

		if($stmt->execute()){
			header("Location: ../../proj_esc/templates/preencher_turma.php?cadastro=1&turma={$id_turma}");
		}else{
			header("Location: ../../proj_esc/templates/preencher_turma.php?cadastro=0&turma={$id_turma}");
		}

	}

	public function delete(){
		
		$id_ta = $this->turma_aluno->__get('id_ta');
		$query = "delete from turma_aluno where id_ta = " . $id_ta;
		$stmt = $this->conexao->prepare($query);

		if($stmt->execute()){
			header("Location: ../../proj_esc/templates/turmas_adm.php?&delete=1");
		}else{
			header("Location: ../../proj_esc/templates/turmas_adm.php?&delete=0");
		}
	}

	public function update(){

	}

	public function select(){

	}
}

?>