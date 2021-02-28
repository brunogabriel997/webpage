<?php
header("Access-control-Allow-Origin:*");
header("Content-Type:application/json; Charset=UTF-8");
header("Access-Control-Allow-Methods:POST");
include_once '../config/database.php';
include_once '../objetos/categorias.php';
//instanciar classe de bd
$database= new Database();
$db=$database->getConnection();

//instanciar categoria
$cate= new Categoria($db);

//retirar valores do formulario
$data=json_decode(file_get_contents("php://input"));
$cate->nome=$data->nome;
$cate->descricao=$data->descricao;
$cate->criacao=date('Y-m-d H:i:s');
if($cate->criar())
{
    //foi possivel criar
    echo json_encode(array("message"=>"Categoria criada com sucesso."));
}
//impossivel criar
else
{
 echo json_encode(array("message"=>"Erro na criação da categoria."));
}


?>