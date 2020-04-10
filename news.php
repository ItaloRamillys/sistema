<?php 
       
function showNews($baseURL, $conexao){

$query3 = "select * from noticia order by id_ntc desc";
$stmt3 = $conexao->query($query3);

$titulo = "";
$img = "";
$desc = "";
$result = "";

while ($row = $stmt3->fetch(PDO::FETCH_NUM)) {

  $titulo = ($row[1]);
  $desc   = ($row[3]);
  $usu    = ($row[4]);
  $img    = $baseURL . ($row[5]);
  $data   = ($row[6]);

  if (strlen($desc) > 170) {

    $stringCut = substr($desc, 0, 170);
    $endPoint = strrpos($stringCut, ' ');
    $stringCut .= "...";
    $desc = $stringCut;

  }

  $query4 = "select nome, sobrenome from usuario where id = {$usu}";
  $stmt4  = $conexao->query($query4);
  $res4 = $stmt4->fetch(PDO::FETCH_NUM);

  $usuario = ($res4[0]) . " " . ($res4[1]);

  if($usuario == " "){
    $usuario = "Autor Inativo";
  }

  $result .= "<article class='div-card'>
         <div class='card'>

         <div class='row'>
          <div class='coluna-img col-sm-12'>
            <img class='card-img-top' src='{$img}' alt='Card image cap'>

            <div class='details-atividade'>
              <div class='details-atividade-left'>
                 <i class=' fas fa-male' style='font-size:15px'></i>  {$usuario}
              </div>
              <div class='details-atividade-right'>
                 <i class='far fa-clock' style='font-size: 15px;'></i> {$data}
              </div>
            </div>
            <hr>
          </div>

          <div class='coluna-texto col-sm-12'>
            <div class='card-body'>
            <h2 class='card-title'>{$titulo}</h2>
            <p class='card-text'>{$desc}</p>
            <button href='#' class='btn btn-primary btn-saiba btn-sm'>Saiba mais</button>
          </div>
          </div>
          </div>
          </div>
      </article>";
}

echo $result;

}
?>

