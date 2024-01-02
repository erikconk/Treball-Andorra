<?php

class New_Acount extends Controller{
    
    function __construct($session, $model){
        parent::__construct($session, $model);
        $this->load_midlewares();
        $this->view_name = "new_acount/index";
    }
    
    function load_midlewares(){
        require_once MIDDLEWARE . '/csrf.php';
    }

    public function exist_acount(){
        header('Content-Type: application/json; charset=utf-8');
        $user = isset($_POST['user_email']) && !empty($_POST['user_email']) ? $_POST['user_email'] : null;
        $is_acount = $this->model->get_acount([$user]);
        if($is_acount){
            $response['exist'] = True;
        }else{
            $response['exist'] = False;
        }
        echo json_encode($response);
    }

    public function validate_acount(){
        csrf();

        $data = [
            "user_type"     => $this->get_id_type($_POST['user_type']),
            "user_email"    => filter_var($_POST['user_email'], FILTER_SANITIZE_EMAIL),
            "user_key"      => md5($_POST['user_key']), 
            "user_alias"    => $_POST['user_alias'],   
            "user_token"    => $_SESSION['token'],     
        ];
        $response_db = $this->model->insert( "users" , $data);

        if($response_db == True){
            $response['succes'] = $response_db;
            echo json_encode($response);
        }else{
            $response['error_db'] = $response_db;
            echo json_encode($response);
        }
    }
    
    public function get_id_type($type){
        $table_name = "user_types";
        $return_data = "type_id";
        $cond = "type_name = '" . $type . "'";
        $user_types = $this->model->select_where($table_name, $cond, $return_data);

        return $user_types['type_id'];
    }

    public function send_mail_confirmation(){

    }
    public function activate_acount(){
        echo "Wotks";
    }
    public function validate_recaptcha(){
        require_once MIDDLEWARE . '/recaptcha.php';

        $recaptcha = recaptchaValid();

        if(!$recaptcha['succes']){
            $this->view->args['error_recaptacha'] = $recaptcha['getMessage'];
            var_dump($this->view->args);
            $this->render();
            die();
        };
    }
    

}


?>