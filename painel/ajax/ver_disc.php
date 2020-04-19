<?php
		require_once('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

		$conexao = new Conexao();

		$conexao = $conexao->conectar();

		$query = "select nome_disc from disciplina order by nome_disc asc";

		echo "Sua escola possui as seguintes disciplinas: <br>";
		
		foreach ($conexao->query($query) as $dados) {
			if(!empty($dados)){
				echo "<span class='btn btn-primary btn-sm rounded m-2'>" . $dados['nome_disc'] . "</span> ";
			}
		}
		
?>