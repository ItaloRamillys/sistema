<?php    
function showNews($baseURL, $conn, $urlSaibaMais){

$query3 = "select * from news order by id_news desc";
$stmt3 = $conn->query($query3);

$titulo = "";
$img = "";
$desc = "";
$result = "";

while ($row = $stmt3->fetch(PDO::FETCH_NUM)) {
  $id     = $row[0];
  $titulo = $row[1];
  $slug   = $row[2];
  $desc   = $row[3];
  $user   = $row[5];

  $img_name = $row[4];
  $name_img = $img_name[0];
  $new_name_img = "http://localhost/sistema/img/" . $img_name;

  $img    = $baseURL . $row[5];

  if (strlen($desc) > 350) {

    $stringCut = substr($desc, 0, 350);
    $endPoint = strrpos($stringCut, ' ');
    $stringCut .= "...";
    $desc = $stringCut;

  }

  $query4 = "select name, last_name from user where id = {$user}";
  $stmt4  = $conn->query($query4);
  $res4 = $stmt4->fetch(PDO::FETCH_NUM);

  $usuario = $res4[0];

  if($usuario == " "){
    $usuario = "Autor Inativo";
  }

  $split_date = explode(" ", $row[6]);
  $date = getStringDate($split_date[0]);
  $result .= "
              <article class='card'>
                <div class='coluna-img'>
                  <div class='box-img'>
                    <img class='card-img-top' src='{$new_name_img}' alt='Card image cap' width='200' height='200'>
                  </div>
                  
                </div>
                <div class='coluna-texto'>
                  <div class='details-activity d-flex justify-content-around'>
                      <div>
                         <i class=' fas fa-male'></i>  {$usuario}
                      </div>
                      <div>
                         <i class='far fa-clock'></i> {$date}
                      </div>
                  </div>
                    <div class='card-body'>
                      <h2 class='card-title'>{$titulo}</h2>
                      <p class='card-text'>{$desc}</p>
                      <a href='{$urlSaibaMais}{$slug}' class='btn btn-sm btn-primary mt-2'>Ler noticia</a>
                    </div>
                  </div>
            </article>";
}

echo $result;

}
?>

