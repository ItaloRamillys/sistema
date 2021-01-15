<style type="text/css">
    .animate{
        opacity: 0 !important;
    }
    .animate__animated{
        transition: 0.4s;
        animation-duration: 1.5s;
        opacity: 1 !important;
    }
</style>
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

	<section class="container">

            
		<?php 
		//SETANDO AS CONFIGURAÇÕES DA PAGINA EQUIPE
		$query = "select a.name, a.last_name, a.img_profile, b.description from user a inner join adjunct_teacher b on a.type = 1 and a.id = b.id_user group by a.name, a.last_name";
		$stmt  = $conn->query($query);

		$anime_to_r_l = 'animate__bounceInLeft';

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

			$name = $row['name'];
			$last_name = $row['last_name'];

            $img = render_img(__DIR__."/img/".$row['img_profile'], "http://localhost/sistema/img/".$row['img_profile'], "http://localhost/sistema/img/padrao/img-profile-default_200x200.jpg", null, 'rounded-circle img-teacher', 200, 200);
            $desc = $row['description'];

			echo "<div class='row box-data-teacher animate'  data-animate='{$anime_to_r_l}'>
                    <div class='col-6 box-dados-prof-img'>
                    	<div class='row justify-content-center align-items-center'>
                        	{$img}
                    	</div>
                    </div>
                    <div class='col-6 box-dados-prof-text'>
                    	<div class='row justify-content-center align-items-center'>
	                        <div class='box-dados-prof-name'>
	                            <p class='h4 p-3'>{$name} {$last_name}</p>
	                        </div>
	                        <div class='box-dados-prof-desc'>
	                            <p>{$desc}</p>
	                        </div>
                        </div>
                    </div>
                </div>
                ";

            $anime_to_r_l = $anime_to_r_l == 'animate__bounceInLeft' ? "animate__bounceInRight" : "animate__bounceInLeft";
		}
		?>

    </section>
</div>
<script type="text/javascript">
  $(window).bind('scroll', function () {
    if ($(window).scrollTop() > 50) {
        $('.navbar').removeClass('navbar-transparent');
          $('.nav-item').addClass('nav-item-2');
    } else {
        $('.navbar').addClass('navbar-transparent');
         $('.nav-item').removeClass('nav-item-2');
    }
  });
</script>