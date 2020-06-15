<?php
require_once('proj_esc_func\conexao.php');
$conexao = new Conexao();
$conexao = $conexao->conectar();
//SETANDO AS CONFIGURAÇÕES DA PAGINA INICIAL
$query = "select * from config";
$stmt  = $conexao->query($query);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$titulo     = $row['titulo_site'];
$img_esc    = $row['img_escola'];
$img1       = "img/" . $row['img_dest1'];
$img2       = "img/" . $row['img_dest2'];
$img3       = "img/" . $row['img_dest3'];
$desc_esc   = $row['desc_esc'];
$contato    = $row['contato'];
$local      = $row['img_local'];
$txt_img1   = $row['txt_img1'];
$txt_img2   = $row['txt_img2'];
$txt_img3   = $row['txt_img3'];

$count_aluno = 0;
$count_adm = 0;
$count_prof = 0;
$count_ntc = 0;

$query1 = 'select count(*) from usuario where tipo = 1';
$stmt1 = $conexao->query($query1);
$row1 = $stmt1->fetch(PDO::FETCH_NUM);
$count_prof = $row1[0];

$query2 = 'select count(*) from usuario where tipo = 0';
$stmt2 = $conexao->query($query2);
$row2 = $stmt2->fetch(PDO::FETCH_NUM);
$count_aluno = $row2[0];

$query3 = 'select count(*) from usuario where tipo = 2';
$stmt3 = $conexao->query($query3);
$row3 = $stmt3->fetch(PDO::FETCH_NUM);
$count_adm = $row3[0];

