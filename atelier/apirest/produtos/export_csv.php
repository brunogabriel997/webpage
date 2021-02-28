<?php

//incluir ficheiros externos
include_once "../config/database.php";
include_once "../objetos/produtos.php";
/*
//fazer ligacao à bd
$database= new Database();
$db=$database->getConnection();

$prod=new Produto($db);
header("Content-type:text/x-csv");
header("Content-Disposition:attachment;filename=produtos_".date('Y-m-d_H-i-s').".csv");
echo $prod->export_csv();
*/

//construir a ligacao
$database=new Database();
$bd=$database->getConnection();
//criar instancia da classe categoria
$cate=new Produto($bd);
$st=$cate->export_csv();
//definir que será uma pagina/ficheiro csv
header("Content-Type:text/x-csv");
header("Content-Disposition:attachment;filename=categorias_".date('Y-m-d_H-i-s').".csv");
echo $st;
?>