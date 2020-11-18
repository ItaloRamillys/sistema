<?php
namespace Helpers;

class Text{

    function only_alpha($text){
        $final = preg_replace("/[^a-zA-Z]+$/", "", $text);
        return $final;
    }

    function only_number($text){
        $final = preg_replace("[0-9]", "", $text);
        return $final;
    }

    function sanitize_url_data($text){
        $final = filter_var($text, FILTER_SANITIZE_STRING);
        $final = htmlspecialchars($final);
        return $data;
    }

}