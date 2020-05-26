<?php 
session_start();
include_once("proj_esc_func/conexao.php"); 

$conexao = new Conexao();

$conexao = $conexao->conectar();

if((isset($_POST['user'])) && (isset($_POST['pass']))){
        $usu = $_POST['user']; 
        //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
        $senha = $_POST['pass'];
        //$senha = md5($senha);

        $query_login = "select * from usuario WHERE binary login = '$usu' && binary senha = '$senha'";

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
}
?>
 
