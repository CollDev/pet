function armarPlantilla()
{
    $('#divMenu').load('menu.html');
    $('#divHeader').load('header.html');
    $('#pie_pagina').load('footer.html');
}
		
function muestraPagina(contenedor, rutaPagina)
{
    $('#' + contenedor).load(rutaPagina);
}

function cerrarDialog(dialog)
{
    $("#" + dialog).dialog( "close" );
}
		

