<?php
//cabecalhos
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

//incluir ficheiros
include_once "../config/config.php";
include_once "../config/database.php";
include_once "../objetos/produtos.php";
//instanciar bd e produtos
$database=new Database();
$db=$database->getConnection();
$prod=new Produto($db);
//retirar resultados de um formulario
$data=json_decode(file_get_contents("php://input"));
//validar conteudos do formulario
if(
    !empty($data->id)
)
{
    $prod->id=$data->id;
    
    if($prod->delete()){
        echo json_encode(array("message"=>"Produto removido com sucesso."));
    }
    else
    {
        echo json_encode(array("message"=>"Erro ao remover produto."));
    }

}
else
{
    echo json_encode(array("message"=>"Informação insuficiente para remover produto."));
}
?>