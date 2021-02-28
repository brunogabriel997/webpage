<?php
header("Access-control-Allow-Origin:*");
header("Content-Type:application/json; Charset=UTF-8");
include_once '../config/database.php';
include_once '../objetos/categorias.php';
//instanciar classe de bd
$database= new Database();
$db=$database->getConnection();

//instanciar categoria
$cate= new Categoria($db);
$st=$cate->ler();
$num=$st->rowCount();
if($num>0)
//existem registos na BD
{
    $categorias=array();
    $categorias["records"]=array();
    while ($row=$st->fetch(PDO::FETCH_ASSOC))
    {
        //extrair cada linha
        extract($row);
        $item=array(
            "id"=>$id,
            "nome"=>$nome,
            "descricao"=>html_entity_decode($descricao)
        );
        array_push($categorias["records"],$item);
    }
    http_response_code(200);
    echo json_encode($categorias);

}
//nao temos registos na BD
else
{
http_response_code(404);
echo json_encode(array("message"=>"Sem categorias disponíveis."));
}

?>