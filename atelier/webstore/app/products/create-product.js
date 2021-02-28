$(document).ready(function(){

    //clicar no br criar produto
    $(document).on('click','.create-product-button',function()
    {

       // alert("criar produto");
        //caixa de selecao com todas as categorias para conseguir associar um produto
        $.getJSON("http://localhost:8080/atelier/apirest/categorias/read.php", function(data)
        {
            htmcat="";
            htmcat+="<select name='id_categoria' class='form-control'>";
            $.each(data.records,function(key,val)
            {
                htmcat+="<option value='"+val.id+"'>"+val.nome+"</option>";
            })
            htmcat+="</select>";

            html="";
            html+=cria_lista_produtos_bt();
            html+="<form id='create-product-form' method='post'>";
            html+="<table class='table table-bordered table-responsive table-hover'>";
                html+="<tr>";
                    html+="<td>Nome</td>";
                    html+="<td><input type='text' name='nome' class='form-control' required></td>";
                html+="</tr>";
                html+="<tr>";
                    html+="<td>Preço</td>";
                    html+="<td><input type='text' name='preco' class='form-control' required></td>";
                html+="</tr>";
                html+="<tr>";
                    html+="<td>Descrição</td>";
                    html+="<td><textarea  name='descricao' class='form-control' required></textarea></textarea></td>";
                html+="</tr>";
                html+="<tr>";
                    html+="<td>Categoria</td>";
                    html+="<td>"+htmcat+"</td>";
                 html+="</tr>";
                 html+="<tr>";
                    html+="<td></td>";
                    html+="<td><button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Criar</button></td>";
                 html+="</tr>";
            html+="</table>";
            
            html+="</form>";
           // html+=htmcat;
            $("#page-content").html(html);
            changeTitle("Criar Produto");
        });
        
    });


$(document).on('submit','#create-product-form', function()
{
   // alert("criar");
    form_data=JSON.stringify($(this).serializeObject());
    $.ajax({
        url:"http://localhost:8080/atelier/apirest/produtos/create.php",
        type:"POST",
        contentType:'application/json',
        data:form_data,
        success: function(result)
        {
                //alert("sucesso");
                showProductsFirstPage();
        },
        error: function(xhr,resp,text){
            console.log(xhr,resp,text);
        }

    });
    return false; //evitar o refresh da pagina
});



});