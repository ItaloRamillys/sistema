<?php 
include_once("conexao.php"); 

if((isset($_POST['user'])) && (isset($_POST['pass']))){
        $usu = mysqli_real_escape_string($mysqli, $_POST['user']); 
        //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
        $senha = mysqli_real_escape_string($mysqli, $_POST['pass']);
        //$senha = md5($senha);

        $result_usuario     = "SELECT * FROM usuario WHERE binary login = '$usu' && binary senha = '$senha' LIMIT 1";
        $resultado_usuario  = mysqli_query($mysqli, $result_usuario);
        $resultado          = mysqli_fetch_assoc($resultado_usuario);
        $tipo               = $resultado['tipo'];
        $id_usu             = $resultado['id'];
  		
        session_start();

        $_SESSION['r'] = $resultado;

        if(isset($resultado)){

            $_SESSION['user_id'] = $id_usu;

            $result_escola      = "SELECT nome FROM escola WHERE id_esc = ". $resultado['id_esc'] ." LIMIT 1";
            $resultado_escola   = mysqli_query($mysqli, $result_escola);
            $row_escola         = mysqli_fetch_assoc($resultado_escola);
                
            //SESSOES IMPORTANTES [bool login, id_esc, nome_esc, id_usu, tipo_usu]
            $_SESSION['authentic'] = 'YES';
            $_SESSION['escola'] = $resultado['id_esc'];
            $_SESSION['nome_escola'] = $row_escola['nome'];
            $_SESSION['tipo'] = $tipo;
            $_SESSION['nome_usuario'] = $resultado['nome'] . " " . $resultado['sobrenome'];

            header("Location: painel");

        }else{
                $_SESSION['authentic'] = 'NO';
                header("Location: index.php?login=erro");
        }
}
?>
 
