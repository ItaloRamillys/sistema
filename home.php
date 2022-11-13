<?php
require_once('proj_esc_func\connection.php');
$conexao = new Connection();
$conexao = $conexao->connect();
//SETANDO AS CONFIGURAÇÕES DA PAGINA INICIAL
$query = "select * from config";
$stmt  = $conexao->query($query);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$titulo     = $row['title_site'];
$img_esc    = $row['img_school'];
$img1       = "img/" . $row['img_featured_1'];
$img2       = "img/" . $row['img_featured_2'];
$img3       = "img/" . $row['img_featured_3'];
$desc_esc   = $row['desc_school'];
$contato    = $row['phone_school_1'];
$local      = $row['img_local'];
$txt_img1   = $row['txt_img_1'];
$txt_img2   = $row['txt_img_2'];
$txt_img3   = $row['txt_img_3'];

$phone_school_1   = $row['phone_school_1'];
$phone_school_2   = $row['phone_school_2'];
$phone_school_3   = $row['phone_school_3'];

$p1 = substr_replace($phone_school_1, "(", 0, 0);
$p1 = substr_replace($p1, ")", 3, 0);
$p1 = substr_replace($p1, "-", 9, 0);

$p2 = substr_replace($phone_school_2, "(", 0, 0);
$p2 = substr_replace($p2, ")", 3, 0);
$p2 = substr_replace($p2, "-", 9, 0);

$p3 = substr_replace($phone_school_3, "(", 0, 0);
$p3 = substr_replace($p3, ")", 3, 0);
$p3 = substr_replace($p3, "-", 9, 0);

$count_aluno = 0;
$count_adm = 0;
$count_prof = 0;
$count_ntc = 0;

$query1 = 'select count(*) from user where type = 1';
$stmt1 = $conexao->query($query1);
$row1 = $stmt1->fetch(PDO::FETCH_NUM);
$count_prof = $row1[0];

$query2 = 'select count(*) from user where type = 0';
$stmt2 = $conexao->query($query2);
$row2 = $stmt2->fetch(PDO::FETCH_NUM);
$count_aluno = $row2[0];

$query3 = 'select count(*) from user where type = 2';
$stmt3 = $conexao->query($query3);
$row3 = $stmt3->fetch(PDO::FETCH_NUM);
$count_adm = $row3[0];

$query4 = 'select count(*) from news';
$stmt4 = $conexao->query($query4);
$row4 = $stmt4->fetch(PDO::FETCH_NUM);
$count_ntc = $row4[0];
?>
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
<script src="<?=$configBase?>/js/jquery-counter-up.js" type="text/javascript"></script>


