<?php
namespace Helpers;

class Log{
    private $text;
    private $datetime;
    private $model;
    private $author;
    private $operation;
    private $status;

    function setLog($operation, $model, $author, $text, $datetime, $status){
        $this->operation    = $operation;
        $this->model        = $model;
        $this->author       = $author;
        $this->text         = $text;
        $this->datetime     = $datetime;
        $this->status       = $status;
    }

    function writeLog($path_file){
        $file = fopen($path_file,'a');
        if($file == false){
            return false;
        }
        $msg = $this->operation . " - " . $this->model . " - " . $this->author . " - " . $this->text . " - " . $this->datetime . " - " . $this->status . "\n";
        fwrite($file, $msg);
        fclose($file);
        return true;
    }
}