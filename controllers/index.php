<?php

class Index extends Controller{
    function __construct($session, $model){
        parent::__construct($session, $model);
        $this->view->render('index/index');
    }
}
?>