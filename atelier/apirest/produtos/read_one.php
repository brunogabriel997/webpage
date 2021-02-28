<?php
//cabecalhos
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");
header("Access-Control-Allow-Methods:GET");
//incluir ficheiros
include_once "../config/config.php";
include_once "../config/database.php";
include_once "../objetos/produtos.php";
//instanciar bd e produtos
$database=new Database();
$db=$database->getConnection();
$prod=new Produto($db);

//determinar qual o produto a ser exibido
$prod->id=(isset($_GET["id"])) ? $_GET["id"]:die();

//query para listar produtos
$st=$prod->readOne();
//verificar se o nome do produto existe
if($prod->nome!=null)
{



    $p_arr=array(
        "id"=>$prod->id,
        "nome"=>$prod->nome,
        "descricao"=>$prod->descricao,
        "preco"=>$prod->preco,
        "id_categoria"=>$prod->id_categoria,
        "nome_categoria"=>$prod->nome_categoria,
        "criacao"=>$prod->criacao,
        "modificacao"=>$prod->modificacao
    );
   
echo json_encode($p_arr);
}
else
{
    //sem produtos para listar
    echo json_encode(array("message"=>"Produto inexistente."));
}

?>