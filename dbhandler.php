<?php
final class dbHandler
{
    private $dataSource = "mysql:dbname=stemwijzer;host=localhost";
    private $username = "root";
    private $password = "";

    private function connect()
    {
        try {
            return new PDO($this->dataSource, $this->username, $this->password);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

    public function selectPartijen()
    {   
    try {
        $pdo = new PDO($this->dataSource, $this->username, $this->password);
        $statement = $pdo->prepare("SELECT * FROM partijen");
        $statement->execute();
        return $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $exception) {

        return false; 
    }
    }

    public function selectNieuws()
    {
        try {
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("SELECT * FROM nieuws");
            $statement->execute();
            return $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            return false;
        }
    }

    public function selectStellingen()
    {
        try {
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("SELECT * FROM stellingen");
            $statement->execute();
            return $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            return false;
        }
    }
    public function selectStandpunten()
    {
        try {
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("SELECT * FROM standpunten");
            $statement->execute();
            return $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            return false;
        }
    }


    

}