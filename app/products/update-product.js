$(document).ready(function()
{
    $(document).on('click','.update-product-button',function()
    {
        id=$(this).attr('data-id');
        $.getJSON("http://localhost:8080/apirest/produtos/read_one.php?id="+id, function(dados)
        {
        
            nome=dados.nome;
            preco=dados.preco;
            descricao=dados.descricao;
            id_cat=dados.id_categoria;
            nome_cat=dados.nome_categoria;

           
            $.getJSON("http://localhost:8080/apirest/categorias/read.php", function(data)
        {
            var htmlcat="";
            htmlcat+="<select name='id_categoria' class='form-control'>";
            $.each(data.records,function(key,val)
            {
               
                if(val.id==id_cat)
                {
                htmlcat+="<option value='"+val.id+"' selected>"+val.nome+"</option>";
                }
                else
                {
                    htmlcat+="<option value='"+val.id+"' >"+val.nome+"</option>";
                }
            });
            htmlcat+="</select>";
         
     
        
        htmlup="";
        htmlup+=cria_lista_produtos_bt();
        htmlup+="<form id='update-product-form' method='post'>";
            htmlup+="<table class='table table-bordered table-responsive table-hover'>";
                    htmlup+="<tr>";
                        htmlup+="<td>Nome</td>";
                        htmlup+="<td><input type='text' name='nome' value='"+nome+"' class='form-control' required></td>";
                    htmlup+="</tr>";
                    htmlup+="<tr>";
                        htmlup+="<td>Preço</td>";
                        htmlup+="<td><input type='text' name='preco' value='"+preco+"' class='form-control' required></td>";
                    htmlup+="</tr>";
                    htmlup+="<tr>";
                        htmlup+="<td>Descrição</td>";
                        htmlup+="<td><textarea  name='descricao' class='form-control' required>"+descricao+"</textarea></textarea></td>";
                    htmlup+="</tr>";
                    htmlup+="<tr>";
                        htmlup+="<td>Categoria</td>";
                        htmlup+="<td>"+htmlcat+"</td>";
                    htmlup+="</tr>";
                    htmlup+="<tr>";
                        htmlup+="<td><input type='hidden' name='id' value='"+id+"'></td>";
                        htmlup+="<td><button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-edit'></span> Editar</button></td>";
                    htmlup+="</tr>";
                htmlup+="</table>";
        htmlup+="</form>";
        $("#page-content").html(htmlup);
        changeTitle("Alterar Produto #" + id)
    });
    });
    });
$(document).on('submit','#update-product-form',function(){

    var form_data=JSON.stringify($(this).serializeObject());

          // submit form data to api
          $.ajax({
              url: "http://localhost:8080/apirest/produtos/update.php",
              type : "POST",
              contentType : 'application/json',
              data : form_data,
              success : function(result) {
                  // categ
                  showProductsFirstPage();
              },
              error: function(xhr, resp, text) {
                  console.log(xhr, resp, text);
              }
          });

          return false;
});

});