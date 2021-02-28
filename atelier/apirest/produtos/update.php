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
    !empty($data->nome) &&
    !empty($data->descricao) &&
    !empty($data->id_categoria) &&
    !empty($data->preco) 
)
{
    $prod->id=$data->id;
    $prod->nome=$data->nome;
    $prod->descricao=$data->descricao;
    $prod->id_categoria=$data->id_categoria;
    $prod->preco=$data->preco;
    $prod->modificacao=date('Y-m-d H:i:s');
    if($prod->update()){
        echo json_encode(array("message"=>"Produto alterado com sucesso."));
    }
    else
    {
        echo json_encode(array("message"=>"Erro ao alterar produto."));
    }

}
else
{
    echo json_encode(array("message"=>"Informação insuficiente para criar produto."));
}
?>