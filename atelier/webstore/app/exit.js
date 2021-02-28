$(document).ready(function(){
    //alert("produtos");
        //mostrar a primeira página de todos os produtos quando clico no botao de produtos
        $(document).on('click','.exit-button', function(){
            //alert("botao");
            //invocar funcao para listar todos os produtos
            window.location.replace("../loja/index.html");
    
        });

    });