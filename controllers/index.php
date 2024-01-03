<?php

class Index extends Controller{
    function __construct($session, $model){
        parent::__construct($session, $model);
        $this->index();
    }

    function index(){
        // Obtener anuncios
        //$anuncios = $this->model->get_anuncios();
        $this->view->args['anuncios'] = [1, 2, 3];
        $this->view->render('index/index');
    }
}
?>