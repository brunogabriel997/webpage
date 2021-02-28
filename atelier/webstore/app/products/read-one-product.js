$(document).ready(function()
{
  
    $(document).on('click','.read-one-product-button',function()
    {

        id=$(this).attr('data-id');

        $.getJSON("http://localhost:8080/atelier/apirest/produtos/read_one.php?id="+id, function(dados)
        {
            
            htmlp="";
            htmlp+=cria_lista_produtos_bt();
            htmlp+="<table class='table table-bordered table-hover'>";
                htmlp+="<tr>";
                    htmlp+="<td>Nome</td>";
                    htmlp+="<td>"+dados.nome+"</td>";
                htmlp+="</tr>";
                htmlp+="<tr>";
                    htmlp+="<td>Preço</td>";
                    htmlp+="<td>"+dados.preco+"</td>";
                htmlp+="</tr>";
                htmlp+="<tr>";
                    htmlp+="<td>Descrição</td>";
                    htmlp+="<td>"+dados.descricao+"</td>";
                htmlp+="</tr>";
                htmlp+="<tr>";
                    htmlp+="<td>Categoria</td>";
                    htmlp+="<td>"+dados.nome_categoria+"</td>";
                htmlp+="</tr>";
                htmlp+="<tr>";
                    htmlp+="<td>Criado em</td>";
                    htmlp+="<td>"+dados.criacao+"</td>";
                htmlp+="</tr>";
                htmlp+="<tr>";
                    htmlp+="<td>Alterado em</td>";
                    htmlp+="<td>"+dados.modificacao+"</td>";
                htmlp+="</tr>";
            htmlp+="</table>";
            $("#page-content").html(htmlp);
            changeTitle("Produto #"+ id )
        });
    });

});