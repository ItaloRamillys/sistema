﻿<?php 
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
  		
        
        if(isset($resultado)){

            $query_login2 = "SELECT nome FROM escola WHERE id_esc = ". $resultado['id_esc'] ." LIMIT 1";

            $stmtLogin2 = $conexao->query($query_login2);

            $resultado2 = $stmtLogin2->fetchAll(PDO::FETCH_ASSOC);
        
        }

        if(isset($resultado2)){  

            $_SESSION['user_id'] = $id_usu;
            //SESSOES IMPORTANTES [bool login, id_esc, nome_esc, id_usu, tipo_usu]
            $_SESSION['verificado'] = true;
            $_SESSION['escola'] = $resultado['id_esc'];
            $_SESSION['nome_escola'] = $resultado2['nome'];
            $_SESSION['tipo'] = $tipo;
            $_SESSION['nome_usuario'] = $resultado['nome'] . " " . $resultado['sobrenome'];

            header("Location: painel");

        }else{
            
            header("Location: http://localhost/sistema/index.php?login=erro");
        
        }
}
?>
 
