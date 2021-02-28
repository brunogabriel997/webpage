<?php
//class categoria

class Categoria
{
    //ligacao à bd
    private $conn;
    private $table="Categorias";
    //propriedades do objeto
    public $id;
    public $nome;
    public $descricao;
    public $criacao;

    //definir construtor da classe
    public function __construct($db)
    {
        $this->conn=$db;
    }
    public function exportar_CSV()
    {
        $output="";
        $qry="SELECT id,nome,descricao,criacao FROM ".$this->table." ORDER BY nome";
        $st=$this->conn->prepare($qry);
        $st->execute();
        $num=$st->rowCount();
        if ($num>0)
        {
            $output="ID;NOME;DESCRICAO;CRIACAO\n";
            while ($row=$st->fetch(PDO::FETCH_ASSOC))
            {
                extract($row);
                $output.="{$id};\"{$nome}\";\"{$descricao}\";\"{$criacao}\n";
            }
        }
        else
        {
            $output="Sem Categorias registadas";
        }

        return $output;
    }
    public function remover_selecionado($ids)
    {
        $in_ids=str_repeat('?,',count($ids)-1).'?';
        $qry="DELETE FROM ".$this->table." WHERE id IN({$in_ids})";
        $st=$this->conn->prepare($qry);
        if($st->execute($ids))
        {
            return true;
        }
        else
        {
            return false;
        }

    }
    public function ler_registo()
    {
        $qry="SELECT nome,descricao FROM ".$this->table." WHERE id=? LIMIT 0,1";
        $st=$this->conn->prepare($qry);
        $st->bindParam(1,$this->id);
        $st->execute();
        $row=$st->fetch(PDO::FETCH_ASSOC);
        $this->nome=$row['nome'];
        $this->descricao=$row['descricao'];


    }
    public function alterar()
    {
        $qry="UPDATE ".$this->table." SET nome=:nome,descricao=:descricao WHERE id=:id";
        $st=$this->conn->prepare($qry);
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->descricao=htmlspecialchars(strip_tags($this->descricao));
        $this->id=htmlspecialchars(strip_tags($this->id));
        $st->bindParam(':id',$this->id);
        $st->bindParam(':descricao',$this->descricao);
        $st->bindParam(':nome',$this->nome);
        if ($st->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function remover()
    {
        $qry="DELETE FROM ".$this->table." WHERE id=?";
        $st=$this->conn->prepare($qry);
        $st->bindParam(1,$this->id);
        if ($st->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function criar()
    { 
        $qry="INSERT ".$this->table." SET nome=?, descricao=?, criacao=?";
        $st=$this->conn->prepare($qry);
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->descricao=htmlspecialchars(strip_tags($this->descricao));
        $this->criacao=htmlspecialchars(strip_tags($this->criacao));
        $st->bindParam(1,$this->nome);
        $st->bindParam(2,$this->descricao);
        $st->bindParam(3,$this->criacao);
        if ($st->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function calcular_total_registos()
    {
        $qry="SELECT COUNT(*) as total_rows FROM ".$this->table;
        $st=$this->conn->prepare($qry);
        $st->execute();
        $row=$st->fetch(PDO::FETCH_ASSOC);
        $total_rows=$row['total_rows'];
        return $total_rows;
    }
    public function contar_registos($keywords)
    {
        $qry="SELECT COUNT(*) as total_rows FROM ".$this->table." WHERE nome LIKE ? OR descricao LIKE ?";
        $st=$this->conn->prepare($qry);
        $keywords="%{$keywords}%";
        $st->bindParam(1,$keywords);
        $st->bindParam(2,$keywords);
        $st->execute();
        $row=$st->fetch(PDO::FETCH_ASSOC);
        $total_rows=$row['total_rows'];
        return $total_rows;
    }
    public function listar_todos_paginado($from_record_num,$records_per_page)
    {
        $qry="SELECT id,nome,descricao FROM ".$this->table." ORDER BY id DESC LIMIT ?,?";
        $st=$this->conn->prepare($qry);
        $st->bindParam(1,$from_record_num,PDO::PARAM_INT);
        $st->bindParam(2,$records_per_page,PDO::PARAM_INT);
        $st->execute();
        return $st;
    }
    public function ler()
    {
        $qry="SELECT id,nome,descricao FROM ".$this->table." ORDER BY nome";
        $st=$this->conn->prepare($qry);
        $st->execute();
        return $st;
    }
    public function procurar($keywords,$from_record_num,$records_per_page)
    {
        $qry="SELECT id,nome,descricao FROM ".$this->table." WHERE nome LIKE ? OR descricao LIKE ?
        ORDER BY nome ASC LIMIT ?,?";
        $st=$this->conn->prepare($qry);
        $keywords="%{$keywords}%";
        $st->bindParam(1,$keywords);
        $st->bindParam(2,$keywords);
        $st->bindParam(3,$from_record_num,PDO::PARAM_INT);
        $st->bindParam(4,$records_per_page,PDO::PARAM_INT);
        $st->execute();
        return $st;
    }
    public function lernomeporID()
    {
        $qry="SELECT nome FROM ".$this->table." WHERE id=? LIMIT 0,1";
        $st=$this->conn->prepare($qry);
        $st->bindParam(1,$this->id);
        $st->execute();
        $row=$st->fetch(PDO::FETCH_ASSOC);
        $this->nome=$row['nome'];

    }


}


?>