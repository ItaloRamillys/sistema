<?php

class TurmaService{

	private $conexao;
	private $turma;

	public function __construct(Conexao $conexao, Turma $tur){
		$this->conexao = $conexao->conectar();
		$this->turma = $tur;
	}

	public function insert(){

		$id_ano = "0";

		$src_ano = date("Y");

		$query_ano = "select id_ano from ano_letivo where ano = ". $src_ano ;

		foreach ($this->conexao->query($query_ano) as $ano) {
			$id_ano = $ano['id_ano'];
		}

		session_start();
		$id_escola = $_SESSION['escola'];

		echo("<script>alert(" .  print_r($stmt_ano) . ");</script>");

		$query = "insert into turma(nome_turma) values(:nome_turma)";
			
	    	$stmt = $this->conexao->prepare($query);

			$stmt->bindValue(':nome_turma', $this->turma->__get('nome_turma'));
	    	//$stmt->bindValue(':sala', $this->turma->__get('sala'));
	    	//$stmt->bindValue(':id_ano', $id_ano);
	    	//$stmt->bindValue(':id_esc', $id_escola);

				if($stmt->execute()){
					header('Location: ../../proj_esc/templates/cad_turma.php?cadastro=1');
				}
				else{
					header('Location: ../../proj_esc/templates/cad_turma.php?cadastro=0');
				}
			
	}

	public function delete(){

	}

	public function update(){

	}

	public function select(){

	}
}

?>