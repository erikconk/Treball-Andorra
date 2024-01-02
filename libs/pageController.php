<?php 

class PageController{

    function __construct($controller){

        // Inizializar variables de la classe
        $this->controller = $controller;
        $this->success = null;
        $this->response = null;
    }
}

?>