<?php

class Dash_Board extends Controller{

    function __construct($session, $model){

        // Herdar de padre e inizializar su contructor
        parent::__construct($session, $model);

        // Cargar los MidleWares del controlador
        $this->load_midlewares();
        loged();

        // Definir index, este metodo previene ejecutar las sentencias SQL y 
        // funciones en caso de que no se renderize el index del controlador.
        $this->load_index('dash_board', $this);
        
    }

    function load_midlewares(){
        require_once MIDDLEWARE . '/loged.php';
        require_once MIDDLEWARE . '/csrf.php';
        require_once FUNCTIONS . '/upload_image.php';
    }

    function index(){
        // Pasar la carga al controlador de pagina, y como parametro el controlador actual
        $index = new Index($this);

        // Pasar respuesta y estado del controlador de pagina al frontend
        $this->view->args['action'] = $index->success;
        $this->view->args['message'] = $index->response;

        // Definir nombre de la vista
        $this->view_name = "dash_board/index";

    }

    function profile(){
        // Pasar la carga al controlador de pagina, y como parametro el controlador actual
        $profile = new Profile($this);
        
        // Pasar respuesta y estado del controlador de pagina al frontend
        $this->view->args['action'] = $profile->success;
        $this->view->args['message'] = $profile->response;

        // Llamar a la vista
        $this->view_name = "dash_board/profile";
        $this->render();
    }

    function config(){
        $this->view_name = "dash_board/config";
        $this->render();
    }

    function new_post(){
        // Pasar la carga al controlador de pagina, y como parametro el controlador actual
        $new_post = new NewPost($this);

        // Llamar a la vista
        $this->view_name = "dash_board/new_post";
        $this->render();
    }

    function edit_post(){
        
        // Pasar la carga al controlador de pagina, y como parametro el controlador actual
        $edit = new EditPost($this);

        // Llamar a la vista
        $this->view_name = "dash_board/edit_post";
        $this->render();
    }

    function post_edit_post(){
        // Expected data
        $expected_data = [
            'anuncio_imagen'        => isset($_POST['anuncio_imagen']) ? $_POST['anuncio_imagen'] : null,
            'anuncio_sector'        => isset($_POST['anuncio_sector']) ? $_POST['anuncio_sector'] : null,
            'anuncio_vacante'       => isset($_POST['anuncio_vacante']) ? $_POST['anuncio_vacante'] : null,
            'anuncio_descripcion'   => isset($_POST['anuncio_descripcion']) ? $_POST['anuncio_descripcion'] : null,
            'anuncio_sueldo'        => isset($_POST['anuncio_sueldo']) ? $_POST['anuncio_sueldo'] : null,
            'anuncio_ubicacion'     => isset($_POST['anuncio_ubicacion']) ? $_POST['anuncio_ubicacion'] : null,
            'anuncio_tag_contrato'  => isset($_POST['anuncio_tag_contrato']) ? $_POST['anuncio_tag_contrato'] : null,
            'anuncio_tag_ubicacion' => isset($_POST['anuncio_tag_ubicacion']) ? $_POST['anuncio_tag_ubicacion'] : null,
            'anuncio_tag_formacion' => isset($_POST['anuncio_tag_formacion']) ? $_POST['anuncio_tag_formacion'] : null,
            'anuncio_tag_festivo'   => isset($_POST['anuncio_tag_festivo']) ? $_POST['anuncio_tag_festivo'] : null,
            'anuncio_tag_horario'   => isset($_POST['anuncio_tag_horario']) ? $_POST['anuncio_tag_horario'] : null,
        ];
        // TODO -> edited_on


        // Verify if is null the required data:
        if  (
                empty($expected_data['anuncio_imagen']) ||
                empty($expected_data['anuncio_sector']) ||
                empty($expected_data['anuncio_vacante']) ||
                empty($expected_data['anuncio_descripcion']) ||
                empty($expected_data['anuncio_ubicacion']) ||
                empty($expected_data['anuncio_tag_contrato']) ||
                empty($expected_data['anuncio_tag_ubicacion']) ||
                empty($expected_data['anuncio_tag_formacion']) ||
                empty($expected_data['anuncio_tag_festivo']) ||
                empty($expected_data['anuncio_tag_horario'])

            ){
                $this->action = false;
                return $this->error['empty_data'];
        }
        // Insert data to db
        $anuncio_id = $this->getUrlSegment(2);
        $status = null;
        $to_db = [
            "table"         => "anuncios",
            "conditional"   => ["anuncio_id=?" , $anuncio_id],
            "data"          => [
                'anuncio_imagen'        => $expected_data['anuncio_imagen'],
                'anuncio_sector'        => $expected_data['anuncio_sector'],
                'anuncio_vacante'       => $expected_data['anuncio_vacante'],
                'anuncio_descripcion'   => $expected_data['anuncio_descripcion'],
                'anuncio_sueldo'        => $expected_data['anuncio_sueldo'],
                'anuncio_ubicacion'     => $expected_data['anuncio_ubicacion'],
                'anuncio_tag_contrato'  => $expected_data['anuncio_tag_contrato'],
                'anuncio_tag_ubicacion' => $expected_data['anuncio_tag_ubicacion'],
                'anuncio_tag_formacion' => $expected_data['anuncio_tag_formacion'],
                'anuncio_tag_festivo'   => $expected_data['anuncio_tag_festivo'],
                'anuncio_tag_horario'   => $expected_data['anuncio_tag_horario'],
            ],
        ];

        try{
            $result = $this->model->update($to_db['table'], $to_db['conditional'], $to_db['data']);
            $this->action = true;
            $status = true;
        }catch(Exception $e){
            $result = $e;
            $this->action = false;
            return $result;
        }
    }
}

