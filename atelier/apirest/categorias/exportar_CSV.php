<?php

include_once "../config/database.php";
include_once "../objetos/categorias.php";

//construir a ligacao
$database=new Database();
$bd=$database->getConnection();
//criar instancia da classe categoria
$cate=new Categoria($bd);
$st=$cate->exportar_CSV();
//definir que será uma pagina/ficheiro csv
header("Content-Type:text/x-csv");
header("Content-Disposition:attachment;filename=categorias_".date('Y-m-d_H-i-s').".csv");
echo $st;

?>