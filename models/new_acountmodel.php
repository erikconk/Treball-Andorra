<?php

class New_AcountModel extends Model{

    public function __construct(){
        parent::__construct();
    }

    public function get_acount($data = []){
        $request = [
            "user_email" => $data[0],
        ];
        $credentials = [];

        foreach($request as $key => $value){
            array_push($credentials, $request[$key]);
        }
        $pdo = $this->db->connect();
        $query = "SELECT user_email FROM users WHERE user_email = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute($credentials);
        $acounts = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($acounts)){
            return True;
        }else{
            return False;
        }
    }
    
}


?>