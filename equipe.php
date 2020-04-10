<?php

    require_once('proj_esc_func\conexao.php');
    $conexao = new Conexao();
    $conexao = $conexao->conectar();

?>

<div class="main-equipe" id="equipe">
			<div class="main-header-equipe text-white">
    			<div class="content-header-equipe p-md-5 px-3 pb-5 d-flex justify-content-center align-items-center flex-column">
        				
        			<header>
        				<h1>Nossa Equipe</h1>
        			</header>
        			
        			<div class="text-nossa-equipe">
        				Nossa equipe é composta por profisisonais altamente qualificados, competentes, responsáveis e que, acima de tudo, amam o que fazem.
        			</div>

    			</div>
    		</div>

        	<section class="container container-content-equipe p-3">
        		<div class="row">
                    
        		<?php 
        	
        		//SETANDO AS CONFIGURAÇÕES DA PAGINA EQUIPE
				$query = "select a.nome, a.sobrenome, a.img_profile, b.descricao from usuario a inner join complemento_prof b on a.tipo = 1 and a.id = b.id_usu group by b.cod_prof";
				$stmt  = $conexao->query($query);
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

					$nome = $row['nome'];
					$sobrenome = $row['sobrenome'];
					$img_prof = "img/" . $row['img_profile'];
                    $desc = $row['descricao'];

					echo "<div class='container-box2 p-2'>
                            <article class='box-dados-usu p-3'>
                            <img src='{$img_prof}'>
                            <p class='h4 p-3'>{$nome} {$sobrenome}</p>
                            <p>{$desc}</p>
                        </article>
                        </div>";
				}

        		?>
                </div>

        	</section>
</div>