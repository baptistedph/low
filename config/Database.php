<?php
class Database {
  private $dbname = 'low';
  private $host = 'db';
  private $username = 'bado';
  private $password = 'badolebado';
  private $port = 3306;
  private $conn;
  
  public function connect() {
    $this->conn = null;
    
    try {
      $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;port=$this->port", $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Connection Error: $e";
    }

    return $this->conn;
  }
}