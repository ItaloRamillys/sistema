<?php    
function showNews($baseURL, $conexao, $urlSaibaMais){

$query3 = "select * from noticia order by id_ntc desc";
$stmt3 = $conexao->query($query3);

$titulo = "";
$img = "";
$desc = "";
$result = "";

while ($row = $stmt3->fetch(PDO::FETCH_NUM)) {
  $id     = $row[0];
  $titulo = $row[1];
  $slug   = $row[2];
  $desc   = $row[3];
  $usu    = $row[4];
  $img    = $baseURL . $row[5];

  if (strlen($desc) > 170) {

    $stringCut = substr($desc, 0, 170);
    $endPoint = strrpos($stringCut, ' ');
    $stringCut .= "...";
    $desc = $stringCut;

  }

  $query4 = "select nome, sobrenome from usuario where id = {$usu}";
  $stmt4  = $conexao->query($query4);
  $res4 = $stmt4->fetch(PDO::FETCH_NUM);

  $usuario = $res4[0];

  if($usuario == " "){
    $usuario = "Autor Inativo";
  }

  $split_date = explode("-", $row[6]);
  $date = $split_date[2] . " de " . getMonthName(floor($split_date[1]) - 1) . " de " . $split_date[0];
  
  $result .= "
              <article class='card'>
               <div class='row h-100'>
                <div class='coluna-img col-sm-12'>
                  <div class='box-img'>
                    <img class='card-img-top' src='{$img}' alt='Card image cap'>
                  </div>
                  <div class='details-atividade'>
                    <div class='details-atividade-left'>
                       <i class=' fas fa-male'></i>  {$usuario}
                    </div>
                    <div class='details-atividade-right'>
                       <i class='far fa-clock'></i> {$date}
                    </div>
                  </div>
                  <hr>
                </div>

                <div class='coluna-texto col-sm-12'>
                  <div class='card-body'>
                    <h2 class='card-title'>{$titulo}</h2>
                    <p class='card-text'>{$desc}</p>
                  </div>
                    <a href='{$urlSaibaMais}{$slug}' class='btn btn-primary btn-sm btn-news'>Saiba mais</a>
                </div>
                </div>
            </article>";
}

echo $result;

}
?>

