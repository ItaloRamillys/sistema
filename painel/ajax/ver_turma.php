<?php
require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');

$conn = new Connection();

$conn = $conn->connect();

$query = "select * from turma order by nome_turma asc";

$queryAno = "select distinct(ano) from turma_aluno";

$select = "<div class='col-12 justify-content-center'>
			<form action='showDataTurma.php' method='POST'>
				<select class='col-10 col' name='ano_turma' required/> 
				<option value=''>Selecione um ano</option>
          ";

foreach ($conn->query($queryAno) as $row) {
	if(!empty($row)){
		$select .= "<option value='{$row['ano']}'>{$row['ano']}</option>";
	}
}

$select .= "</select> <br>";

echo $select;

echo "<small>Ao clicar em uma turma você irá gerenciar a turma.</small><br>Sua escola possui as seguintes turmas: 

	<div class='row'>";

foreach ($conn->query($query) as $dados) {
	if(!empty($dados)){
		echo "<div class='col-2'><label class='p-2'>{$dados['nome_turma']}</label><input type='radio' name='turma' class='p-2' value='{$dados['id_turma']}' required></div>";
	}
}

echo "</div><input type='submit' value='Visualizar' class='btn btn-primary btn-sm'></form></div>";

?>