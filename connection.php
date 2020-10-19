<?php 

    class Connection {
        private $host = "localhost";
        private $dbName = "alumniclubdb";
        private $username = "root";
        private $password = "";
        public $conn;

        public function __construct(){

        }   
        
        public function getConnection(){
            try{

                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName . ";charset=utf8",$this->username, $this->password);
                $this->conn->exec("set names utf8");

            }catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }
            return $this->conn;
        }
		
		
    }
	
?>