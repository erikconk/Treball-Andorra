<?php

class Model{
    function __construct(){
        $this->db = new Database();
    }
    public function insert($table, $data = []){
        $keys = "";
        $values_count = "";
        $values = [];

        foreach($data as $key => $value){
            if(empty($keys)){
                $keys = $key;
                $values_count .= "?";
            }else{
                $keys .= ', ' . $key;
                $values_count .= ", ?";
            }
            array_push($values, $value);
        }
        try{
            $pdo = $this->db->connect();
            $query = "INSERT INTO $table ( $keys ) VALUES ( $values_count )";
            $stmt = $pdo->prepare($query);
            $stmt->execute($values);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return True;
            
        }catch(PDOException $e){

            return $e->getMessage();
        }

    }
    public function insert_lastId($table, $data = []){
        $keys = "";
        $values_count = "";
        $values = [];

        foreach($data as $key => $value){
            if(empty($keys)){
                $keys = $key;
                $values_count .= "?";
            }else{
                $keys .= ', ' . $key;
                $values_count .= ", ?";
            }
            array_push($values, $value);
        }
        try{
            $pdo = $this->db->connect();
            $query = "INSERT INTO $table ( $keys ) VALUES ( $values_count )";
            $stmt = $pdo->prepare($query);
            $stmt->execute($values);
            
            // Obtener el ID de la última inserción
            $lastInsertId = $pdo->lastInsertId();

            return $lastInsertId;
            
        }catch(PDOException $e){

            return False;
        }

    }
    public function select_all($table, $return_data = "*"){
        try{
            $pdo = $this->db->connect();
            $query = "SELECT $return_data FROM $table";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $result;
            
        }catch(PDOException $e){

            return $e->getMessage();
        }
    }
    public function select_where($table, $conditional, $return_data = "*" ){
        // CONDITIONAL MUST BE:
        //$cond = 'field = "' . $value . '"';
        try{
            $pdo = $this->db->connect();
            $query = "SELECT $return_data FROM $table WHERE $conditional";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
            
        }catch(PDOException $e){
            //return $e->getMessage();
            return null;
        }
    }
    public function select_in($table, $conditional, $return_data , $list){
        // CONDITIONAL MUST BE:
        //$conditional = "field";
        try{
            $pdo = $this->db->connect();

            // Construir la consulta con marcadores de posición
            $placeholders = str_repeat('?,', count($list) - 1) . '?';

            //SQL QUERY
            $query = "SELECT $return_data FROM $table WHERE $conditional IN ($placeholders)";

            // Prepare and execute
            $stmt = $pdo->prepare($query);
            $stmt->execute($list);

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
            
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
    public function select_where_in($table, $match, $conditional, $return_data , $list){
        // CONDITIONAL MUST BE:
        //$conditional = "field";
        try{
            $pdo = $this->db->connect();

            // Construir la consulta con marcadores de posición
            $placeholders = str_repeat('?,', count($list) - 1) . '?';

            //SQL QUERY
            $query = "SELECT $return_data FROM $table WHERE $match AND $conditional IN ($placeholders)";

            // Prepare and execute
            $stmt = $pdo->prepare($query);
            $stmt->execute($list);

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
            
        }catch(PDOException $e){
            return $e->getMessage();
            //return null;
        }
    }
    public function update($table, $conditional = [], $data = []){
        $fields = "";
        $vals = [];
        $data_length = count($data);
        $aux_count = 1;

        foreach($data as $key => $value){
            if($aux_count == $data_length){
                $fields .= $key . "=?";
            }else{
                $fields .= $key . "=?, ";
            }
            array_push($vals, $value);
            $aux_count++;
        }
        array_push($vals , $conditional[1]);
        try{
            $pdo = $this->db->connect();
            $query = "UPDATE $table SET $fields WHERE $conditional[0]";
            //var_dump($query);
            $stmt = $pdo->prepare($query);
            $stmt->execute($vals);
            return True;
            
        }catch(PDOException $e){
            //return $e->getMessage();
            return False;
        }
    } 
    public function delete_where($table, $conditional = []){
        // CONDITIONAL MUST BE:
        //$cond = 'field = "' . $value . '"';
        try{
            $pdo = $this->db->connect();
            $query = "DELETE FROM $table WHERE $conditional";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return True;
            
        }catch(PDOException $e){
            //return $e->getMessage();
            return null;
        }
    }
    public function delete_in($table, $conditional, $list){
        // CONDITIONAL MUST BE:
        //$cond = 'field';
        try{
            $pdo = $this->db->connect();

            // Construir la consulta con marcadores de posición
            $placeholders = str_repeat('?,', count($list) - 1) . '?';

            // SQL statament
            $query = "DELETE FROM $table WHERE $conditional IN ($placeholders)";
            $stmt = $pdo->prepare($query);
            $stmt->execute($list);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return True;
            
        }catch(PDOException $e){
            //return $e->getMessage();
            return null;
        }
    }

}

?>