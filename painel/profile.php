<?php 
	$user_name = ($_SESSION['user_name']);

	$final = "<header class='top'>
                 		<div class='container-top pl-3 py-1'>
        				    <div class='row' style='width: 100%;'>
            				    <div class='col-md-5 col-sm-6 col-xs-12 d-flex align-items-center justify-content-center justify-content-md-start'>
                                	<header><h1  class='logo-text'>{$titulo}</h1></header>
                        	    </div>

            				    <div class='data-list-student col-md-7 col-sm-6 col-xs-12'>
                                  
                                    <div class='msg-welcome'>Seja bem vindo <strong>". $user_name . "</strong>
                                    </div>
            					    <a href='http://localhost/sistema/exit.php' class='btn btn-danger rounded btn-sm ml-3 text-light'><i class='fas fa-sign-out-alt'></i></a>
                            
                                </div>
                            </div>
                        </div>
   				</header>
            ";
	echo $final;

?>
	
