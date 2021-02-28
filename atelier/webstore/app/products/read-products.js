$(document).ready(function(){
//alert("produtos");
    //mostrar a primeira página de todos os produtos quando clico no botao de produtos
    $(document).on('click','.read-products-button', function(){
        //alert("botao");
        //invocar funcao para listar todos os produtos
        showProductsFirstPage();

    });



    
});

function showProductsFirstPage()
    {
        var url_js="http://localhost:8080/atelier/apirest/produtos/read.php";
        showProduct(url_js);
    }
    function  showProduct(url_js)
    {
        removerClasse();// remover todos os items ativos
        $("#products-nav").addClass("active");//acrescentar active às classes do menu produto
        changeTitle("Lista de produtos"); //alterar o titulo da pagina
        $.getJSON(url_js,function(response){
            productTemplate(response,"");
        });
    }