<?php
//definir cabeçalhos
header("Access-control-Allow-Origin:*");
header("Content-Type:application/json; Charset=UTF-8");
//incluir classes
include_once "../config/config.php";
include_once "../config/database.php";
include_once "../config/util.php";
include_once "../objetos/categorias.php";

//util
$utilities= new Util();
//base de dados
$database=new Database();
$db=$database->getConnection();
//instanciar objeto categorias
$cat=new Categoria($db);
//query para listar todos os elementos paginados
$st=$cat->listar_todos_paginado($from_record_num,$records_per_page);
$num=$st->rowCount();

//verificar se existem registos para serem exibidos
if($num>0)
{
    //existem registos
    $categorias=array();
    $categorias["records"]=array();
    $categorias["paging"]=array();
    //percorrer as linhas de registos na BD
    while ($row=$st->fetch(PDO::FETCH_ASSOC))
    {
        //extrair linha
        extract($row);
        $item=array(
            "id"=>$id,
            "nome"=>$nome,
            "descricao"=>html_entity_decode($descricao)
        );
        array_push($categorias["records"],$item);
    }
    //incluir a paginacao
    $total_rows=$cat->calcular_total_registos();
    $page_url="{$home_url}categorias/read_paging.php?";
    $pagina=$utilities->getPaging($page,$total_rows,$records_per_page,$page_url);
    $categorias["paging"]=$pagina;
    echo json_encode($categorias);
}
else
{
    //sem registos
    echo json_encode(array("message"=>"Sem categorias disponíveis."));
}



?>