class Index extends PageController{
    function __construct($controller){
        
        // Inizializar padre
        parent::__construct($controller);

        // Analizar el metodo de peticion y enrutar
        if ($_SERVER["REQUEST_METHOD"] == "POST") return $this->post();
        elseif ($_SERVER["REQUEST_METHOD"] == "GET") return $this->get();
        else return null;
    }

    public function get(){
        // Buscar el id de los anuncios del usuario
        $table = "anuncios_users";
        $conditional = "user_id = '" . $_SESSION['user_id'] . "'";
        $return_data = "anuncio_id";
        $anuncios_ids = $this->controller->model->get_anuncios($table, $conditional, $return_data );

        // Sanitizar el resultado para la proxima sentencia SQL
        $anuncios_ids_proc = [];
        foreach($anuncios_ids as $key => $value){
            array_push($anuncios_ids_proc, $value['anuncio_id']);
        }

        // Obtener los datos de cada anuncio con el array sanitizado y devolver
        $table = "ver_anuncios";
        $conditional = "anuncio_id";
        $return_data = "anuncio_id, anuncio_vacante, categoria_name, anuncio_creado";
        $anuncios = null;
        if($anuncios_ids != false){
            $anuncios = $this->controller->model->select_in($table, $conditional, $return_data , $anuncios_ids_proc);
        }

        // Definir anuncios encontrados al controlador
        $this->controller->view->args['anuncios'] =  $anuncios ? $anuncios : null;
    }

    public function post(){
        // Manejar accion y respuestas
        if(isset($_POST['form_action']) && $_POST['form_action']){
            switch($_POST['form_action']){
                case "delete_post":
                    $this->delete_post();
                    break;
                case "delete_multiple_post":
                    $this->delete_multiple_post();
                    break;
            } 
            $this->get();      
        }
    }

    function delete_post(){
        // Obtener el anuncio_id del post values
        $anuncio_id = isset($_POST['anuncio_id']) ? $_POST['anuncio_id'] : null;

        // Validar contraseña      
        $key = isset($_POST['user_key']) ? md5($_POST['user_key']) : null;
        $table = "users";
        $conditional = 'user_key = "' . $key . '" and user_id = "' . $_SESSION['user_id'] . '"';
        $return_data = "user_id";

        if(!empty($key)){
            $isAuth = $this->controller->model->select_where($table, $conditional, $return_data);
        }else{
            $this->success = false;
            $this->response = 'Contrasenya incorrecta.';
            return null;
        }

        // Validar que el anuncio sea propiedad del usuario
        $table = "anuncios_users";
        $conditional = 'user_id = "' . $_SESSION['user_id'] . '" and anuncio_id = "' . $anuncio_id . '"';
        $return_data = "user_id";

        $isAuth = $this->controller->model->select_where($table, $conditional, $return_data);
        if(empty($isAuth)){
            $this->success = false;
            $this->response = 'Has intentat eliminar un anunci que no és de la seva propietat. Aquesta acció quedarà registrada en el nostre servidor.';
            return null;
        }

        // Eliminar anuncio
        $table = 'anuncios';
        $conditional = 'anuncio_id = "' . $anuncio_id . '"';

        $deleteSucces = $this->controller->model->delete_where($table, $conditional); 

        if(empty($deleteSucces)){
            $this->success = false;
            $this->response = "Hi ha hagut un error en intentar eliminar l'anunci. Intenta refrescar el navegador i torna-ho a provar. Disculpi les molèsties.";
            return null;
        }

        // Crear mensaje de exito
        $this->success = true;
        $this->response = "S'ha eliminat l'anunci satisfactòriament.";      
    }

