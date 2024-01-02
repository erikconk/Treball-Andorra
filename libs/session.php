<?php

class Session{
    function __construct(){
        session_start();
    }

    function set_user_loged($data_session = []){
        try{
            $_SESSION["is_login"] = True;
            $_SESSION["user_id"] = $data_session['user_id'];
            $_SESSION["user_alias"] = $data_session['user_alias'];
            $_SESSION["user_email"] = $data_session['user_email'];
            $_SESSION["user_type"] = $data_session['user_type'];
            $_SESSION["user_avatar"] = $data_session['user_avatar'];

            return True;
        } catch (Exception $e){
            echo "No se ha podido establecer los datos de sessión. <br>" . $e;
            return exit;
        }
    }
    function refresh_session($data_session = []){
        $this->set_user_loged($data_session);
        return True;
    }
    function destroy(){
        session_unset(); 
        session_destroy(); 
    }
}


?>