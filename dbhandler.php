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

      public function validatebeheer($username, $password)
    {
        $db = $this->connect();
        if ($db) {
            try {
                $statement = $db->prepare("SELECT * FROM beheerder WHERE Username = :username AND Passwordbeheer = :password");
                $statement->bindParam(':username', $username);
                $statement->bindParam(':password', $password);
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);
                return ($user !== false);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
        return false;
    }
    public function registerUser($username, $password) {
        $db = $this->connect();
        if ($db) {
            try {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $statement = $db->prepare("INSERT INTO gebruikers (naam, passwordUser) VALUES (:username, :password)");
                $statement->bindParam(':username', $username);
                $statement->bindParam(':password', $hashedPassword);
                $statement->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
        return false;
    }

    public function validateGebruiker($username, $password) {
        $db = $this->connect();
        if ($db) {
            try {
                $statement = $db->prepare("SELECT passwordUser FROM gebruikers WHERE naam = :username");
                $statement->bindParam(':username', $username);
                $statement->execute();
                $user = $statement->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    $hashedPassword = $user['passwordUser'];
                    if (password_verify($password, $hashedPassword)) {
                        return true;
                    } else {
                        echo "Password verificatie niet gelukt.";
                        return false;
                    }
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
        return false;
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
    public function deleteNieuws($nieuwsID)
    {
        try {
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("DELETE FROM nieuws WHERE nieuwsid = :nieuwsid");
            $statement->bindParam(":nieuwsid", $nieuwsID);
            $statement->execute();
            return true;
        } catch(PDOException $exception) {
            return false;
        }
    }
    
    public function addNieuws($titel, $link, $inhoud)
    {
        try {
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("INSERT INTO nieuws (titel, link, inhoud) VALUES (:titel, :link, :inhoud)");
            $statement->bindParam(':titel', $titel);
            $statement->bindParam(':link', $link);
            $statement->bindParam(':inhoud', $inhoud);
           
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateNieuws($id, $titel, $link, $inhoud) {
        $db = $this->connect();
        if ($db) {
            try {
                $statement = $db->prepare("UPDATE nieuws SET titel = :titel, link = :link, inhoud = :inhoud WHERE nieuwsid = :id");
                $statement->bindParam(':id', $id);
                $statement->bindParam(':titel', $titel);
                $statement->bindParam(':link', $link);
                $statement->bindParam(':inhoud', $inhoud);
                $statement->execute();
                return true;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
        return false;
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
    public function  addStelling(){
        try {
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("INSERT INTO stellingen (stellingen) VALUES (:stellingen)");
            $statement->bindParam(':stellingen', $stellingen);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
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

    function getPartyById($partyId)
    {
        $pdo = $this->connect();
        if ($pdo) {
            $statement = $pdo->prepare("SELECT * FROM partijen WHERE partijID = :partijID");
            $statement->bindParam(":partijID", $partyId);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

    public function standpuntenpartijen($partijID)
    {
        try {
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("SELECT * FROM partij_standpunten");
            $statement->bindParam(":partijID", $partijID);
            $statement->execute();
            return $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            return false;
        }
    }
    public function stemwijzerResultaat()
    {
        try {
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("SELECT * FROM partij_standpunten  ");
            $statement->execute();
            return $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            return false;
        }
    }

    public function getStandpuntenByPartyIdV1($partyId)
    {
        $pdo = $this->connect();
        if ($pdo) {
            $statement = $pdo->prepare("
                SELECT stellingen.stellingID, stellingen.stellingen, partij_standpunten.standpunt, partij_standpunten.argument
                FROM stellingen
                JOIN partij_standpunten ON stellingen.stellingID = partij_standpunten.stellingID
                WHERE partij_standpunten.partijID = :partijID
               
            ");
            $statement->bindParam(":partijID", $partyId);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
    public function updateStandpunt($stellingId, $partijId, $standpunt, $argument)
    {
        try {
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("UPDATE partij_standpunten SET standpunt = :standpunt, argument = :argument WHERE stellingID = :stellingID AND partijID = :partijID");
            $statement->bindParam(":stellingID", $stellingId);
            $statement->bindParam(":partijID", $partijId);
            $statement->bindParam(":standpunt", $standpunt);
            $statement->bindParam(":argument", $argument);
            $statement->execute();
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }
    public function deleteStandpunt($stellingId, $partijId)
    {
        try {
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("DELETE FROM partij_standpunten WHERE stellingID = :stellingID AND partijID = :partijID");
            $statement->bindParam(":stellingID", $stellingId);
            $statement->bindParam(":partijID", $partijId);
            $statement->execute();
            return true;
        } catch (PDOException $exception) {
            return false;
        }
    }

public function insertStandpunt($stellingId, $partijId, $standpunt, $argument)
{
    try {
        $pdo = new PDO($this->dataSource, $this->username, $this->password);
        $statement = $pdo->prepare("INSERT INTO partij_standpunten (stellingID, partijID, standpunt) VALUES (:stellingID, :partijID, :standpunt, :argument)");
        $statement->bindParam(":stellingID", $stellingId);
        $statement->bindParam(":partijID", $partijId);
        $statement->bindParam(":standpunt", $standpunt);
        $statement->bindParam(":argument", $argument);
        $statement->execute();
        return true;
    } catch(PDOException $exception) {
        return false;
    }
}
public function Getverkiezing()
{
    try {
        $pdo = new PDO($this->dataSource, $this->username, $this->password);
        $statement = $pdo->prepare("SELECT * FROM verkiezingen");
        $statement->execute();
        return $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $exception) {
        return false;
    }
}


public function addPartij($partijNaam)
{
    try {
        $pdo = new PDO($this->dataSource, $this->username, $this->password);
        $statement = $pdo->prepare("INSERT INTO partijen (partijen) VALUES (:partijNaam)");
        $statement->bindParam(":partijNaam", $partijNaam);
        $statement->execute();
        return true;
    } catch(PDOException $exception) {
        return false;
    }
}
public function deletePartij($partijId)
{
    try {
        $pdo = new PDO($this->dataSource, $this->username, $this->password);
        $statement = $pdo->prepare("DELETE FROM partijen WHERE partijID = :partijID");
        $statement->bindParam(":partijID", $partijId);
        $statement->execute();
        return true;
    } catch(PDOException $exception) {
        return false;
    }
}
public function updatePartij($partijId, $partijNaam)
{
    try {
        $pdo = new PDO($this->dataSource, $this->username, $this->password);
        $statement = $pdo->prepare("UPDATE partijen SET partijen = :partijNaam WHERE partijID = :partijID");
        $statement->bindParam(":partijID", $partijId);
        $statement->bindParam(":partijNaam", $partijNaam);
        $statement->execute();
        return true;
    } catch(PDOException $exception) {
        return false;
    }
}
}
