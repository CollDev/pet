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

function grabar(url, currentUrl)
{
   //$('.error').addClass('hide');
   //$('#registrar').submit();
        /*var xhqr = $.post(url,$('#registrar').serialize(),  function(data) {
            
            $('#divPanelSistema').html(data);
            $("#lstSiniestro").GridUnload();
            boletaRecepcionId = $('#sistema_bundle_frontendbundle_recepcionmaterialtype_boleta_recepcion').val();
            targetUrl = currentUrl + '?boletaRecepcionId='+ boletaRecepcionId;
            crearGrilla(targetUrl);
            
        })
            .error( function () {
                $('.error').removeClass('hide');
            });
        return false;*/
        
   
}

function eliminar(event) {
    
   var r=confirm("Desea Eliminar el registro");
   
   if (r === true ) {
       
       url = event.data.url;
    currentUrl = event.data.currentUrl;
    $('#sistema_bundle_frontendbundle_recepcionmaterialtype_accion').val('eliminar');
    boletaRecepcionId = $('#sistema_bundle_frontendbundle_recepcionmaterialtype_boleta_recepcion').val();
    targetUrl = currentUrl + '?boletaRecepcionId='+ boletaRecepcionId;
    recepcionMaterialId = $('#sistema_bundle_frontendbundle_recepcionmaterialtype_recepcion_material').val();
    var xhqr = $.post(url,$('#registrar').serialize(),  function(data) {
        
        $('#sistema_bundle_frontendbundle_recepcionmaterialtype_accion').val('');
        $('#sistema_bundle_frontendbundle_recepcionmaterialtype_cantidad').val('');
        $('#sistema_bundle_frontendbundle_recepcionmaterialtype_fecha_ingreso').val('');
        $('#sistema_bundle_frontendbundle_recepcionmaterialtype_recepcion_material').val('');
        $("#lstSiniestro").GridUnload();
        $('#errorMsg').removeClass('hide');
        $('#errorMsg').html('El registro'+ recepcionMaterialId +'fue eliminado');
        crearGrilla(targetUrl);
        
    });
   }
   
    return false;
}

function imprimir(url)
{
    var xhqr = $.post(url,$('#imprimir').serialize(),  function(data) {
        
        $('.impresion').html(data);
        $('.impresion').printElement();
    });
    
}

function obtenerPeso(url,id)
{
    var xhqr = $.post(url, function(data) {
            $('#'+id).val(data);
        })
         .error( function () {
              $('.error').removeClass('hide');
         });
    return false;
}

function crearGrilla(targetUrl){
    	jQuery("#lstSiniestro").jqGrid({
            url: targetUrl,
            datatype: 'xml',
            mtype: 'GET',
            colNames:['Cod. Rec. Material', 'Cod. Boleta Recepcion', 'Material', 'Fecha Ingreso', 'Uni. Med.','Cantidad'],
            colModel:[
                {name:'cod',index:'id', width:100},
                {name:'boleta_recepcion',index:'boleta_recepcion', width:100},
                {name:'material',index:'material', width:100},
                {name:'fecha_ingreso',index:'fecha_ingreso', width:100},
		{name:'unidad_medida',index:'unidad_medida', width:100},
		{name:'cantidad',index:'cantidad', width:100}
            ],
            rowNum:20,
            rowList:[20,40,60,80,100],
            pager:'#pagerlstSiniestro',
            viewrecords: true,
            //shrinkToFit:false,
            height:260,
            width:720,
            caption:"Resultados encontrados",
            ondblClickRow:function(rowId){
                
                var rowData = jQuery(this).getRowData(rowId); 
                var recepcionMaterialId = rowData['cod'];
                var boletaRecepcionId = $.trim(rowData['boleta_recepcion']);
                
                var fechaIngreso = $.trim(rowData['fecha_ingreso']);
                var unidadMedida = $.trim(rowData['unidad_medida']);
                var cantidad = rowData['cantidad'];
                var material = $.trim(rowData['material']);
                
                $('#sistema_bundle_frontendbundle_recepcionmaterialtype_boleta_recepcion').val(boletaRecepcionId);
       
                $('#sistema_bundle_frontendbundle_recepcionmaterialtype_material option:contains('+ material +') ').attr('selected', true);
                $('#sistema_bundle_frontendbundle_recepcionmaterialtype_fecha_ingreso').val(fechaIngreso);
                $('#sistema_bundle_frontendbundle_recepcionmaterialtype_unidad_medida option:contains('+ unidadMedida +') ').attr('selected', true);
                
                $('#sistema_bundle_frontendbundle_recepcionmaterialtype_cantidad').val(cantidad);
                $('#sistema_bundle_frontendbundle_recepcionmaterialtype_accion').val('editar');
                $('#sistema_bundle_frontendbundle_recepcionmaterialtype_recepcion_material').val(recepcionMaterialId);
                
            }
    });
}

function limpiar(event){
        $('#registrar input:text').val('');
        $('#registrar input:hidden').val('');
        $("#lstSiniestro").GridUnload();
        $('#boleta_impresion_id').val('');
        $('#errorMsg').addClass('hide');
        crearGrilla(event.data.url);
        return false;
}
	
function buscarPedido(event){
        
        $( "#dlgDatosPopUp" ).dialog( "open" );
        
        $("#buscar-boleta")
            .click(function() {
                $.post(event.data.url, $('#popup').serialize(), function (data) {
                   $('.resultados').html(data); 
                });
                return false;
            });
}

function elegirBoletaRecepcion(id, targetUrl)
{
    $('#sistema_bundle_frontendbundle_recepcionmaterialtype_boleta_recepcion').val(id);
    $('#sistema_bundle_frontendbundle_recepcionmaterialtype_accion').val('');
    $('#sistema_bundle_frontendbundle_recepcionmaterialtype_cantidad').val('');
    $('#sistema_bundle_frontendbundle_recepcionmaterialtype_fecha_ingreso').val('');
    $('#boleta_impresion_id').val(id);
    $("#dlgDatosPopUp").dialog("close");
    $("#lstSiniestro").GridUnload();
    $('#errorMsg').addClass('hide');
    crearGrilla(targetUrl);
    
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

		