    function delete_multiple_post(){
        // Obtener el anuncio_id del post values y convertir en array
        $anuncios_id = isset($_POST['anuncios_id']) ? $_POST['anuncios_id'] : null;
        $anuncios_id = explode(',', $anuncios_id);

        // Validar contraseña      
        $key = isset($_POST['user_key']) ? md5($_POST['user_key']) : null;
        $table = "users";
        $conditional = 'user_key = "' . $key . '" and user_id = "' . $_SESSION['user_id'] . '"';
        $return_data = "user_id";
        
        if(!empty($key)){
            $isAuth = $this->controller->model->select_where($table, $conditional, $return_data);
        }else{
            $this->success = False;
            $this->response = 'Contrasenya incorrecta.';
            return null;
        }
        $isAuth = !empty($isAuth) ? True : null;

        // Validar que el anuncio sea propiedad del usuario
        $table = "anuncios_users";
        $match = 'user_id = "' . $_SESSION['user_id'] . '"' ;
        $conditional =  'anuncio_id ';
        $return_data = "anuncio_id";

        $isAuth = $isAuth ? $this->controller->model->select_where_in($table, $match, $conditional, $return_data, $anuncios_id) : null;
        if(empty($isAuth)){
            $this->success = false;
            $this->response = 'Has intentat eliminar anuncis que no és de la seva propietat. Aquesta acció quedarà registrada en el nostre servidor.';
            return null;
        }else{
            $isAuth = True;
        }
        
        // Eliminar anuncio
        if($isAuth){
            $table = 'anuncios';
            $conditional = ' anuncio_id ';
    
            $deleteSucces = $this->controller->model->delete_in($table, $conditional, $anuncios_id);

            if(empty($deleteSucces)){
                $this->success = false;
                $this->response = "Hi ha hagut un error en intentar eliminar l'anunci. Intenta refrescar el navegador i torna-ho a provar. Disculpi les molèsties.";
                return null;
            }else{
                $this->success = True;
                $this->response = "S'ha eliminat l'anunci satisfactòriament.";
            }
        }
    }
}

class Profile extends PageController{
    function __construct($controller){

        // Inizializar padre
        parent::__construct($controller);

        // Analizar el metodo de peticion y enrutar
        if ($_SERVER["REQUEST_METHOD"] == "POST") return $this->post();
        elseif ($_SERVER["REQUEST_METHOD"] == "GET") return $this->get();
        else return null;
    }

    public function get(){
        return null;
    }

    public function post(){
        switch ($_POST['action']) {
            case "profile":
                $this->update_profile();
                break;
            case 'key':
                $this->update_password();
                break;
            default:
                return True;
                break;
        }
    }
    
