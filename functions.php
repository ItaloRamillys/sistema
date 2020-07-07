<?php
function resize_image($img, $max_x, $max_y, $nome_foto) { 
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
    imagejpeg($image_p, $nome_foto, 100); 
}

