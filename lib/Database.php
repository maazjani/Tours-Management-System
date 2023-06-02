<?php

class Database{

    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'tours_db';

    public $con;

    public function __construct(){
        if(!isset($this->con)){
            try {
                $this->con = new mysqli($this->host, $this->username, $this->password, $this->dbname);
                if( mysqli_connect_errno() ){
                    throw new Exception("Could not connect to database.");   
                }
            } catch(Exception $e){
                throw new Exception($e->getMessage());   
            }
        }
    }
}


?>