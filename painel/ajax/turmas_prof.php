<?php 

$exp = explode('-', $_GET['turma_ano']);

$turma = $exp[0];

$ano = $exp[1];

require_once('C:\xampp\htdocs\sistema\proj_esc_func\conexao.php');

$conexao = new Conexao();

$conexao = $conexao->conectar();

//VERIFICAR ANO NA QUERY ABAIXO

$query = "select id, nome, sobrenome, genero, img_profile from usuario a inner join 
			(select t.id_aluno from turma_aluno t where t.id_turma = {$turma} and ano = {$ano}) x on a.id = x.id_aluno";

$stmt = $conexao->query($query);

$result = array();

$array_aux = array();

while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
	
	$array_aux['id'] = base64_encode($dados['id']);
	$array_aux['nome'] = $dados['nome'];
	$array_aux['sobrenome'] = $dados['sobrenome'];

	if($dados['img_profile'] != ""){
        $img_profile = $dados['img_profile'];
    }else{
        if(lcfirst($dados['genero']) == 'f'){
            $img_profile = "padrao/female.png";    
        }elseif(lcfirst($dados['genero']) == 'm'){
            $img_profile = "padrao/male.png";
        }else{
            $img_profile = "padrao/male.png";
        }
    }

	$array_aux['img_profile'] = $img_profile;
	$result[] =  $array_aux;

}

$result_array = array($result);

echo json_encode($result_array);

?>
