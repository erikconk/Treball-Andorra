<?php 

class Controller{
    function __construct($session, $model){
        $this->view = new View();
        $this->session = $session;
        $this->loadModel($model);
    }

    public function __call($name, $args){
        $this->view->render('404/index');
    }

    function loadModel($model){
        $url = 'models/' . $model . 'model.php';

        if(file_exists($url)){
            require $url;

            $modelName = $model. 'Model';
            $this->model = new $modelName();
        }
    }

    function render(){
        $this->view->render($this->view_name);
    }

    function redirect($url){
        header('Location: '. URL . '/' . $url);
    }

    function post($callback){
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            return $this->{$callback}();
        }
    }

    function getUrlSegment($returnedSegment) {
        // Obtener la url
        $protocolo = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
        $url = $protocolo . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $urlParts = parse_url($url);
        
        // Obtener segmentos del path
        $pathSegments = explode('/', trim($urlParts['path'], '/'));
        
        // Retornar el segemnto elegido
        return $pathSegments[$returnedSegment];
    }
    
    function get_segment($position){
        //$position = int

        // Obtener la parte del path de la URL
        $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Dividir el path en segmentos
        $segmentos = explode('/', trim($urlPath, '/'));

        // Obtener el tercer segmento
        $tercerParametro = $segmentos[$position];

        return $tercerParametro;
    }

    function segments_limit($limit){
        // Verificar si hay al menos tres segmentos
        if (count($segmentos) < $limit) {
            // Lanzar un error si no hay suficientes segmentos
            throw new Exception('No hay suficientes segmentos en el path de la URL');
        }
    }

    function load_index($page_name, $controller){
        // Obtener la ruta de la URL
        $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

        // Eliminar barras diagonales iniciales y finales
        $url = trim($url, '/');

        // Dividir la ruta en segmentos
        $segmentos = explode('/', $url);

        // Verificar si hay exactamente un segmento y si ese segmento es igual a $page_name, 
        // caso exitoso, ejecutar la funcion pasada por parametro
        if (count($segmentos) === 1 && $segmentos[0] === $page_name) {
            return $controller->index();
        }
    }
}



?>