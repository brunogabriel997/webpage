function productTemplate(response,keywords)
{
    html="";

//exibir formulario de pesquia
html+=mostrar_form_pesquisa(keywords);
//exibir botoes associados aos produtos
html+=criar_bt_p();

    //exibir a lista dos produtos

if (response.message=="Sem produtos.")
{
    //não existem produtos
    html+="<div class='overflow-hidden w-100-pct'>";
    html+="<div class='alert alert-danger'>Sem produtos registados.</div>"
    html+="</div>";
}
else
{
    //existem produtos e vamos mostrar numa tabela
    html+="<table class='table table-bordered table-hover'>";
    //construir o cabeçalho
        html+="<tr>";
            html+="<th class='w-25-pct'>Nome</th>";
            html+="<th class='w-10-pct'>Preço</th>";
            html+="<th class='w-15-pct'>Categoria</th>";
            html+="<th class='w-25-pct text-align-center'></th>";
        html+="</tr>";
        //percorrer todos os registos
        $.each(response.records, function(key,val){
                var prod={
                    "id":val.id,
                    "nome":val.nome,
                    "descricao":val.descricao,
                    "preco":val.preco,
                    "id_categoria":val.id_categoria,
                    "nome_categoria":val.nome_categoria,
                    "criacao":val.criacao,
                    "modificacao":val.modificacao
                }
                html+="<tr data-product-id='"+val.id+"'>";
                    html+="<td class='product_td'>"+val.nome+"</td>";
                    html+="<td class='product_td'>"+val.preco+"</td>";
                    html+="<td class='product_td' data-category-id='"+val.id_categoria+"'>"+val.nome_categoria+"</td>";
                    html+="<td>";
                    html+="<button class='btn btn-primary m-r-10px read-one-product-button' data-id='"+val.id+"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>";
                    html+="<button class='btn btn-info m-r-10px update-product-button' data-id='"+val.id+"'><span class='glyphicon glyphicon-edit'></span> Editar</button>";
                    html+="<button class='btn btn-danger m-r-10px delete-product-button' data-id='"+val.id+"'><span class='glyphicon glyphicon-remove'></span> Remover</button>";
                    html+="</td>";
                html+="</tr>"
        });
    html+="</table>";
}
    $("#page-content").html(html);
}

function criar_bt_p()
{
    txt="";
    txt+="<div id='create-product' class='btn btn-primary pull-right m-b-15px create-product-button'><span class='glyphicon glyphicon-plus'></span> Criar produto</div>";
    //botao para exportar para excel
    txt+="<a href='http://localhost:8080/atelier/apirest/produtos/export_csv.php' class='btn btn-info pull-right margin-right-1em' title='Descarregar ficheiro'><span class='glyphicon glyphicon-download-alt'></span> Exportar CSV</a>";
    return txt;
}
function mostrar_form_pesquisa(keywords)
{
    /*
    txt="";
    txt+="<form id='search-product-form' action='#' method='post'>";
        txt+="<div class='input-group pull-left w-30-pct' title='Pesquisar produtos' data-placement='right'>";
            txt+="<input type='text' value='"+keywords+"' name='keywords' class='form-control product-search' placeholder='Pesquisar...'>";
            txt+="<span class='input-group-btn'>";
                txt+="<button type='submit' class='btn btn-default'><span class='glyphicon glyphicon-search'></span></button>";
            txt+="</span>";
        txt+="</div>"
    txt+="</form>";
    return txt;
    */
   
   var prod="";
   prod+="<form id='search-product-form' action='#' method='post'>";
    prod+="<div class='input-group pull-left w-30-pct'";
        prod+="<data-toggle='tooltip' title='Pesquisar Produtos' data-placement='right'>";
            prod+="<input type='text' value=\""+keywords+"\" name='keywords' ";
                prod+="class='form-control product-search-keywords' placeholder='Pesquisar...'>";
                prod+="<span class='input-group-btn'>";
                prod+="<button type='submit' class='btn btn-default'>";
                prod+="<span class='glyphicon glyphicon-search'></span>";
                prod+="</button>";
                prod+="</span>";
                prod+="</div>";
                prod+="</form>";
   return prod;
}