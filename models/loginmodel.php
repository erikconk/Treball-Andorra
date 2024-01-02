<?php

class LoginModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get_acount($data = []){
        $request = [
            "user_email" => $data[0],
            "user_key" => $data[1],
            "user_activate" => 1,
        ];
        $credentials = [];

        foreach($request as $key => $value){
            array_push($credentials, $request[$key]);
        }

        $pdo = $this->db->connect();
        $query = "SELECT user_id, user_alias, user_email, user_type, user_avatar FROM users WHERE user_email = ? AND user_key = ? AND user_activate = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute($credentials);
        $acount = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($acount)){
            return $acount;
        }else{
            return False;
        }
    }
}


?>