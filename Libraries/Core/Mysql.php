<?php 

class Mysql extends Connection
{
    private $connect;
    private $strQuery;
    private $arrValues;

    function __construct(){
        $this->connect = new Connection();
        $this->connect = $this->connect->connect();
    }

    //Insert new register
    public function insert(string $query, array $arrValues){
        $this->strQuery = $query;
        $this->arrValues = $arrValues;
        $insert = $this->connect->prepare($this->strQuery);
        $resInsert = $insert->execute($this->arrValues);
        if($resInsert){
            $lastInsert = $this->connect->lastInsertId();
        }else{
            $lastInsert = 0;
        }
        return $lastInsert; 
    }

    //Research a register
    public function select(string $query){
        $this->strQuery = $query;
        $result = $this->connect->prepare($this->strQuery);
        $result->execute();
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    //Returns all records
    public function select_all(string $query){
        $this->strQuery = $query;
        $result = $this->connect->prepare($this->strQuery);
        $result->execute();
        $data = $result->fetchall(PDO::FETCH_ASSOC);
        return $data;
    }

    //Update register
    public function update(string $query, array $arrValues){
        $this->strQuery = $query;
        $this->arrVAlues = $arrValues;
        $update = $this->connect->prepare($this->strQuery);
        $resExecute = $update->execute($this->arrVAlues);
        return $resExecute;
    }

    //Delete register
    public function delete(string $query){
        $this->strQuery = $query;
        $result = $this->connect->prepare($this->strQuery);
        $del = $result->execute();
        return $del;
    }
}

?>