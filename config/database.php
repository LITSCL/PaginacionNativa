<?php
class Database {
    private $host;
    private $db;
    private $user;
    private $password;

    public function __construct() {
        $this->host = "localhost";
        $this->db = "dbpaginacionnativa";
        $this->user = "root";
        $this->password = "root";
        $this->charset = "utf8mb4";
    }

    function conectar() {
        try {
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db;
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false];
            $pdo = new PDO($connection, $this->user, $this->password, $options);    
            return $pdo;  
        } catch(PDOException $e){
            print_r("Error connection: " . $e->getMessage());
        }   
    }
}
?>