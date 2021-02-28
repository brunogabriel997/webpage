//aguardar pelo carregamento da pagina
$(document).ready(function(){

    //verificar se foi clicada a opção categorias
    $(document).on('click','.read-categories-button',function(){
        //listar categorias
        showCategories();
    });
});

function showCategories()
{
    //fazer a ligação à api
    var json_url="http://localhost:8080/atelier/apirest/categorias/read_paging.php";
    showCat(json_url);

}
function showCat(json_url)
{  
     removerClasse();
    //ativar a opcao categorias
    $("#categories-nav").addClass("active");
    $.getJSON(json_url,function(response){
        readCategories(response,"");
    })
}