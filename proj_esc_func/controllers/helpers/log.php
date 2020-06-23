<?php
namespace Helpers;

class Log{

    private $text;
    private $datetime;
    private $operation;

    function setLog($text, $datetime, $operation){
        $this->text         = $text;
        $this->datetime     = $datetime;
        $this->operation    = $operation;
    }

    function writeLog(){
        
    }
}