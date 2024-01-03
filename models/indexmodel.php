<?php

class IndexModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get_anuncios(){
        $table = "ver_anuncios";
        $return_data = "*";
        $result = $this->select_all($table, $return_data);
        return $result;
    }
    

}


?>