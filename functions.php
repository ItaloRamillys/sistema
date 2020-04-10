<?php
//Função que printa a mensagem de retorno de uma requisição
function msg_callback($msg_suc, $msg_erro, $get, $time = null,  $msg_opc = null){
    if(isset($_GET[$get]) && $_GET[$get] == 1){
        echo "<div class='msg-cad success' id='msg-return'>{$msg_suc}</div>" ;
            $time = 4000;
    }
    else if(isset($_GET[$get]) && $_GET[$get] == 0){
        echo "<div class='msg-cad error' id='msg-return'>{$msg_erro}</div>" ;
    }
    else if(isset($_GET[$get]) && $_GET[$get] == 2){
        echo "<div class='msg-cad warn' id='msg-return'>{$msg_opc}</div>" ;
    }
    else if(isset($_GET[$get])){
      echo "<div class= 'msg-cad error' id='msg-return'>Erro desconhecido. Tente novamente ou entre em contato com o desenvolvedor.</div>" ;
    }

    if($time == null){
        $time = 6000;
    }

    echo "
          <script>
              
              $().ready(function() {
                  setTimeout(function () {
                      $('#msg-return').hide(700); 
                  }, ".$time.");
              });

          </script>";

}

function reduz_imagem($img, $max_x, $max_y, $nome_foto) { 
    list($width, $height) = getimagesize($img); 
    $original_x = $width; 
    $original_y = $height; 
    // se a largura for maior que altura 
    if($original_x > $original_y) { 
        $porcentagem = (100 * $max_x) / $original_x; 
    }
    // se a altura for maior que a largura
    else { 
        $porcentagem = (100 * $max_y) / $original_y; 
    } 
    $tamanho_x = $original_x * ($porcentagem / 100); 
    $tamanho_y = $original_y * ($porcentagem / 100); 
    $image_p = imagecreatetruecolor($tamanho_x, $tamanho_y); 
    $image = imagecreatefromjpeg($img); 
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $tamanho_x, $tamanho_y, $width, $height); 
    return imagejpeg($image_p, $nome_foto, 100); 
}

//Verificar o tipo de usuario
function type_user($dado, $tipo){
    require_once('C:\xampp\proj_esc_func\conexao.php');
    $query = "select tipo from usuaruo where id = " . $dado;
    $stmt = $conexao->query($query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result == $tipo){
        return true;
    }else{
        return false;
    }
}

?>
