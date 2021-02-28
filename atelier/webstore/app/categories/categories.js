function readCategories(response,keywords)
{
    
//definir variavel para construir o html
var html="";

//criar pesquisa
html+=catsearch(keywords);

// criar botao para inserir categorias
html+=catCreate();
//criar botao para exportar para csv
html+=catExport();


//verificar se existem categorias a ser exibidas
if(response.message=="Sem categorias disponíveis.")
{
    //nao existem categorias na BD
    html+="<div class='overflow-hidden w-100-pct'>";
        html+="<div class='alert alert-danger'>"+response.message+"</div>";
    html+="</div>";
}
else
{
    //listar categorias que estao na BD
    html+="<table class='table table-bordered table-hover'>";
    //cabecalho da tabela
        html+="<tr>";
            html+="<th class='w-30-pct'>Nome</th>";
            html+="<th class='w-30-pct'>Descrição</th>";
            html+="<th class='w-30-pct'></th>";
        html+="</tr>";
        //lista de resultados
     
        $.each(response.records, function(key,val){
            var category={
                "id":val.id,
                "nome":val.nome,
                "descricao":val.descricao
            };
            //linha de cada uma das categorias
            html+="<tr data-category-id='"+val.id+"'>";
            html+=getLine(category);
            html+="</tr>";
        });

    html+="</table>";
}
$("#page-content").html(html);
changeTitle("Lista de Categorias");
}

function getLine(category)
{
    var cat="";
    cat+="<td class='category_td'>"+category["nome"]+"</td>";
    cat+="<td class='category_td'>"+category["descricao"]+"</td>";
    cat+="<td>";
    //botao para mostrar o conteudo
        cat+="<button class='btn btn-primary m-r-10px read-one-category-button' data-id='"+category["id"]+"'>";
        cat+="<span class='glyphicon glyphicon-eye-open'></span> Ver";
        cat+="</button>";
    //botao para editar o conteudo
        cat+="<button class='btn btn-info m-r-10px update-category-button' data-id='"+category["id"]+"'>";
        cat+="<span class='glyphicon glyphicon-edit'></span> Editar";
        cat+="</button>";
    //botao para remover o conteudo
       cat+="<button class='btn btn-danger m-r-10px delete-category-button' data-id='"+category["id"]+"'>";
       cat+="<span class='glyphicon glyphicon-remove'></span> Remover";
       cat+="</button>"

    cat+="</td>";
    return cat;
}
function catCreate()
{
    var cat="";
    cat+="<div id='create-category' class='btn btn-primary pull-right m-b-15px create-category-button'>";
    cat+="<span class='glyphicon glyphicon-plus'></span> Nova Categoria";
    cat+="</div>";
    return cat;
}
function catExport()
{
    var cat="";
    cat+="<a href='http://localhost:8080/atelier/apirest/categorias/exportar_CSV.php' class='btn btn-info pull-right margin-right-1em'>";
    cat+="<span class='glyphicon glyphicon-download-alt'></span> Exportar";
    cat+="</a>";
    return cat;
}

function catsearch(keywords)
{
    var cat="";
    cat+="<form id='search-category-form' action='#' method='post'>";
        cat+="<div class='input-group pull-left w-30-pct'";
        cat+=" data-toggle='tooltip' title='Pesquisar Categorias' data-placement='right'>";
            cat+="<input type='text' value=\""+keywords+"\" name='keywords' ";
            cat+="class='form-control category-search-keywords' placeholder='Pesquisar...'>";
            cat+="<span class='input-group-btn'>";
                cat+="<button  type='submit' class='btn btn-default'>";
                    cat+="<span class='glyphicon glyphicon-search'></span>";
                cat+="</button>";
            cat+="</span>";
        cat+="</div>";
    cat+="</form>";
    return cat;
}