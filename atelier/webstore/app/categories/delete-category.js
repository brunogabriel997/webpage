$(document).ready(function(){
    $(document).on('click','.delete-category-button',function(){
        //retirar valor do identificador
        var id=$(this).attr('data-id');
        //criar uma caixa de confirmacao
        bootbox.confirm({
                message:"<h4>Tem a certeza?</h4>",
                buttons:{
                    confirm:{
                        label:'<span class="glyphicon glyphicon-ok"></span>Sim',
                        className:'btn-danger'
                    },
                    cancel:{
                        label:'<span class="glyphicon glyphicon-remove"></span>Não',
                        className:'btn-primary'
                    }
                },
                callback: function(result)
                {
                    if (result==true)
                    {
                        $.ajax({
                            url:"http://localhost:8080/atelier/apirest/categorias/delete.php",
                            type:"POST",
                            dataType:'json',
                            data:JSON.stringify({id:id}),
                            success:function(result)
                            {
                                showCategories();
                            },
                            error:function(xhr,resp,text){
                                console.log(xhr,resp,text);
                            }
                        });
                    }
                }

        });
    });



});