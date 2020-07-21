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
		$query = "select a.name, a.last_name, a.img_profile, b.description from user a inner join adjunct_teacher b on a.type = 1 and a.id = b.id_user group by a.name, a.last_name";
		$stmt  = $conn->query($query);
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

			$name = $row['name'];
			$last_name = $row['last_name'];

            $r_img = explode(".", $row['img_profile']);
            $name_img = $r_img[0];

            $img = render_img(__DIR__."/img/".$row['img_profile'], "http://localhost/sistema/img/".$name_img, "http://localhost/sistema/img/padrao/img-profile-default_200x200.jpg", 'img-fluid');
            $desc = $row['description'];

			echo "<article class='box-dados-prof p-3'>
                    <div class='box-dados-prof-img'>
                        {$img}
                    </div>
                    <div class='box-dados-prof-text'>
                        <div class='box-dados-prof-name'>
                            <p class='h4 p-3'>{$name} {$last_name}</p>
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