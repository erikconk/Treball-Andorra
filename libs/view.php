<?php

class View{
    function __construct(){
        $this->args = [];
    }

    function render($view_name){
        return require 'views/' . $view_name . '.php';
    }
}
?>