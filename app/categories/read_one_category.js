$(document).ready(function(){
    console.log("ver");
    $(document).on('click','.read-one-category-button',function(){
      
        //retirar valor do identificador
        var id=$(this).attr('data-id');
        $.getJSON("http://localhost:8080/apirest/categorias/read_one.php?id="+id,function(data){

        var lista="";
        lista+=cria_bt_lista();
        lista+="<table class='table table-bordered table-hover'>";
        lista+="<tr>";
        lista+="<td class='w-30-pct'>Nome</td>";
        lista+="<td class='w-70-pct'>"+data.nome+"</td>";
        lista+="</tr>";
        lista+="<tr>";
        lista+="<td class='w-30-pct'>Descrição</td>";
        lista+="<td class='w-70-pct'>"+data.descricao+"</td>";
        lista+="</tr>";
        lista+="</table>";
        $("#page-content").html(lista);
        changeTitle("Categoria #" + data.id);
        })
    })




});