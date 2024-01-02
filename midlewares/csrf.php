<?php

function csrf(){
    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

        if(!isset($_SESSION['token']) || !$token || $token !== $_SESSION['token']){
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            $response['csrf'] = "CSRF Prevent Atack";
            echo json_encode($response);
            return exit;
        }
}

?>