<div id="home">
        <script>
            $('.carousel').carousel({
              interval: 4000
            });
        </script>
        <script>
            $(document).ready(function(e){
                $(".num").counterUp({delay:20,time:1500});
            });
        </script>
        <section class="head-img-back"  style="background-image: url('<?php echo 'http://localhost/sistema/img/'.$img_esc ?>')">
            <div class="head-img">
                <div class="container" id="text-head">
                    <header id="title-head">
                        <h2 class="m-auto main-text animate__animated animate__bounceInLeft"><?=$titulo?></h2>
                    </header>
                    <div id="subtitle-head">
                        <p>
                            <?= $desc_esc ?>
                        </p>
                    </div>
                </div>
                <a id="down">
                    <i class="fas fa-angle-double-down" id="arrow-down"></i>
                </a>
            </div>
        </section>

        <section class="ensino-back" id="ensino">
            <div class="ensino">
                <div class="container">
                    <div class="row justify-content-center">
                        <article class="box-card-ensino animate" data-animate="animate__bounceInLeft">
                            <div class="card-ensino">
                                <span><i class="fas fa-chalkboard-teacher"></i></span>
                                <header>
                                    <h5>Ensino de qualidade</h5>
                                </header>
                                <div class="desc-ensino">
                                    O projeto pedagógico oferecido pela escola é claro e apresenta uma identidade única. Ele denota a filosofia da nossa instituição e reflete o conhecimento transmitido.
                                </div>
                            </div>
                        </article>
                        <article class="box-card-ensino animate" data-animate="animate__bounceInUp">
                            <div class="card-ensino">
                                <span><i class="fas fa-school"></i></span>
                                <header>
                                    <h5>Ambiente agradável</h5>
                                </header>
                                <div class="desc-ensino">
                                    Temos um ambiente emocional favorável, para que haja um bom relacionamento entre todas as pessoas envolvidas na dia-a-dia escolar.
                                </div>
                            </div>
                        </article>
                        <article class="box-card-ensino animate" data-animate="animate__bounceInRight">
                            <div class="card-ensino">
                                <span><i class="fas fa-user-graduate"></i></span>
                                <header>
                                    <h5>Profissionais qualificados</h5>
                                </header>
                                <div class="desc-ensino">
                                    Incentivamos nossos colaboradores  a aprimorarem seus conhecimentos e buscarem cada vez mais aumentar sua qualificação
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        <section class="escola-back">
            <div class="container-fluid escola">
                <div class="escola-desc">

                    <div class="row">
                        <header><h2 class="main-text">A <?php echo $titulo; ?></h2></header>
                    </div>
                    
                    <div class="info-escola row justify-content-center align-items-center my-4">
                        <div class="col-md-7 col-12">
                            <video id="video" class="" controls>
                                <source src="img/padrao/video.mp4" type="video/mp4">
                            </video>
                        </div>

                        <div id="desc-school" class="col-md-4 col-12 my-sm-4">
                        
                                <?= $desc_esc ?>
                            
                        </div>
                    </div>
                </div>
        </section>
    
        <section class="niveis">
            <div class="container text-center">
                <header>
                    <h2 class="main-text">Cursos</h2>
                </header>

                <article class="row box-div box-niveis-1 animate" data-animate="animate__bounceInLeft" id="box-niveis-1">

                    <div class="col-md-6 col-sm-12 c-text">
                        <header><h3 class="main-text-internal text-center">Ciência da Computação</h3></header>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,  totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architectoSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudan</p>
                    </div>
                    <div class="col-md-6 col-sm-12 c-img">
                        <img src="img/padrao/child.jpg" id="img-niveis-1" class="img-fluid">
                    </div>
                    
                </article>

                <article class="row d-flex flex-row-reverse box-div animate" data-animate="animate__bounceInRight" id="box-niveis-2">
                    
                    <div class="col-md-6 col-sm-12 c-text">
                        <header><h3 class="main-text-internal text-center">Segurança da Informação</h3></header>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,  totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architectoSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudan</p>
                    </div>
                    <div class="col-md-6 col-sm-12 c-img">
                        <img src="img/padrao/fund-1.jpg" id="img-niveis-2" class="img-fluid">
                    </div>
                    
                </article>

                <article class="row box-div animate" data-animate="animate__bounceInLeft" id="box-niveis-3">

                    <div class="col-md-6 col-sm-12 c-text">
                        <header><h3 class="main-text-internal text-center">Engenharia de Software</h3></header>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,  totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architectoSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudan</p>
                    </div>
                    <div class="col-md-6 col-sm-12 c-img">
                        <img src="img/padrao/fund-2.png" id="img-niveis-3" class="img-fluid" style="background-color: #EEE;">
                    </div>
                    
                </article>
            </div>
        </section>
            
        <section id="number-our-school">
            <div id="number-our-school-inside">
                <div class="col-12 py-2">
                    <div class="row justify-content-center align-items-center">
                        <h2 class="main-text">Uma Faculdade conectada</h2>
                    </div>
                    <div class="row justify-content-center pb-3">
                        <div id="desc-our-number">
                            Nosso sistema exclusivo permite que pais e alunos estejam sempre conectados com os acontecimentos
                            escolares. É possível acompanhar o desempenho do aluno, frequência, atividades, notícias e muito mais.
                        </div>
                    </div>
                </div>
                <div class="col-12" id="escola-counter">
                    <div class="row p-3 rounded" id="info-escola-counter">
                            <div class="counter-box col-md-3 col-6 my-2 animate" data-animate="animate__bounceInUp">
                                <div class="counter" id="counter-teacher">
                                  <i class="fas fa-chalkboard-teacher"></i>
                                  Professores
                                  <div class="num"><?= $count_prof ?></div>
                                </div>
                            </div>
                            <div class="counter-box col-md-3 col-6 my-2 animate" data-animate="animate__bounceInDown">
                                <div class="counter" id="counter-student">
                                  <i class="fas fa-user-graduate"></i>
                                  Alunos
                                  <div class="num"><?= $count_aluno ?></div>
                                </div>
                            </div>
                            <div class="counter-box col-md-3 col-6 my-2 animate" data-animate="animate__bounceInUp">
                                <div class="counter" id="counter-adm">
                                  <i class="fas fa-users"></i>
                                  Administradores
                                  <div class="num"><?= $count_adm ?></div>
                                </div>
                            </div>
                            <div class="counter-box col-md-3 col-6 my-2 animate" data-animate="animate__bounceInDown">
                                <div class="counter" id="counter-news">
                                  <i class="far fa-calendar-alt"></i>
                                  Notícias
                                  <div class="num"><?= $count_ntc ?></div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="box-slide-back">
            <div class="container-fluid" id="box-slide">
                <div class="row">
                    
                <div class="col-md-5 col-12">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div class="col">
                            <h2 class="main-text">O que acontece em nossa faculdade</h2>
                            <p class="subtitulo-slide">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-12 p-4">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                      </ol>
                      <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img class="" src="<?= $img1 ?>" alt="First slide">
                            
                            <div class="text">
                                <span><?= $txt_img1 ?></span>
                            </div>
                        </div>
                        <div class="carousel-item">
                          <img class="" src="<?= $img2 ?>" alt="Second slide">
                          <div class="text">
                                <span><?= $txt_img2 ?></span>
                            </div>
                        </div>
                        <div class="carousel-item">
                          <img class="" src="<?= $img3 ?>" alt="Third slide">
                          <div class="text">
                                <span><?= $txt_img3 ?></span>
                            </div>>
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                </div>        
                </div>
            </div>
        </div>      

        <section class="footer-back">
            <div class="footer">
                <div class="container container-footer">
                    <div class="row">
                        <div class="col-md-2 col-6">
                            <header>
                                <h2 class="main-text-internal-footer">Contato</h2>
                            </header>
                            <ul>
                                <li>
                                    <?= $p1 ?>
                                </li>
                                <li>
                                    <?= $p2 ?>
                                </li>
                                <li>
                                    <?= $p3 ?>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-3 col-6">
                            <header>
                                <h2 class="main-text-internal-footer">Acesso Rápido</h2>
                            </header>
                            <ul>
                                <li>
                                    <a href="">Link</a>
                                </li>
                                <li>
                                    <a href="">Link</a>
                                </li>
                                <li>
                                    <a href="">Link</a>
                                </li>
                            </ul>
                        </div>

                        <div class="col-md-3 col-6">
                            <header>
                                <h2 class="main-text-internal-footer">Acesso Rápido</h2>
                            </header>
                            <ul>
                                <li>
                                    <a href="">Link</a>
                                </li>
                                <li>
                                    <a href="">Link</a>
                                </li>
                                <li>
                                    <a href="">Link</a>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="col-md-4 col-12" style="height:300px;">

                            <header class="col-12">
                                <h2 class="main-text-internal-footer">Onde estamos</h2>
                            </header>

                            <div id='map' style='width: 100%; height: 200px;'></div>
                            <script>

                            mapboxgl.accessToken = 'pk.eyJ1IjoiaXRhbG9kYWZlaXJhIiwiYSI6ImNrNnBsM3A1djFsOWEza3FweDdndnhyenkifQ.X7_NLRTjryFG2CHxPMTtkg';
                            var map = new mapboxgl.Map({
                                container: 'map',
                                style: 'mapbox://styles/mapbox/streets-v11',
                                center: [-38.3051362, -4.0364328],
                                zoom: 10
                            });
                            map.on('load', function() {
                            map.addSource('places', {
                            'type': 'geojson',
                            'data': {
                            'type': 'FeatureCollection',
                            'features': [
                            {
                            'type': 'Feature',
                            'properties': {
                            'description':
                            '<strong>Clique aqui</strong><p><a href="#" target="_blank" title="Opens in a new window">Aqui estamos, venha conhecer</a></p>',
                            'icon': 'theatre'
                            },
                            'geometry': {
                            'type': 'Point',
                            'coordinates': [-38.3051362, -4.0364328]
                            }
                            },
                            ]
                            }
                            });
                            // Add a layer showing the places.
                            map.addLayer({
                            'id': 'places',
                            'type': 'symbol',
                            'source': 'places',
                            'layout': {
                            'icon-image': '{icon}-15',
                            'icon-allow-overlap': true
                            }
                            });
                             
                            // When a click event occurs on a feature in the places layer, open a popup at the
                            // location of the feature, with description HTML from its properties.
                            map.on('click', 'places', function(e) {
                            var coordinates = e.features[0].geometry.coordinates.slice();
                            var description = e.features[0].properties.description;
                             
                            // Ensure that if the map is zoomed out such that multiple
                            // copies of the feature are visible, the popup appears
                            // over the copy being pointed to.
                            while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                            coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                            }
                             
                            new mapboxgl.Popup()
                            .setLngLat(coordinates)
                            .setHTML(description)
                            .addTo(map);
                            });
                             
                            // Change the cursor to a pointer when the mouse is over the places layer.
                            map.on('mouseenter', 'places', function() {
                            map.getCanvas().style.cursor = 'pointer';
                            });
                             
                            // Change it back to a pointer when it leaves.
                            map.on('mouseleave', 'places', function() {
                            map.getCanvas().style.cursor = '';
                            });
                            });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
<script>
    $("#down").click(function(e){
        $("html, body").animate({ scrollTop: 601 });
    });
</script>
<script type="text/javascript">
  $(window).bind('scroll', function () {
    if ($(window).scrollTop() > 600) {
        $('.navbar').removeClass('navbar-transparent');
          $('.nav-item').addClass('nav-item-2');
    } else {
        $('.navbar').addClass('navbar-transparent');
         $('.nav-item').removeClass('nav-item-2');
    }
  });
</script>

