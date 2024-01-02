<?php

class Database{

    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    function __construct(){
        $this->host     = constant('DATABASE_HOST');
        $this->db       = constant('DATABASE_NAME');
        $this->user     = constant('DATABASE_USER');
        $this->password = constant('DATABASE_KEY');
        $this->charset  = constant('DATABASE_CHARSET');

    }

    function connect(){
        try{
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;
            
            $options = [
                PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES  => false,
            ];

            $pdo = new PDO($connection, $this->user, $this->password, $options);

            return $pdo; 
        }catch(PDOException $e){
            print('Error connection: ' . $e->getMessage());
        }
    }

}

?>