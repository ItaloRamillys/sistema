<?php 
session_start();
include_once("proj_esc_func/conexao.php"); 

$conexao = new Conexao();

$conexao = $conexao->conectar();

$user = strip_tags(trim($_POST['user']));
$pass = strip_tags(trim($_POST['pass']));

if((isset($user)) && (isset($pass))){

        $query_login = "select * from usuario WHERE binary login = '$user' && binary senha = '$pass'";

        $stmtLogin = $conexao->query($query_login);

        $resultado = $stmtLogin->fetch(PDO::FETCH_ASSOC);

        $tipo    = $resultado['tipo'];
        $id_usu  = $resultado['id'];
        
        if($resultado){
                $_SESSION['user_id'] = $id_usu;
                $_SESSION['verificado'] = true;
                $_SESSION['escola'] = $resultado['id_esc'];
                $_SESSION['tipo'] = $tipo;
                $_SESSION['nome_usuario'] = $resultado['nome'] . " " . $resultado['sobrenome'];

                header("Location: painel");
            
        }else{
            header("Location: http://localhost/sistema/index.php?login=erro");
        }
}else{
  header("Location: http://localhost/sistema/index.php?login=erro");
}
?>
 
