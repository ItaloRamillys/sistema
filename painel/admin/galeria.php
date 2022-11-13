<?php
  $galeria = 'C:/xampp/htdocs/sistema/img';

  //Capturando todos os arquivos que estão em img
  $array_push = [];
  function recursionScan($path){
    global $galeria;
    global $array_push;
    $internal_dir = scandir($path);
    foreach ($internal_dir as $key => $value) {
      $aux = $value;
      $value = $path . "/" . $value;
      if(is_dir($value) && $aux != "." && $aux != ".."){
          recursionScan($value);
      }elseif($aux != "." && $aux != ".."){
        array_push($array_push, str_replace($galeria."/", "", $value));
      }
    }
    return $array_push;
  }

  $images = recursionScan($galeria);

  $query_usu_img  = "select name, img_profile from user";
  $query_news_img = "select title_news, img_news from news";
  $query_config_img = "select img_school, img_featured_1, img_featured_2, img_featured_3 from config";

  $stmt_usu = $conn->query($query_usu_img);
  while($row_usu = $stmt_usu->fetch(PDO::FETCH_NUM)){
    $array_img[] = $row_usu[0];
  }

  $stmt_news = $conn->query($query_news_img);
  while($row_news = $stmt_news->fetch(PDO::FETCH_NUM)){
    $array_img[] = $row_news[0];
  }
  
  $stmt_config = $conn->query($query_config_img);
  while($row_config = $stmt_config->fetch(PDO::FETCH_NUM)){
    $array_img[] = $row_config[0];
    $array_img[] = $row_config[1];
    $array_img[] = $row_config[2];
  }

?>

<link href="../css/page_config.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="../js/delete_img.js"></script>

<div class="container">
  <div class="row">
    <div class="col-12">
      <div class="box">
        <header class="div-title-box">
         <h1 class="title-box-main  d-flex justify-content-center">Galeria do Site</h1>
        </header>

        <div class="div-content-box">
          <div class="container">
            <div class="row">
              <div id="msg_delete" class="alert alert-primary col-12 my-2" style="display: none;"></div>
	       <?php 

          $result = "";

            foreach ($array_push as $key => $value) {

              if ($value != '.' && $value != '..' && (strpos($value, '.jpg') || strpos($value, '.png') || strpos($value, '.gif') || strpos($value, '.jpeg'))){
                
                $split_img_path = explode("/",$value);
                if (in_array($value, $array_img) || $split_img_path[0] == "sistema") {

                  $result .= "<div class='container-box' id='" . base64_encode($key) . "'>
                            <div class='box-dados-usu'>Origem da imagem: <strong>
                              ".ucfirst($split_img_path[0])."</strong>
                              <div class='container'>
                                <div class='row justify-content-center align-items-center'>
                                  <div class='col-12'>
                                    <img class='img-gallery-adapt' width='100%' style='max-height:200px'  src='http://localhost/sistema/img/{$value}'>
                                  </div>";
                              
                  $result .= "<p class='col-10 alert alert-success p-1 my-2 text-center' style='font-size: 14px;'> Imagem em uso no sistema </p>";
                }else{
                  $result .= "<div class='container-box' id='" . $key . "'>
                            <div class='box-dados-usu'>Origem da imagem: <strong>
                              ".ucfirst($split_img_path[0])."</strong>
                              <div class='container'>
                                <div class='row justify-content-center align-items-center'>
                                  <div class='col-12'>
                                    <img class='img-gallery-adapt' width='100%' style='max-height:200px' src='http://localhost/sistema/img/{$value}'>
                                  </div>";
                  $result .= "<p class='col-10 alert alert-danger p-1 my-2 text-center' style='font-size: 14px;'> Imagem não utilizada</p>
                  <button class='btn btn-danger text-light btn-sm my-2' onclick=\"delete_img('../img/$value',{$key})\">Deletar imagem</button>";
                }

                $result .= "
                              </div>
                              </div>
                            </div>
                          </div>";
                }


              }
                echo $result;
         ?>

            </div>                
          </div>
        </div>
      </div>
    </div>
  </div>
</div>          
  
<script type="text/javascript">
  var max = 0;
  var imgs = document.getElementsByClassName('img-gallery-adapt');
  var len = imgs.length;
  
  window.onload = function resizeImg(){
    for(var i = 0; i < len; i++){
      if(imgs[i].offsetHeight > max){
        max = imgs[i].offsetHeight;
      }
    }
    for(var i = 0; i < len; i++){
      document.getElementsByClassName('img-gallery-adapt')[i].style.height = max+"px";
    }
  };

  windows.resize = function resizeImgR(){
    for(var i = 0; i < len; i++){
      document.getElementsByClassName('img-gallery-adapt')[i].style.height = max+"px";
    }
  }
</script>