    function update_profile(){
        // Importar funciones
        require_once FUNCTIONS . '/upload_image.php';

        // Datos esperados
        $user_avatar_image = isset($_FILES['user_avatar_image']) ? $_FILES['user_avatar_image'] : null;

        $expected_data = [
            "user_avatar"       => isset($_POST["user_avatar"]) ? trim($_POST["user_avatar"]) : null,
            "user_alias"        => isset($_POST["user_alias"]) ? trim($_POST["user_alias"]) : null,
            "user_email"        => isset($_POST["user_email"]) ? trim($_POST["user_email"]) : null,
            "user_avatar_image" => isset($_FILES['user_avatar_image']) ? $_FILES['user_avatar_image'] : null,
        ];

        // Validar que se haya recivido algun dato
        if(
            empty($expected_data['user_avatar_image']) && 
            empty($expected_data['user_avatar']) && 
            empty($expected_data['user_alias']) && 
            empty($expected_data['user_email'])){

                return null;
        }

        // Verificar si el usuario tiene una imagen el el servidor para borrarla
        if(
            !empty($expected_data['user_avatar_image']) || 
            !empty($expected_data["user_avatar"])){

                $user_image_path = explode("/" , $_SESSION['user_avatar']);
                $user_image_path = $user_image_path[0] == 'users' ? True : false;
                if($user_image_path) unlink(AVATARS_LOCAL . $_SESSION['user_avatar']);
        }

        // Subir la imagen en caso de que haya
        if(
            !empty($expected_data['user_avatar_image']) && 
            empty($expected_data['user_avatar'])){
                $file_name = $_SESSION['user_id'];
                $image = upload('user_avatar_image', $file_name);
                // ****** Validar subida existosa
                $expected_data["user_avatar"] = 'users/' . $image;
        }

        // Peparar la estructura de datos para la base de datos
        $to_db = [
            "table"         => "users",
            "conditional"   => ["user_id=?" , $_SESSION['user_id']],
            "data"          => [],
        ];

        foreach($expected_data as $key => $value){
            if($expected_data[$key] != null && $key != 'user_avatar_image'){
                $to_db['data'][$key] = $value;
            }
        }

        // LLamar al modelo y devolver respuesta
        $dbSuccess = null;

        if(!empty($to_db['data'])){
            $dbSuccess = $this->controller->model->update($to_db['table'], $to_db['conditional'], $to_db['data']);

            if($dbSuccess){
                $this->response = "S'ha actualitzat el perfil satisfactòriament."; 
                $this->success = True;
            }else{
                $this->response = "No s'ha pogut actualitzar el perfil. Possiblement les dades que ha ingressat, ja existeixin en un altre perfil.";
                 $this->success = False;
            } 
        }else{
            return null;
        }

        // Refrescar session si la llamada al modelo a sido existosa
        if($dbSuccess){
            $isAuth = $this->controller->model->get_acount($_SESSION['user_id']);
            
            if($isAuth){
                $data_session = [
                    "user_id" => $isAuth['user_id'],
                    "user_alias" => $isAuth['user_alias'],
                    "user_email" => $isAuth['user_email'],
                    "user_type" => $isAuth['user_type'],
                    "user_avatar" => $isAuth['user_avatar'],
                ];
    
                $this->controller->session->refresh_session($data_session);
            }
        }
    }

    function update_password(){
        // Datos esperados
        $expected_data = [
            "user_old_key"  => isset($_POST["user_old_key"]) ? md5($_POST["user_old_key"]) : null,
            "user_key"      => isset($_POST["user_key"]) ? md5($_POST["user_key"]) : null,
        ];

        // Verificar que los datos no esten vacios
        if(empty($expected_data['user_old_key']) || empty($expected_data['user_key'])){
            $this->seccess = false;
            $this->response = "No s'ha pogut actualitzar la contrasenya. Ha d'omplir les dues caselles.";
            return null;
        }

        // Verificar que el password sea superior a 8 caracteres
        if(strlen($_POST["user_key"]) < 8){
            $this->success = false;
            $this->response = "No s'ha pogut actualitzar la contrasenya. La contrasenya ha de tindre més de 8 caràcters.";
            return null;
        }

        // Verificar que la vieja constraseña sea correcta
        if(!empty($expected_data['user_old_key']) && !empty($expected_data['user_key'])){
            $to_db = [
                "table"         => "users",
                "conditional"   => "user_key='" . $expected_data['user_old_key'] . "'",
                "return"        => "user_id",
            ];

            $user = $this->controller->model->select_where($to_db['table'], $to_db['conditional'], $to_db['return']);
        }

        if(!$user){
            $this->success = false;
            $this->response = "No s'ha pogut actualitzar la contrasenya. No coincideix la teva antiga contrasenya.";
            return null;
        }

        // Actualizar la nueva constraseña llamando al modelo y asignar la respuesta y estado
        $to_db = [
            "table"         => "users",
            "conditional"   => ["user_id=?" , $_SESSION['user_id']],
            "data"          => [
                "user_key" => $expected_data['user_key'],
            ],
        ];

        $dbSucces = $this->controller->model->update($to_db['table'], $to_db['conditional'], $to_db['data']);

        if($dbSucces){
            $this->success = true;
            $this->response = "S'ha actualitzat la contrasenya satisfactòriament.";
        }else{
            $this->success = false;
            $this->response = "No s'ha pogut actualitzar la contrasenya. Torna a intentar-ho.";
        }

        // Refrescar la session si la llamada al modelo a sido exitosa
        if($dbSucces){
            $isAuth = $this->controller->model->get_acount($_SESSION['user_id']);
    
            if($isAuth){
                $data_session = [
                    "user_id" => $isAuth['user_id'],
                    "user_alias" => $isAuth['user_alias'],
                    "user_email" => $isAuth['user_email'],
                    "user_type" => $isAuth['user_type'],
                    "user_avatar" => $isAuth['user_avatar'],
                ];
    
                $this->controller->session->refresh_session($data_session);
            }
        }
    }
}

