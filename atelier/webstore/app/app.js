///localhost:8080/webstore/

//funcao que acontece quando uma pagina é carregada
$(document).ready(function(){
    app_html="";
    //navbar
    app_html+="<div class='navbar navbar-default navbar-static-top' role='navigation'>";
        app_html+="<div class='container'>";
            app_html+="<div class='navbar-header'>";
                //menu hamburguer
                app_html+="<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>";
                    app_html+="<span class='sr-only'>Navegacao</span>";
                    app_html+="<span class='icon-bar'></span>";
                    app_html+="<span class='icon-bar'></span>";
                    app_html+="<span class='icon-bar'></span>";
                app_html+="</button>";
                //logotipo da loja
                app_html+="<a href='#' class='navbar-brand'>Atelier da Branca</a>";
            app_html+="</div>";
            app_html+="<div class='navbar-collapse collapse'>";
                app_html+="<ul class='nav navbar-nav'>";
                    app_html+="<li id='products-nav' class='read-products-button'><a>Produtos</a></li>";
                    app_html+="<li id='categories-nav' class='read-categories-button'><a>Categorias</a></li>";
                    app_html+="<li id='categories-nav' class='exit-button'><a><i class='fas fa-sign-out-alt'></i> Log Out</a></li>";
                app_html+="</ul>"; 
            app_html+="</div>";
        app_html+="</div>";
    app_html+="</div>";

    
    //substitutir valor do HTML
    $("#app").html(app_html);
})
//transformar valores de um formulario em json
$.fn.serializeObject=function()
{
    var o={};
    var a=this.serializeArray();
    $.each(a,function(){
        if(o[this.name]!==undefined)
        {
            if(!o[this.name].push)
            {
                o[this.name]=[o[this.name]]
            }
            o[this.name].push(this.value ||'');
        }
        else{
            o[this.name]=this.value || '';
        }
    });
    return o;
};

function cria_bt_lista()
{
  var bt="" ;
bt+="<div id='read-categories' class='btn btn-primary pull-right m-b-15px read-categories-button'>";
    bt+="<span class='glyphicon glyphicon-list'></span> Lista de Categorias";
bt+="</div>";

  return bt; 
}

function changeTitle(titulo)
{
    //alterar o titulo da pagina
    document.title=titulo;
    $('#page-title').text(titulo);
}
function removerClasse()
{
    $(".nav li").each(function(){
        $(this).removeClass("active");
    });
}

function cria_lista_produtos_bt()
{
    txt="";
    txt+="<div id='read-products' class='btn btn-primary pull-right m-b-15px read-products-button'><span class='glyphicon glyphicon-list'></span> Lista de Produtos</div>";
    return txt;

}