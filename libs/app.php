<?php
// Import MIDELWARES
require_once MIDDLEWARE . '/ip_blocker.php';
require_once MIDDLEWARE . '/bot_blocker.php';


class App{
    function __construct(){
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        validarPeticion();
        bloquearIP();
        $session = new Session();

        if(empty($url[0])){
            require_once 'controllers/index.php';
            $controller = new Index($session, $url[0]);
            return False;
        }
        $controller_file = 'controllers/' . $url[0] . '.php'; 
        if(file_exists($controller_file)){

            require_once $controller_file;
            $controller = new $url[0]($session, $url[0]);
            //$controller->loadModel($url[0]);
            
            if(isset($url[1])){
                $controller->{$url[1]}();
            }else{
                $controller->render();
            }

        }else{

            require_once 'controllers/errors.php';
            $controller = new Errors($session, $url[0]);

        }
    

    }
}

?>