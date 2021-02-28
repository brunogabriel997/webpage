$(document).ready(function(){
    //verificar se foi clicado o botao
    $(document).on('click','.create-category-button',function(){
        var criar="";
        criar+=cria_bt_lista();
    criar+="<form id='create-category-form' action='#' method='post' border=0>";
    criar+="<table class='table table-hover table-responsive table-bordered'>";
    criar+="<tr>";
    criar+="<td>Nome</td>";
    criar+="<td><input type='text' name='nome' class='form-control' required></td>";
    criar+="</tr>";
    criar+="<tr>";
    criar+="<td>Descrição</td>";
    criar+="<td><textarea  name='descricao' class='form-control' required></textarea></td>";
    criar+="</tr>";
    criar+="<tr>";
    criar+="<td></td>";
    criar+="<td><button type='submit' class='btn btn-primary'>";
    criar+="<span class='glyphicon glyphicon-plus'></span> Criar</button></td>";
    criar+="</tr>";

    criar+="</table>"
    criar+="</form>";
        $("#page-content").html(criar);
        changeTitle("Criar nova Categoria");
    });



    //invocar o envio de um formulario
    $(document).on('submit', '#create-category-form', function(){

            // get form data
            var form_data=JSON.stringify($(this).serializeObject());

            // submit form data to api
            $.ajax({
                url: "http://localhost:8080/atelier/apirest/categorias/create.php",
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

