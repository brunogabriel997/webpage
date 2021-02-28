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

$prod->id_categoria=isset($_GET["id_cat"])?$_GET["id_cat"]:'0';

//query para listar produtos
$st=$prod->readProductsbyCategoryID();
$num=$st->rowCount();
if($num>0)
{
    $data="";
    $x=1;
    while ($row=$st->fetch(PDO::FETCH_ASSOC))
    {
        extract($row);
        $data.='{';
            $data.='"id":"'.$id.'",';
            $data.='"nome":"'.$nome.'",';
            $data.='"descricao":"'.$descricao.'",';
            $data.='"preco":"'.$preco.'",';
            $data.='"id_categoria":"'.$id_categoria.'",';
            $data.='"nome_categoria":"'.$nome_categoria.'",';
            $data.='"criacao":"'.$criacao.'",';
            $data.='"modificacao":"'.$modificacao.'"';
        $data.='}';
        $data.=($x<$num)?',':'';
        $x++;
    }
    echo '{"records":['.$data.']}';
}
else
{
    echo '{"records":[{}]}';
}
?>