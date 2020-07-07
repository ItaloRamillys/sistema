<?php
require(__DIR__."/painel/functions.php");
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

            $r_img = explode(".", $row['img_profile']);
            $name_img = $r_img[0];
            $img_resized = $name_img."_200x200.".$r_img[1];

            $img = render_img(__DIR__."/img/".$row['img_profile'], "http://localhost/sistema/img/".$img_resized, "http://localhost/sistema/img/padrao/img-profile-default_200x200.jpg", 'img-fluid');
            $desc = $row['descricao'];

			echo "<article class='box-dados-prof p-3'>
                    <div class='box-dados-prof-img'>
                        {$img}
                    </div>
                    <div class='box-dados-prof-text'>
                        <div class='box-dados-prof-name'>
                            <p class='h4 p-3'>{$nome} {$sobrenome}</p>
                        </div>
                        <div class='box-dados-prof-desc'>
                            <p>{$desc}</p>
                        </div>
                    </div>
                </article>
                ";
		}
		?>
        </div>
    </section>
</div>