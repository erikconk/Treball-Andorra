<?php

class Errors extends Controller{
    function __construct($session, $model){
        parent::__construct($session, $model);

        $this->view->msg = "Error, controller not found.";
        $this->view->render('errors/index');
    }
}

?>