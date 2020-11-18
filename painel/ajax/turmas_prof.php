<?php 
require_once('C:\xampp\htdocs\sistema\proj_esc_func\connection.php');
require_once('C:\xampp\htdocs\sistema\painel\functions.php');

$exp = explode('-', $_POST['turma_ano']);

$turma = $exp[0];

$ano = $exp[1];

$conn = new Connection();

$conn = $conn->connect();

//VERIFICAR ANO NA QUERY ABAIXO

$query = "select id, name, last_name, genre, img_profile from user a inner join 
			(select t.id_student from class_student t where t.id_class = {$turma} and year = {$ano}) x on a.id = x.id_student";

$stmt = $conn->query($query);

$result = array();

$array_aux = array();

while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
	
	$array_aux['id'] = base64_encode($dados['id']);
	$array_aux['name'] = $dados['name'];
	$array_aux['last_name'] = $dados['last_name'];

	    if(lcfirst($dados['genre']) == 'f'){
            $img_profile = "padrao/female.png";    
        }elseif(lcfirst($dados['genre']) == 'm'){
            $img_profile = "padrao/male.png";
        }else{
            $img_profile = "padrao/male.png";
        }
    
	$array_aux['img_profile'] = render_img(__DIR__ . "/../../img/" . $dados['img_profile'], 
                                "http://localhost/sistema/img/" . $dados['img_profile'], 
                                "http://localhost/sistema/img/".$img_profile,
                                    'rounded-circle bg-light',
                                    80,
                                    80);
	$result[] =  $array_aux;
}

$result_array = array($result);

echo json_encode($result_array);

?>
