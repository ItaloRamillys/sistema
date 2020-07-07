<?php 
    require_once('proj_esc_func\connection.php');
    $typeconn = new Connection();
    $typeconn = $typeconn->connect();

    $query_profile = "select * from config";
    $stmt_profile  = $typeconn->query($query_profile);
    $row_menu = $stmt_profile->fetch(PDO::FETCH_NUM);
    $title    = $row_menu[0];

    $genre = $_SESSION['genre'];
    $user_name = $_SESSION['user_name'];

    if($genre == "f" || $genre == "F"){
        $genre = "a";
    }
    if($genre == "m" || $genre == "M"){
        $genre = "o";
    }

	$final = "<header class='top container-fluid'>
			    <div class='row' id='row-top'>
				    <div class='col-md-5 col-12 d-flex align-items-center justify-content-center justify-content-md-start'>
                    	<header><h1 class='logo-text'>{$title}</h1></header>
            	    </div>

				    <div class=' col-md-7 col-12'>
                        
                        <div class='row' id='container-msg-top'>
                            <div class='col-md-11 col-12' id='msg-welcome'>Seja bem vind{$genre} {$user_name} </div>
    					    <div class='col-md-1 col-12'>
                                <a href='http://localhost/sistema/exit.php' class='btn rounded btn-sm'><i class='fas fa-sign-out-alt'></i></a>
                            </div>
                        </div>

                    </div>
                </div>
   			</header>";
	echo $final;
?>
	
