<?php 
	$nome_usu = ($_SESSION['nome_usuario']);
	$escola = ($_SESSION['nome_escola']);
    	
    require_once('proj_esc_func\conexao.php');

    $conexao = new Conexao();

    $conexao = $conexao->conectar();


    $query_profile = "select * from config";
    $stmt_profile  = $conexao->query($query_profile);
    $row_menu = $stmt_profile->fetch(PDO::FETCH_NUM);
    $titulo    = $row_menu[0];

	$final = "<header class='top'>
                 		<div class='container-top pl-3 py-1'>
        				    <div class='row' style='width: 100%;'>
            				    <div class='col-md-5 col-sm-6 col-xs-12 d-flex align-items-center justify-content-center justify-content-md-start'>
                                	<header><h1  class='logo-text'>{$titulo}</h1></header>
                        	    </div>

            				    <div class='data-list-student col-md-7 col-sm-6 col-xs-12'>
                                  
                                    <div class='msg-welcome'>Seja bem vindo <strong>". $nome_usu . "</strong>
                                    </div>
            					    <a href='../exit.php' class='btn btn-danger rounded btn-sm ml-3 text-light'>SAIR</a>
                            
                                </div>
                            </div>
                        </div>
   				</header>
            ";

	echo $final;
	
