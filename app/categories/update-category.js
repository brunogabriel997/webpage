$(document).ready(function(){
    $(document).on('click','.update-category-button', function(){
        
        var alterar="";
         //retirar valor do identificador
         var id=$(this).attr('data-id');
         $.getJSON("http://localhost:8080/apirest/categorias/read_one.php?id="+id,function(data){
 
            var lista="";
            lista+=cria_bt_lista();
            lista+="<form id='update-category-form' action='#' method='post'>";
            lista+="<table class='table table-bordered table-hover'>";
            lista+="<tr>";
            lista+="<td class='w-30-pct'>Nome</td>";
            lista+="<td class='w-70-pct'><input type='text' value='"+data.nome+"' name='nome' class='form-control'></td>";
            lista+="</tr>";
            lista+="<tr>";
            lista+="<td class='w-30-pct'>Descrição</td>";
            lista+="<td class='w-70-pct'><textarea name='descricao' class='form-control'>"+data.descricao+"</textarea></td>";
            lista+="</tr>";
            lista+="<tr>";
            lista+="<td class='w-30-pct'><input type='hidden' name='id' value='"+data.id+"'></td>";
            lista+="<td class='w-70-pct'><button type='submit' class='btn btn-info'>";
            lista+="<span class='glyphicon glyphicon-edit'></span> Alterar</button></td>";
            lista+="</tr>";
            lista+="</table>";
            lista+="</form>";
            alterar+=lista;
            //alterar o conteudo
            $('#page-content').html(alterar);
            changeTitle("Alterar Categoria #"+ data.id);
        });
    });

    $(document).on('submit','#update-category-form', function(){
          // get form data
          var form_data=JSON.stringify($(this).serializeObject());

          // submit form data to api
          $.ajax({
              url: "http://localhost:8080/apirest/categorias/update.php",
              type : "POST",
              contentType : 'application/json',
              data : form_data,
              success : function(result) {
                  // categ
                  showCategories();
              },
              error: function(xhr, resp, text) {
                  console.log(xhr, resp, text);
              }
          });

          return false;
    });

});