class NewPost extends PageController{
    function __construct($controller){

        // Inizializar padre
        parent::__construct($controller);

        // Analizar el metodo de peticion y enrutar
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->post();
            $this->get();
        }elseif ($_SERVER["REQUEST_METHOD"] == "GET") return $this->get();
        else return null;
    }

    public function get(){
        // Return data for the select inputs
        $categorias = $this->controller->model->select_all('categorias');
        $ubicacion = $this->controller->model->select_all('ubicaciones');
        
        
        //Set data to frontend
        $this->controller->view->args['categorias'] = $categorias;
        $this->controller->view->args['ubicacion'] = $ubicacion;
    }

    public function post(){
        // Datos esperados
        $expected_data = [
            'anuncio_user'          => $_SESSION['user_id'],
            'anuncio_imagen'        => isset($_POST['anuncio_imagen']) ? $_POST['anuncio_imagen'] : null,
            'anuncio_sector'        => isset($_POST['anuncio_sector']) ? $_POST['anuncio_sector'] : null,
            'anuncio_vacante'       => isset($_POST['anuncio_vacante']) ? $_POST['anuncio_vacante'] : null,
            'anuncio_descripcion'   => isset($_POST['anuncio_descripcion']) ? $_POST['anuncio_descripcion'] : null,
            'anuncio_sueldo'        => isset($_POST['anuncio_sueldo']) ? $_POST['anuncio_sueldo'] : null,
            'anuncio_ubicacion'     => isset($_POST['anuncio_ubicacion']) ? $_POST['anuncio_ubicacion'] : null,
            'anuncio_tag_contrato'  => isset($_POST['anuncio_tag_contrato']) ? $_POST['anuncio_tag_contrato'] : null,
            'anuncio_tag_ubicacion' => isset($_POST['anuncio_tag_ubicacion']) ? $_POST['anuncio_tag_ubicacion'] : null,
            'anuncio_tag_formacion' => isset($_POST['anuncio_tag_formacion']) ? $_POST['anuncio_tag_formacion'] : null,
            'anuncio_tag_festivo'   => isset($_POST['anuncio_tag_festivo']) ? $_POST['anuncio_tag_festivo'] : null,
            'anuncio_tag_horario'   => isset($_POST['anuncio_tag_horario']) ? $_POST['anuncio_tag_horario'] : null,
        ];
        
        // Verificar que esten todos los campos obligatorios
        if  (
                empty($expected_data['anuncio_imagen']) ||
                empty($expected_data['anuncio_sector']) ||
                empty($expected_data['anuncio_vacante']) ||
                empty($expected_data['anuncio_descripcion']) ||
                empty($expected_data['anuncio_ubicacion']) ||
                empty($expected_data['anuncio_tag_contrato']) ||
                empty($expected_data['anuncio_tag_ubicacion']) ||
                empty($expected_data['anuncio_tag_formacion']) ||
                empty($expected_data['anuncio_tag_festivo']) ||
                empty($expected_data['anuncio_tag_horario'])

            ){
                $this->success = false;
                $this->response = "L'única casella que pot deixar en blanc és el <i>'Sou mensual aproximat'</i>.";

                $this->controller->view->args['action'] = $this->success;
                $this->controller->view->args['message'] = $this->response;
                $this->controller->view->args['data_post'] = $_POST;

                return null;
        }

        // Insertar a la base de datos
        $table = "anuncios";
        $status = null;
        try{
            $result = $this->controller->model->insert_lastId($table, $expected_data);
            $status = true;
        }catch(Exception $e){
            $this->success = False;
            $this->response = "Hi ha hagut un problema. No s'ha pogut guardar l'anunci correctament.";

            $this->controller->view->args['action'] = $this->success;
            $this->controller->view->args['message'] = $this->response;
            $this->controller->view->args['data_post'] = $_POST;

            return null;
        }

        //Obtener el id del anuncio insertado y crear una relacion con el usuario
        $table = "anuncios_users";
        $relation_data = [
            'anuncio_id' => $result,
            'user_id' => $_SESSION['user_id'],
        ];

        $status = null;

        try{
            $this->controller->model->insert($table, $relation_data);
            $this->success = true;
            $this->response = "El teu anunci s'ha guardat exitosament.";
        }catch(Exception $e){
            $this->success = false;
            $this->response = "Hi ha hagut un problema. No s'ha pogut guardar la relació de l'anunci correctament.";
            
            $this->controller->view->args['action'] = $this->success;
            $this->controller->view->args['message'] = $this->response;
            $this->controller->view->args['data_post'] = $_POST;

            return null;
        }

        // Pasar respuesta y estado al controlador
        $this->controller->view->args['action'] = $this->success;
        $this->controller->view->args['message'] = $this->response;
        
        // Llamar la funcion get para procesar otros datos
        $this->get();

    }

}

