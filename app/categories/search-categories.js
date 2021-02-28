$(document).ready(function(){

    $(document).on('submit','#search-category-form',function(){

        //ler o conteudo da caixa de pesquisa
        var keywords=$(this).find(":input[name='keywords']").val();
        
        $.getJSON("http://localhost:8080/apirest/categorias/search_paging.php?s="+keywords,function(response){
    
           alert(keywords);
           alert(response);
            //construir o template das categorias
            readCategories(response,keywords);
            changeTitle("Pesquisa de categorias:" + keywords);
        
        });

        //evitar o refresh da pagina completa
        return false;
    })

});


