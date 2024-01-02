<?php

function loged(){

    if(!isset($_SESSION["is_login"]) || $_SESSION["is_login"] != True){
        echo "Not loged";
        return exit;
    }
}

?>