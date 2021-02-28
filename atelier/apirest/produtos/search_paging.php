<?php
//cabecalhos
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=UTF-8");
//incluir ficheiros
include_once "../config/config.php";
include_once "../config/database.php";
include_once "../objetos/produtos.php";
include_once "../config/util.php";
//instanciar bd e produtos
$database=new Database();
$db=$database->getConnection();
$prod=new Produto($db);

$utilities= new Util(); //para paginar a lista 
$keywords=isset($_GET["s"])?$_GET["s"]:'';
//query para listar produtos
$st=$prod->searchPaging($keywords,$from_record_num,$records_per_page);
//print_r( $st);
$num=$st->rowCount();
if($num>0)
{
    $p_arr=array();
    $p_arr["records"]=array();
    $p_arr["paging"]=array();
    while($row=$st->fetch(PDO::FETCH_ASSOC)){
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
        //paginar
        $total_rows=$prod->countSearch($keywords);
        $page_url="{$home_url}/produtos/search_paging.php?s={$keywords}&";
        $paging=$utilities->getPaging($page,$total_rows,$records_per_page,$page_url);
        $p_arr["paging"]=$paging;
        echo json_encode($p_arr);
    }

}
else
{
    //sem produtos para listar
    echo json_encode(array("message"=>"Sem produtos."));
}
?>