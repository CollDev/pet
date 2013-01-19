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


$(function() {
		$( "#divFormCompanias" ).accordion({autoHeight:false});
		$("button", ".divBtns").button();
		$("#divTabsDetProducto").tabs({
			ajaxOptions: {
				error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html(
						"Couldn't load this tab. We'll try to fix this as soon as possible. " +
						"If this wouldn't be a demo." );
				}
			}
		});
		
		
		crearGrilla();

		$("#dlgDatosPopUp").dialog({
			autoOpen:false,
			resizable: false,
			height:250,
			width:400,
			modal:true
		});
		
	});

function crearGrilla(){
	jQuery("#lstSiniestro").jqGrid({
			datatype: "local",
			colNames:['Cod. Producto','Producto','Uni. Med.','Cantidad'],
			colModel:[
				{name:'cod',index:'cod', width:80},
				{name:'desc',index:'desc', width:200},
				{name:'estado',index:'estado', width:100},
				{name:'dat4',index:'dat4', width:100}
			],
			rowNum:20,
			rowList:[20,40,60,80,100],
			pager:'#pagerlstSiniestro',
			viewrecords: true,
			//shrinkToFit:false,
			height:260,
			width:720,
			caption:"Resultados encontrados",
			ondblClickRow:function(){verDetallePartePersonal();}
		});
}

function verDetallePartePersonal()
	{
		$( "#dlgDatosPopUp" ).dialog( "open" );
		llenarDetalle();
	}


function llenarDetalle(){
	document.getElementById("txt10").value = "2";
	document.getElementById("txt11").value = "Arrancador";
	document.getElementById("txt12").value = "UN";
	document.getElementById("txt13").value = "1";
}
function buscarOrden(){
	document.getElementById("txt2").value = "897564213";
}


function limpiar(){
	document.getElementById("txt1").value = '';
	document.getElementById("txt2").value = '';
	document.getElementById("txt3").value = '';
	document.getElementById("select1").value = '0';
	$("#lstSiniestro").GridUnload();
	crearGrilla();
}

	
function buscarPedido(){
	document.getElementById("txt1").value = '32165';
	document.getElementById("txt2").value = '564217';
	document.getElementById("txt3").value = '24/08/2012';
	document.getElementById("select1").value = '2'
	$("#lstSiniestro").GridUnload();
	crearGrilla();
		
		var datosConsultasSiniestro = [
				{cod:"1",desc:"Radiador",estado:"UN",dat4:"1"},
				{cod:"2",desc:"Arrancador",estado:"UN",dat4:"1"}
		];
		
		for(var i=0;i <= datosConsultasSiniestro.length; i++)
			jQuery("#lstSiniestro").jqGrid('addRowData',i+1,datosConsultasSiniestro[i]);
		
		jQuery("#lstSiniestro").jqGrid('navGrid','#pagerlstSiniestro',{edit:false,add:false,del:false,search:false,refresh:false});
}

function buscarGrilla2(){
	$("#lstSiniestro").GridUnload();
	crearGrilla();
		
		var datosConsultasSiniestro = [
				{cod:"1",desc:"Radiador",estado:"UN",dat4:"1"},
				{cod:"2",desc:"Juego de bujias Nro 7",estado:"KIT",dat4:"1"}
		];
		
		for(var i=0;i <= datosConsultasSiniestro.length; i++)
			jQuery("#lstSiniestro").jqGrid('addRowData',i+1,datosConsultasSiniestro[i]);
		
		jQuery("#lstSiniestro").jqGrid('navGrid','#pagerlstSiniestro',{edit:false,add:false,del:false,search:false,refresh:false});
}

		

