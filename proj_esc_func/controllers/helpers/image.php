<?php
namespace Helpers;

class Image{
    
    function resize_image($img, $path, $w, $h){

        $ext = explode(".", $img);
        $extension = end($ext);

        if($extension == "jpg" || $extension == "jpeg"){
            $img_temp = imagecreatefromjpeg("C:/xampp/htdocs/sistema/img/".$img);
        }else if($extension == "png"){
            $img_temp = imagecreatefrompng("C:/xampp/htdocs/sistema/img/".$img);
        }else{
            return $extension;
        }

        $x = imagesx($img_temp);
        $y = imagesy($img_temp);

        $new_img = imagecreatetruecolor($w, $h);

        imagecopyresampled($new_img, $img_temp, 0, 0, 0, 0, $w, $h, $x, $y); 

        $name = explode("/", $ext[0]);
        $new_name = end($name);

        if($extension == "jpg" || $extension == "jpeg"){
            if(imagejpeg($new_img, $path . $new_name . "_" . $w . "x" . $h . "." . $extension)){
                return true;
            }
            
        }else if($extension == "png"){
            if(imagepng($new_img, $path . $new_name . "_" . $w . "x" . $h . "." . $extension)){
                return true;
            }
        }

        return false;
    }
}