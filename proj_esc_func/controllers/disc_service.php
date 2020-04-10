<?php

class DisciplinaService{

	private $conexao;
	private $disc;

	public function __construct(Conexao $conexao, Disciplina $disc){
		$this->conexao = $conexao->conectar();
		$this->disc = $disc;
	}

	public function insert(){

		$query = "insert into disciplina(nome_disc, cod_disc, id_esc) values(:nome_disc, :cod_disc, :id_esc)";
			
	    	$stmt = $this->conexao->prepare($query);

	    	session_start();
			$id_escola = $_SESSION['escola'];

	    	$stmt->bindValue(':nome_disc', $this->disc->__get('nome_disc'));
	    	$stmt->bindValue(':cod_disc', $this->disc->__get('cod_disc'));
	    	$stmt->bindValue(':id_esc', $id_escola);

			return $stmt->execute();
			
	}

	public function delete(){

	}

	public function update(){

	}

	public function select(){

	}
}

?>