<?php

class Login extends Controller{

    function __construct($session, $model){
        parent::__construct($session, $model);
        $this->load_midlewares();
        $this->view_name = "login/index";
        $this->error_msg = "El correu electrónic o la contrasenya no és correcte.";
    }
    function load_midlewares(){
        require_once MIDDLEWARE . '/csrf.php';
    }
    public function authenticate(){
        csrf();

        $user = isset($_POST['user_email']) && !empty($_POST['user_email']) ? $_POST['user_email'] : null;
        $password = isset($_POST['user_key']) && !empty($_POST['user_key']) ? md5($_POST['user_key']) : null;
        
        if(!empty($user) && !empty($password)){
            $isAuth = $this->model->get_acount([$user, $password]);
    
            if($isAuth){
                $data_session = [
                    "user_id" => $isAuth['user_id'],
                    "user_alias" => $isAuth['user_alias'],
                    "user_email" => $isAuth['user_email'],
                    "user_type" => $isAuth['user_type'],
                    "user_avatar" => $isAuth['user_avatar'],
                ];

                $this->session->set_user_loged($data_session);
                $this->redirect("");
                return False;
            }else{
                $this->view->args['error_login'] = $this->error_msg;
                $this->view->args['error_email'] = $_POST['user_email'];
                $this->view->args['error_key'] = $_POST['user_key'];
            }
            $this->render();
        }
    }

    public function logout(){
        $this->session->destroy();
        $this->redirect("");
    }

}


?>