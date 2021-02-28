<?php
//definir variaveis globais
//numero de registos por pagina
$records_per_page=5;
//definir pagina atual
$page=isset($_GET['page'])?$_GET["page"]:1;
/*
if (isset($_GET['page']))
{
    $page=$_GET["page"];
}
else
{
    $page=1;
}
*/

//limite associado aos selects
$from_record_num=($records_per_page*$page)-$records_per_page;

//definir home page website
$home_url="http://localhost:8080/atelier/";


?>