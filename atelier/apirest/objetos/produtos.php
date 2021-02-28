<?php
class Produto{

    //ligacao à base de dados
    private $conn;
    private $tname="produtos";
    //definir propriedades do objeto (atributos)
    public $id;
    public $nome;
    public $descricao;
    public $preco;
    public $id_categoria;
    public $nome_categoria; //nome da categoria referenciado atraves da chave primaria da tabela
    public $criacao;
    public $modificacao;
    //construtor da classe
    public function __construct($db)
    {
        $this->conn=$db;
    }
    //funcao para exportar para um ficheiro externo
    public function export_csv(){
        $qry="SELECT id, nome, descricao, preco,criacao,modificacao FROM ".$this->tname." order by nome";//ordem alfabetica de nome
        $st=$this->conn->prepare($qry);
        $num=$st->rowCount();//numero de registos devolvidos na query
        if($num>0)
        {
            $out="ID;NOME;DESCRICAO;PRECO;CRIACAO;MODIFICACAO\n";
            while($row=$st->fetch(PDO::FETCH_ASSOC)){
                extract($row);
                $out.="{$id};\"{$nome}\";\"{$descricao}\";{$preco};{$criacao};{$modificacao}\n";

            }
        }
        else
        {
            //sem resultados a serem exibidos
            $out="Não existem produtos na base de dados.\n";
        }
        return $out;
    }
    //ler os produtos na base de dados
    public function read()
    {
        $qry="SELECT c.nome as nome_categoria,p.id,p.nome,p.descricao,p.id_categoria,p.preco,p.criacao,p.modificacao FROM ".$this->tname." p LEFT JOIN categorias c ON p.id_categoria=c.id ORDER BY p.criacao DESC";
        $st=$this->conn->prepare($qry);
        $st->execute();
        return $st;
    }
    //ler um registo com base no ID
    public function readOne()
    {
        $qry="SELECT c.nome as nome_categoria,p.id,p.nome,p.descricao,p.id_categoria,p.preco,p.criacao,p.modificacao FROM ".$this->tname." p LEFT JOIN categorias c ON p.id_categoria=c.id 
        WHERE p.id=?
        LIMIT 0,1";

        $st=$this->conn->prepare($qry);
        $st->bindParam(1,$this->id);
        $st->execute();
        $row=$st->fetch(PDO::FETCH_ASSOC);
        //verificar se existem registos
        if ($row)
        {
            $this->nome=$row["nome"];
            $this->preco=$row["preco"];
            $this->nome_categoria=$row["nome_categoria"];
            $this->descricao=$row["descricao"];
            $this->modificacao=$row["modificacao"];
            $this->criacao=$row["criacao"];
            $this->id_categoria=$row["id_categoria"];
        }
        else
        {//se nao existirem registos
            $this->nome=null;
        }
    }

    //metodo para criar produtos
    public function create()
    {
        $qry="INSERT INTO ".$this->tname." SET nome=?, descricao=?, id_categoria=?,criacao=?, preco=?,modificacao=?";
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->descricao=htmlspecialchars(strip_tags($this->descricao));
        $this->id_categoria=htmlspecialchars(strip_tags($this->id_categoria));
        $this->criacao=htmlspecialchars(strip_tags($this->criacao));
        $this->preco=htmlspecialchars(strip_tags($this->preco));
        $st=$this->conn->prepare($qry);
        $st->bindParam(1,$this->nome);
        $st->bindParam(2,$this->descricao);
        $st->bindParam(3,$this->id_categoria);
        $st->bindParam(4,$this->criacao);
        $st->bindParam(5,$this->preco);
        $st->bindParam(6,$this->criacao);
        if($st->execute())
        {
            return true;

        }
        else
        {
            print_r($st->errorInfo());// devolve o erro ao inserir do registo na BD
            return false;
        }
    }
    //listar registos apos uma procura de forma paginada
    public function searchPaging($keywords,$from_record_num,$records_per_page)
    {
        $qry="SELECT c.nome as nome_categoria, p.id,p.nome,p.descricao,p.preco,p.id_categoria,p.criacao,p.modificacao FROM ".$this->tname." p LEFT JOIN categorias c ON p.id_categoria=c.id and p.nome LIKE ? OR p.descricao LIKE ? ORDER BY p.criacao DESC LIMIT ?,?";
        $st=$this->conn->prepare($qry);
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords="%{$keywords}%";
        $st->bindParam(1,$keywords);
        $st->bindParam(2,$keywords);
        $st->bindParam(3,$from_record_num);
        $st->bindParam(4,$records_per_page);
        $st->execute();
        return $st;

    }
    //metodo para contar registos quando fazemos uma pesquisa
    public function countSearch($keywords)
    {
        $qry="SELECT COUNT(*) as total_rows FROM ".$this->tname." p LEFT JOIN categorias c ON p.id_categoria=c.id  and p.nome LIKE ? OR p.descricao LIKE ?";
        $st=$this->conn->prepare($qry);
        $keywords=htmlspecialchars(strip_tags($keywords));
        $keywords="%{$keywords}%";
        $st->bindParam(1,$keywords);
        $st->bindParam(2,$keywords);
        $st->execute();
        $row=$st->fetch(PDO::FETCH_ASSOC);
        return $row["total_rows"];
    }

