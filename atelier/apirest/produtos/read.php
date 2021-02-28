<?php
//cabecalhos
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");
//incluir ficheiros
include_once "../config/config.php";
include_once "../config/database.php";
include_once "../objetos/produtos.php";
//instanciar bd e produtos
$database=new Database();
$db=$database->getConnection();
$prod=new Produto($db);

//query para listar produtos
$st=$prod->read();


//contar o numero de registos que vai ser devolvido
$num=$st->rowCount();
if($num>0)
{
$p_arr=array();
$p_arr["records"]=array();
while($row=$st->fetch(PDO::FETCH_ASSOC))
{
    extract($row);
    $item=array(
        "id"=>$id,
        "nome"=>$nome,
        "descricao"=>$descricao,
        "preco"=>$preco,
        "id_categoria"=>$id_categoria,
        "nome_categoria"=>$nome_categoria,
        "criacao"=>$criacao,
        "modificacao"=>$modificacao
    );
    array_push($p_arr["records"],$item);
}
echo json_encode($p_arr);
}
else
{
    //sem produtos para listar
    echo json_encode(array("message"=>"Sem produtos."));
}

?>