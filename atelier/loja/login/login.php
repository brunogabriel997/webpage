<?php
//class categoria

class iniciar
{
    //ligacao à bd
    private $conn;
    private $table="users";
    //propriedades do objeto
    public $id;
    public $utilizador;
    public $palavrapasse;
    public $criacao;

    //definir construtor da classe
    public function __construct($db)
    {
        $this->conn=$db;
    }
    public function procurar($keywords1,$keywords2)
    {
        $qry="SELECT id,username,passwords FROM ".$this->table." WHERE username LIKE ? AND passwords LIKE ?";
        $st=$this->conn->prepare($qry);
        $keywords1="%{$keywords1}%";
        $keywords2="%{$keywords2}%";
        $st->bindParam(1,$keywords1);
        $st->bindParam(2,$keywords2);
        $st->execute();
        return $st;
    }
}





?>