class EditPost extends PageController{
    function __construct($controller){

        // Inizializar padre
        parent::__construct($controller);

        // Obtener el id del anuncio pasado por parametro
        $this->anuncio_id = $this->controller->getUrlSegment(2);

        // Analizar el metodo de peticion y enrutar
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $this->post();
            $this->get();
        }
        elseif ($_SERVER["REQUEST_METHOD"] == "GET") return $this->get();
        else return null;
    }

    public function get(){
        // Vrificar que el anuncio sea del usuario
        $table = "anuncios_users";
        $conditional = "user_id = " . $_SESSION['user_id'] . " and anuncio_id= " . $this->anuncio_id; 
        $return_data = "*";
        $isAuth = $this->controller->model->select_where($table, $conditional, $return_data);


        if(!empty($isAuth)){

            // Obtener datos de la base de datos
            $table = "anuncios";
            $conditional = "anuncio_id=" . $this->anuncio_id;
            $return_data = "*";
            $anuncio = $this->controller->model->select_where($table, $conditional, $return_data);
            $anuncio = $anuncio[0];
    
            // Estructura de datos para cargar
            $data = [
                'anuncio_imagen'        => $anuncio['anuncio_imagen'],
                'anuncio_sector'        => $anuncio['anuncio_sector'],
                'anuncio_vacante'       => $anuncio['anuncio_vacante'],
                'anuncio_descripcion'   => $anuncio['anuncio_descripcion'],
                'anuncio_sueldo'        => $anuncio['anuncio_sueldo'],
                'anuncio_ubicacion'     => $anuncio['anuncio_ubicacion'],
                'anuncio_tag_contrato'  => $anuncio['anuncio_tag_contrato'],
                'anuncio_tag_ubicacion' => $anuncio['anuncio_tag_ubicacion'],
                'anuncio_tag_formacion' => $anuncio['anuncio_tag_formacion'],
                'anuncio_tag_festivo'   => $anuncio['anuncio_tag_festivo'],
                'anuncio_tag_horario'   => $anuncio['anuncio_tag_horario'],
            ];
            $this->controller->view->args['data_post'] = $data;

            // Return data for the select inputs
            $categorias = $this->controller->model->select_all('categorias');
            $ubicacion = $this->controller->model->select_all('ubicaciones');

            //Set data to frontend
            $this->controller->view->args['categorias'] = $categorias;
            $this->controller->view->args['ubicacion'] = $ubicacion;

        }else{
            echo "403 Forbiden";
        }
    }

    public function post(){
        // Datos esperados
        $expected_data = [
            'anuncio_imagen'        => isset($_POST['anuncio_imagen']) ? $_POST['anuncio_imagen'] : null,
            'anuncio_sector'        => isset($_POST['anuncio_sector']) ? $_POST['anuncio_sector'] : null,
            'anuncio_vacante'       => isset($_POST['anuncio_vacante']) ? $_POST['anuncio_vacante'] : null,
            'anuncio_descripcion'   => isset($_POST['anuncio_descripcion']) ? $_POST['anuncio_descripcion'] : null,
            'anuncio_sueldo'        => isset($_POST['anuncio_sueldo']) ? $_POST['anuncio_sueldo'] : null,
            'anuncio_ubicacion'     => isset($_POST['anuncio_ubicacion']) ? $_POST['anuncio_ubicacion'] : null,
            'anuncio_tag_contrato'  => isset($_POST['anuncio_tag_contrato']) ? $_POST['anuncio_tag_contrato'] : null,
            'anuncio_tag_ubicacion' => isset($_POST['anuncio_tag_ubicacion']) ? $_POST['anuncio_tag_ubicacion'] : null,
            'anuncio_tag_formacion' => isset($_POST['anuncio_tag_formacion']) ? $_POST['anuncio_tag_formacion'] : null,
            'anuncio_tag_festivo'   => isset($_POST['anuncio_tag_festivo']) ? $_POST['anuncio_tag_festivo'] : null,
            'anuncio_tag_horario'   => isset($_POST['anuncio_tag_horario']) ? $_POST['anuncio_tag_horario'] : null,
        ];
        // TODO -> edited_on


        // Validar todos los campos requeridos
        if  (
                empty($expected_data['anuncio_imagen']) ||
                empty($expected_data['anuncio_sector']) ||
                empty($expected_data['anuncio_vacante']) ||
                empty($expected_data['anuncio_descripcion']) ||
                empty($expected_data['anuncio_ubicacion']) ||
                empty($expected_data['anuncio_tag_contrato']) ||
                empty($expected_data['anuncio_tag_ubicacion']) ||
                empty($expected_data['anuncio_tag_formacion']) ||
                empty($expected_data['anuncio_tag_festivo']) ||
                empty($expected_data['anuncio_tag_horario'])

            ){
                $this->success = false;
                $this->response = "L'única casella que pot deixar en blanc és el <i>'Sou mensual aproximat'</i>.";

                $this->controller->view->args['action'] = $this->success;
                $this->controller->view->args['message'] = $this->response;
                $this->controller->view->args['data_post'] = $_POST;

                return null;
        }

        // Insertar a la base de datos
        $this->anuncio_id;
        $status = null;
        $to_db = [
            "table"         => "anuncios",
            "conditional"   => ["anuncio_id=?" , $this->anuncio_id],
            "data"          => [
                'anuncio_imagen'        => $expected_data['anuncio_imagen'],
                'anuncio_sector'        => $expected_data['anuncio_sector'],
                'anuncio_vacante'       => $expected_data['anuncio_vacante'],
                'anuncio_descripcion'   => $expected_data['anuncio_descripcion'],
                'anuncio_sueldo'        => $expected_data['anuncio_sueldo'],
                'anuncio_ubicacion'     => $expected_data['anuncio_ubicacion'],
                'anuncio_tag_contrato'  => $expected_data['anuncio_tag_contrato'],
                'anuncio_tag_ubicacion' => $expected_data['anuncio_tag_ubicacion'],
                'anuncio_tag_formacion' => $expected_data['anuncio_tag_formacion'],
                'anuncio_tag_festivo'   => $expected_data['anuncio_tag_festivo'],
                'anuncio_tag_horario'   => $expected_data['anuncio_tag_horario'],
            ],
        ];

        try{
            $this->controller->model->update($to_db['table'], $to_db['conditional'], $to_db['data']);

            $this->success = true;
            $this->response = "El teu anunci s'ha guardat exitosament.";
    
            $this->controller->view->args['action'] = $this->success;
            $this->controller->view->args['message'] = $this->response;

        }catch(Exception $e){
            $this->success = false;
            $this->response = "Hi ha hagut un problema. No s'ha pogut guardar l'edició de l'anunci.";
            
            $this->controller->view->args['action'] = $this->success;
            $this->controller->view->args['message'] = $this->response;
            $this->controller->view->args['data_post'] = $_POST;

            return null;
        }
    }
}
/*
anuncio_user
user_img
anuncio_id 	
anuncio_imagen 	
anuncio_sector 	
anuncio_vacante 	
anuncio_descripcion 	 	
anuncio_sueldo 		
anuncio_ubicacion 	
anuncio_tag_contrato 	 	
anuncio_tag_ubicacion 	 	
anuncio_tag_formacion 	 	
anuncio_tag_festivo 	 	
anuncio_tag_horario 	 	
anuncio_creado 	 	
anuncio_editado 
*/
?>