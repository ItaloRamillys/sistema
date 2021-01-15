<?php
    require_once('news.php');
?>
<div class="main-equipe" id="escola">
	<div class="main-header-equipe text-white">
		<div class="content-header-equipe p-md-5 px-3 pb-5 d-flex justify-content-center align-items-center flex-column">
			<header>
				<h1>A Escola</h1>
			</header>
			
			<div class="text-nossa-equipe">
				A Escola XPTO é Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			</div>
		</div>
	</div>
	<section class="container container-content-equipe py-4">
        <p class="display-4 text-center">Saiba tudo que ocorre em nossa escola</p>
		<div class="col-12">
          <div class="row">
            <?php showNews('http://localhost/sistema/img/', $conn, 'http://localhost/sistema/noticias_visitante.php?slug_news=') ?>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
  $(window).bind('scroll', function () {
    if ($(window).scrollTop() > 100) {
        $('.navbar').removeClass('navbar-transparent');
          $('.nav-item').addClass('nav-item-2');
    } else {
        $('.navbar').addClass('navbar-transparent');
         $('.nav-item').removeClass('nav-item-2');
    }
  });
</script>