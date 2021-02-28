<?php
class Database
{
    //variaveis para ligacao
    private $host="localhost";
    private $dbname="atelier";
    private $dbport=3308;
    private $username="root";
    private $password="";
    private $ligacao="";
    public $conn;

    //metodo para aceder e criar ligacao à bd   
    public function getConnection()
    {
        $this->conn=null;
        $this->ligacao="mysql:host=".$this->host.";dbname=".$this->dbname.";port=".$this->dbport;
        try
        {
            $this->conn=new PDO($this->ligacao,$this->username,$this->password);
            $this->conn->exec("set names utf8");
            
        }
        catch(PDOException $ex)
        {
            echo "Erro na ligação: ".$ex->getMessage();
        }
        return $this->conn;
    }
}

?>