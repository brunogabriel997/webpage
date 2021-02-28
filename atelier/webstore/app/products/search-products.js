$(document).ready(function(){

    $(document).on('submit','#search-product-form',function(){

        //ler o conteudo da caixa de pesquisa
        var keywords=$(this).find(":input[name='keywords']").val();
        
        // PASSAR O QUE É DEVOLVIDO PELO SEARCH_PAGING PARA A VARIÁVEL "response"
        $.getJSON("http://localhost:8080/atelier/apirest/produtos/search_paging.php?s="+keywords,function(response){
    
            //alert(keywords);
            //alert(response);
            //construir o template das categorias
            productTemplate(response,keywords);
            changeTitle("Pesquisa de produtos: "+keywords);
        
        });

        //evitar o refresh da pagina completa
        return false;
    })

});