$query4 = 'select count(*) from noticia';
$stmt4 = $conexao->query($query4);
$row4 = $stmt4->fetch(PDO::FETCH_NUM);
$count_ntc = $row4[0];
?>
<div id="home">
        <script>
            $('.carousel').carousel({
              interval: 4000
            });
        </script>
        <script> 
            $(".num").counterUp({delay:20,time:1500});
        </script>
        
        <section class="head-img-back"  style="background-image: url('<?php echo 'http://localhost/sistema/img/'.$img_esc ?>')">
            <div class="head-img">
                <div class="container">
                    <header class="row" id="titulo-head" >
                        <h2 class="ml-auto main-text"><?=$titulo?></h2>
                    </header>
                    <div class="row ml-auto" id="subtitulo-head">
                        <p>
                            <?= $desc_esc ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="ensino-back">
            <div class="ensino">
                <div class="row">
                    <article class="card-ensino anime">
                        <span><i class="fas fa-chalkboard-teacher"></i></span>
                        <header>
                            <h5>Ensino de qualidade</h5>
                        </header>
                        <div class="desc-ensino">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto</div>
                    </article>
                    <article class="card-ensino anime">
                        <span><i class="fas fa-school"></i></span>
                        <header>
                            <h5>Ambiente agradável</h5>
                        </header>
                        <div class="desc-ensino">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto</div>
                    </article>
                    <article class="card-ensino anime">
                        <span><i class="fas fa-user-graduate"></i></span>
                        <header>
                            <h5>Profissionais qualificados</h5>
                        </header>
                        <div class="desc-ensino">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto</div>
                    </article>
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
        <!--Slide sem Bootstrap

            <div class="slide-section m-0 mw-100 container">
                <section class="row">

                <div class="col-12 slideshow-container">

                    <div class="mySlides fade" style="display: block;">
                        <div class="numbertext">1 / 3</div>
                        <img src="<?= $img1 ?>">
                        <div class="text"><?= $txt_img1 ?></div>
                    </div>

                    <div class="mySlides fade" style="display: none;">
                        <div class="numbertext">2 / 3</div>
                        <img src="<?= $img2 ?>">
                        <div class="text"><?= $txt_img2 ?></div>
                    </div>

                    <div class="mySlides fade" style="display: none;">
                        <div class="numbertext">3 / 3</div>
                        <img src="<?= $img3 ?>">
                        <div class="text"><?= $txt_img3 ?></div>
                    </div>

                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>

                </div>

                

                <div class="dots col-12" style="text-align:center">
                    <span class="dot" onclick="currentSlide(1)"></span> 
                    <span class="dot" onclick="currentSlide(2)"></span> 
                    <span class="dot" onclick="currentSlide(3)"></span> 
                </div>

                <style type="text/css">
                .fade:not(.show) {
                opacity: 1;
                }
                </style>

                </section>
            </div>
        -->

            
            <section class="niveis">
                <header><h2 class="main-text">Níveis de Ensino</h2></header>

                <article class="row box-div anime" id="box-niveis-1">

                    <div class="col-md-6 col-sm-12 c-text">
                        <header><h3 class="main-text-internal text-center">Infantil 1</h3></header>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,  totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architectoSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudan</p>
                    </div>
                    <div class="col-md-6 col-sm-12 c-img">
                        <img src="img/padrao/child.jpg" id="img-niveis-1" class="img-fluid">
                    </div>
                    
                </article>

                <article class="row d-flex flex-row-reverse box-div anime" id="box-niveis-2">
                    
                    <div class="col-md-6 col-sm-12 c-text">
                        <header><h3 class="main-text-internal text-center">Fundamental 1</h3></header>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,  totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architectoSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudan</p>
                    </div>
                    <div class="col-md-6 col-sm-12 c-img">
                        <img src="img/padrao/fund-1.jpg" id="img-niveis-2" class="img-fluid">
                    </div>
                    
                </article>

                <article class="row box-div anime" id="box-niveis-3">

                    <div class="col-md-6 col-sm-12 c-text">
                        <header><h3 class="main-text-internal text-center">Fundamental 2</h3></header>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,  totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architectoSed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudan</p>
                    </div>
                    <div class="col-md-6 col-sm-12 c-img">
                        <img src="img/padrao/fund-2.png" id="img-niveis-3" class="img-fluid" style="background-color: #EEE;">
                    </div>
                    
                </article>
            </section>
            
            <section id="number-our-school">
                <div id="number-our-school-inside">
                    <div class="container py-2">
                        <div class="row justify-content-center align-items-center">
                            <h2 class="main-text">Uma escola conectada</h2>
                        </div>
                        <div class="row justify-content-center pb-5">
                            <div id="desc-our-number">
                                Nosso sistema exclusivo permite que pais e alunos estejam sempre conectados com os acontecimentos
                                escolares. É possível acompanhar o desempenho do aluno, frequência, atividades, notícias e muito mais.
                            </div>
                        </div>
                    </div>
                    <div class="container" id="escola-counter">
                        <div class="row p-3 rounded" id="info-escola-counter">
                                <div class="counter-box col-md-3 col-12  my-2">
                                    <div class="counter anime" id="counter-teacher">
                                      <i class="fas fa-chalkboard-teacher"></i>
                                      Professores
                                      <div class="num"><?= $count_prof ?></div>
                                    </div>
                                </div>
                                <div class="counter-box col-md-3 col-12 my-2">
                                    <div class="counter anime" id="counter-student">
                                      <i class="fas fa-user-graduate"></i>
                                      Alunos
                                      <div class="num"><?= $count_aluno ?></div>
                                    </div>
                                </div>
                                <div class="counter-box col-md-3 col-12 my-2">
                                    <div class="counter anime" id="counter-adm">
                                      <i class="fas fa-users"></i>
                                      Administradores
                                      <div class="num"><?= $count_adm ?></div>
                                    </div>
                                </div>
                                <div class="counter-box col-md-3 col-12 my-2">
                                    <div class="counter anime" id="counter-news">
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
                                <h2 class="main-text">O que acontece em nossa escola</h2>
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

            <section class="contato-back">
                <div class="contato">
                    <div class=" container container-contato">
                        <div class="row">
                            <div class="col-md-4 col-12 c-text">
                                <header>
                                    <h2 class="main-text-internal">Contato</h2>
                                </header>
                                <ul>
                                    <li>
                                        (85)3375-XXXX
                                    </li>
                                    <li>
                                        (85)3375-XXXX
                                    </li>
                                    <li>
                                        (85)3375-XXXX
                                    </li>
                                </ul>
                            </div>

                            <div class="col-md-4 col-12 c-text">
                                <header>
                                    <h2 class="main-text-internal">Acesso Rápido</h2>
                                </header>
                                <ul>
                                    <li>
                                        <a href="">LINKS</a>
                                    </li>
                                    <li>
                                        <a href="">LINKS</a>
                                    </li>
                                    <li>
                                        <a href="">LINKS</a>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="col-md-4 col-12" style="height:300px;">

                                <header class="col-12">
                                    <h2 class="main-text-internal">Onde estamos</h2>
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
<script src="<?=$configBase?>/js/jquery-counter-up.js" type="text/javascript"></script>
<script src="<?=$configBase?>/js/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="<?=$configBase?>/js/animate.js" type="text/javascript"></script>

