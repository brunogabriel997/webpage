<?php
header("Access-control-Allow-Origin:*");
header("Content-Type:application/json; Charset=UTF-8");
header("Access-Control-Allow-Methods:GET");
include_once '../config/database.php';
include_once '../objetos/categorias.php';
//instanciar classe de bd
$database= new Database();
$db=$database->getConnection();

//instanciar categoria
$cate= new Categoria($db);
$cate->id=isset($_GET['id'])?$_GET['id']:die();
$cate->ler_registo();
$categoria=array(
    "id"=>$cate->id,
    "nome"=>$cate->nome,
    "descricao"=>$cate->descricao
);
print_r(json_encode($categoria));




?>