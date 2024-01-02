<?php

class Blocked extends Controller{
    function __construct($session, $model){
        parent::__construct($session, $model);
        $this->view->render('blocked/index');
    }
}
?>