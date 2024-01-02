<?php

class Dash_BoardModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get_profile($data = []){
        // Expected only [user_email]
        $credentials = [$data[0]];

        $pdo = $this->db->connect();
        $query = "SELECT user_avatar FROM users WHERE user_email = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute($credentials);
        $profile = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($profile)){
            return $profile;
        }else{
            return False;
        }
    }

    public function get_acount($id){
        $pdo = $this->db->connect();
        $query = "SELECT user_id, user_alias, user_email, user_type, user_avatar FROM users WHERE user_id = ? ";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id]);
        $acount = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($acount)){
            return $acount;
        }else{
            return False;
        }
    }

    public function get_anuncios($table, $conditional, $return_data){
        $result = $this->select_where($table, $conditional, $return_data);
        return $result;
    }
    
    public function delete_anuncio($table, $conditional){
        $result = $this->delete_where($table, $conditional);
        if(!empty($result)){
        }
        return $result;
    }
}


?>