    //filtrar produtos em funcao da categoria
    public function readProductsbyCategoryID()
    {
        $qry="SELECT c.nome as nome_categoria, p.id,p.nome,p.descricao,p.preco,p.id_categoria,p.criacao,p.modificacao FROM ".$this->tname." p LEFT JOIN categorias c ON p.id_categoria=c.id WHERE p.id_categoria=? ORDER BY p.criacao DESC";
        $st=$this->conn->prepare($qry);
        $st->bindParam(1,$this->id_categoria);
        $st->execute();
        return $st;
    }

    //leitura de todos os registos paginados
    public function readPaging($from_record_num,$records_per_page)
    {
        $qry="SELECT c.nome as nome_categoria,p.id,p.nome,p.descricao,p.id_categoria,p.preco,p.criacao,p.modificacao FROM ".$this->tname." p LEFT JOIN categorias c ON p.id_categoria=c.id ORDER BY p.criacao DESC LIMIT ?,?";
        $st=$this->conn->prepare($qry);
        $st->bindParam(1,$from_record_num);
        $st->bindParam(2,$records_per_page);
        $st->execute();
        return $st;
    }

    //alterar um produto
    public function update()
    {
        $qry="UPDATE ".$this->tname." SET nome=?, preco=?, descricao=?, id_categoria=?,modificacao=? WHERE id=?";
        //$qry="UPDATE ".$this->tname." SET nome=:nome, preco=:preco, descricao=:descricao, id_categoria=:id_categoria,modificacao=:modificacao WHERE id=:id";
        $st=$this->conn->prepare($qry);
        $st->bindParam(1,htmlspecialchars(strip_tags($this->nome)));
        $st->bindParam(2,htmlspecialchars(strip_tags($this->preco)));
        $st->bindParam(3,htmlspecialchars(strip_tags($this->descricao)));
        $st->bindParam(4,htmlspecialchars(strip_tags($this->id_categoria)));
        $st->bindParam(5,htmlspecialchars(strip_tags($this->modificacao)));
        $st->bindParam(6,htmlspecialchars(strip_tags($this->id)));
        /*
        $st->bindParam(':nome',$this->nome);
        $st->bindParam(':preco',$this->preco);
        $st->bindParam(':descricao',$this->descricao);
        $st->bindParam(':id_categoria',$this->id_categoria);
        $st->bindParam(':modificacao',$this->modificacao);
        */
        
        if($st->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //remover registo
    public function delete()
    {
        $qry="DELETE FROM ".$this->tname."  WHERE id=?";
        $st=$this->conn->prepare($qry);
        $st->bindParam(1,htmlspecialchars(strip_tags($this->id)));
        if($st->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    //contar o numero de registos para exibir na paginacao quando utilizamos o readPaging
    public function count()
    {
        $qry="SELECT COUNT(*) as total_rows FROM ".$this->tname." p LEFT JOIN categorias c ON p.id_categoria=c.id ";
        $st=$this->conn->prepare($qry);
        $st->execute();
        $row=$st->fetch(PDO::FETCH_ASSOC);
        return $row["total_rows"];
    }

}
?>