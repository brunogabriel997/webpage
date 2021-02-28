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
//procurar($keywords,$from_record_num,$records_per_page)
$keywords=isset($_GET["s"])?$_GET["s"]:"";
$st=$cat->procurar($keywords,$from_record_num,$records_per_page);
$num=$st->rowCount();
//verificar se existem registos
if($num>0)
{
    //com categorias
    //definir vetores
    $categorias=array();
    $categorias["records"]=array();
    $categorias["paging"]=array();
    while($row=$st->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        $item=array(
            "id"=>$id,
            "nome"=>$nome,
            "descricao"=>$descricao
        );
     //  array_push($categorias,$item);
        array_push($categorias["records"],$item);
    }
    $total_rows=$cat->contar_registos($keywords);
    $page_url="{$home_url}categorias/search_paging?s={$keywords}&";
    $paginacao=$utilities->getPaging($page,$total_rows,$records_per_page,$page_url);
    $categorias["paging"]=$paginacao;
    echo json_encode($categorias);
}
else
{
 //sem registos
 echo json_encode(array("message"=>"Sem categorias disponíveis."));
}

?>