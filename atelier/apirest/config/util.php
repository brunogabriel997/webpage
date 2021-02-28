<?php

class Util
{
    public function getPaging($page,$total_rows,$records_per_page,$page_url)
    {
        //vetor de paginas
        $paging=array();
        $paging["first"]=$page>1?"{$page_url}page=1":"";
        //calcular o numero total de páginas
        $total_pages=ceil($total_rows/$records_per_page);
        //numero de hiperligacoes
        $range=2;
        $initial_num=$page-$range;
        $condition_limit_num=($page+$range)+1;
        $paging["pages"]=array();
        $page_count=0;
        for ($x=$initial_num;$x<$condition_limit_num;$x++)
        {
            //verificar se o $x é maior que 0 e simultaneamente o $x é menor ou igual
            // ao numero total de paginas
            if(($x>0) && ($x<=$total_rows))
            {
                $paging["pages"][$page_count]["page"]=$x;
                $paging["pages"][$page_count]["url"]="{$page_url}page={$x}";
                $paging["pages"][$page_count]["current_page"]=$x==$page?"yes":"no";
                $page_count++;
            }
        }

        //definir ultima pagina
        $paging["last"]=$page<$total_pages?"{$page_url}page={$total_pages}":"";
        
        //devolver a paginacao ao utilizador
        return $paging;
    }
}
?>