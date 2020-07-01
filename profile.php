<?php 

	$nome_usu = ($_SESSION['nome_usuario']);
    	
    require_once('proj_esc_func\conexao.php');

    $conexao = new Conexao();

    $conexao = $conexao->conectar();

    $query_profile = "select * from config";
    $stmt_profile  = $conexao->query($query_profile);
    $row_menu = $stmt_profile->fetch(PDO::FETCH_NUM);
    $titulo    = $row_menu[0];

    $genre = $_SESSION['genre'];

    if($genre == "f" || $genre == "F"){
        $genre = "a ";
    }
    if($genre == "m" || $genre == "M"){
        $genre = "o ";
    }

	$final = "<header class='top container-fluid'>
			    <div class='row' id='row-top'>
				    <div class='col-md-5 col-12 d-flex align-items-center justify-content-center justify-content-md-start'>
                    	<header><h1  class='logo-text'>{$titulo}</h1></header>
            	    </div>

				    <div class=' col-md-7 col-12'>
                        
                        <div class='row' id='container-msg-top'>
                            <div class='col-11' id='msg-welcome'>Seja bem vind{$genre}<strong> " . $nome_usu . " </strong></div>
    					    <div class='col-1'>
                                <a href='http://localhost/sistema/exit.php' class='btn btn-danger rounded btn-sm text-light'><i class='fas fa-sign-out-alt'></i></a>
                            </div>
                        </div>

                    </div>
                </div>
   			</header>";

	echo $final;

?>
	
