<?php

//use \PDO;

class Database{

  private $db_name;
  private $db_user;
  private $db_pass;
  private $db_host;
  private $pdo;

  public function __construct($db_name='app_reservation', $db_user='root', $db_pass='', $db_host='localhost'){
    $this->db_name = $db_name;
    $this->db_user = $db_user;
    $this->db_pass = $db_pass;
    $this->db_host = $db_host;
  }

  private function getPDO(){
  
    $pdo;
    if($this->pdo === null){
      try{
        $pdo = new PDO ('mysql:host='.$this->db_host.';dbname='.$this->db_name.';charset=utf8', 'root', $this->db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }
      catch(PDOException $e){
		  //If the database doesn't exist ("unknow db name") then creates it with the 'reservations' table
        if ($e->getCode() == 1049){
          $pdo = $this->createDatabase($this->db_name);
        }
        else{
          die('Error: '.$e->getMessage());
        }
      }

      $this->pdo = $pdo;
    }
    return $this->pdo;
  }


  //Creates a new database for the application and create the 'reservations' table
  public function createDatabase($db_name){

    $pdo = new PDO ('mysql:host='.$this->db_host.';charset=utf8', 'root', $this->db_pass);
    $req = "CREATE DATABASE IF NOT EXISTS ".$db_name ;
    $pdo->prepare($req)->execute();
    $pdo = new PDO ('mysql:host='.$this->db_host.';dbname='.$this->db_name.';charset=utf8', 'root', $this->db_pass);
    $req = "CREATE TABLE reservations(
                id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
                destination VARCHAR(255) NOT NULL,
                insurance VARCHAR(255) NOT NULL,
                names VARCHAR(255) NOT NULL,
                ages VARCHAR(255) NOT NULL,
                total INT(11) NOT NULL)";
    $pdo->prepare($req)->execute();
    return $pdo;
  }

  //Return an array containing the result of the request
  public function query($statement){

    $req = $this->getPDO()->query($statement);
    $datas = $req->fetchAll(PDO::FETCH_CLASS);
    return $datas;
  }


  public function newEntry($array_statement){
 
    try{
        $sql = 'INSERT INTO reservations(destination, insurance, names, ages, total)
          VALUES(:destination, :insurance, :names, :ages, :total)';
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->execute($array_statement);
    }
    catch(PDOException $e){
      echo $sql ."<br>".$e->getMessage();
    }
  }


  public function modifyEntry($array_statement){
    try{
      $sql = 'UPDATE reservations
              SET
                destination = :destination,
                insurance = :insurance,
                names = :names,
                ages = :ages,
                total = :total
              WHERE id=:id';
      $stmt = $this->getPDO()->prepare($sql);
      $stmt->execute($array_statement);
    }
    catch(PDOException $e){
      echo $sql ."<br>".$e->getMessage();
    }
  }


  public function deleteEntry($statement){
    try{
        $sql = $statement;
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->execute();

    }
    catch(PDOException $e){
      echo $sql ."<br>".$e->getMessage();
    }
  }

}
 ?>
