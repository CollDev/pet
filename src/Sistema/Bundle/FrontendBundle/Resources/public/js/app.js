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

function eliminarIncidencia(event) {
    
    var r=confirm("Desea Eliminar el registro");
    if (r === true ) {
       
    url = event.data.url;
    currentUrl = event.data.currentUrl;
    $('#sistema_bundle_frontendbundle_incidenciatype_accion').val('eliminar');
    incidenciaId = $('#sistema_bundle_frontendbundle_incidenciatype_incidencia').val();
    
    var xhqr = $.post(url,$('#registrar').serialize(),  function(data) {
        
        $('#sistema_bundle_frontendbundle_incidenciatype_accion').val('');
        $('#sistema_bundle_frontendbundle_incidenciatype_observacion').val('');
        $('#sistema_bundle_frontendbundle_incidenciatype_fecha_incidencia').val('');
        $('#sistema_bundle_frontendbundle_incidenciatype_recepcion_maquinaria').val('');
        
        $('#errorMsg').removeClass('hide');
        $('#errorMsg').html('El registro'+ incidencialId +'fue eliminado');
        
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

function completar(url)
{
    var boletaId = $('#boleta_impresion_id').val();
    if (boletaId == '') {
        $( "#dlgDatos" ).dialog( "open" );
         $('#boletaRecepcion_estado_div').html('No existe boleta a completar');
    }
    else {
        var xhqr = $.post(url,$('#imprimir').serialize(),  function(data) {
            $('#boletaRecepcion_resultado').html(data);
        });     
    }   
    
    
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
                var recepcionMaterialId = $.trim(rowData['cod']);
                var boletaRecepcionId = $.trim(rowData['boleta_recepcion']);
                
                clave = prompt('Ingresa su Clave', '');
                if (clave === "****") {
                    var editUrl = $.trim($('#editUrl').text());
                
                var url = editUrl + '?id='+ boletaRecepcionId+'&accion=editar&recepcionMaterial='+recepcionMaterialId;
                newwindow=window.open(url,'name','toolbar=1,scrollbars=1,location=1,\n\
                    statusbar=0,menubar=1,resizable=1,width=600,height=400');
                if (window.focus) { newwindow.focus()}
                    return false;
                }
                else {
                    alert('Clave Incorrecta!');
                }
                
                
                
                //var fechaIngreso = $.trim(rowData['fecha_ingreso']);
                //var unidadMedida = $.trim(rowData['unidad_medida']);
                //var cantidad = rowData['cantidad'];
                //var material = $.trim(rowData['material']);
                /*
                $('#sistema_bundle_frontendbundle_recepcionmaterialtype_boleta_recepcion').val(boletaRecepcionId);
       
                $('#sistema_bundle_frontendbundle_recepcionmaterialtype_material option:contains('+ material +') ').attr('selected', true);
                $('#sistema_bundle_frontendbundle_recepcionmaterialtype_fecha_ingreso').val(fechaIngreso);
                $('#sistema_bundle_frontendbundle_recepcionmaterialtype_unidad_medida option:contains('+ unidadMedida +') ').attr('selected', true);
                
                $('#sistema_bundle_frontendbundle_recepcionmaterialtype_cantidad').val(cantidad);
                $('#sistema_bundle_frontendbundle_recepcionmaterialtype_accion').val('editar');
                $('#sistema_bundle_frontendbundle_recepcionmaterialtype_recepcion_material').val(recepcionMaterialId);
                */
            }
    });
}

function limpiar(event){
    $('#registrar input:text').val('');
    $('#registrar input:hidden[name*="recepcion_material"]').val('');
    $('#registrar input:hidden[name*="accion"]').val('');
    $("#lstSiniestro").GridUnload();
    $('#form_boleta_recepcion').val('');
    $('#errorMsg').addClass('hide');
    $('#boletaRecepcion_estado_div').removeClass('hide').addClass('hide');
    $('#boletaRecepcion_estado').html('');
    crearGrilla(event.data.url);
    return false;
}

function limpiarIncidencia(event) {
    $('#registrar input:text').val('');
    $('#registrar textarea').val('');
    $('#registrar input:hidden[name*="accion"]').val('');
    
    $('#errorMsg').addClass('hide');
    return false;
}

function limpiarFechas(event) {
    $('#form_fecha_inicio').val('');
    $('#form_fecha_fin').val('');
    $('#errorMsg').addClass('hide');
    return false;
}

function buscarPedido(event){
        
    $( "#dlgDatosPopUp" ).dialog( "open" );
    $('#form_id').val('');
    $('.resultados').html('');
    $("#buscar-boleta")
        .click(function() {
            $.post(event.data.url, $('#popup').serialize(), function (data) {
                $('.resultados').html(data); 
            });
            return false;
        });
}

function buscarMiPedido(event){
        
    $( "#dlgDatosPopUp" ).dialog( "open" );
    $('#form_id').val('');
    $('.resultados').html('');
    $("#buscar-pedido")
        .click(function() {
            $.post(event.data.url, $('#popup').serialize(), function (data) {
                $('.resultados').html(data); 
            });
            return false;
        });
}

function buscarIncidencia(event){
        
    $( "#dlgDatosPopUp" ).dialog( "open" );
    $('#form_id').val('');
    $('.resultados').html('');
    $("#buscar-incidencia")
        .click(function() {
            $.post(event.data.url, $('#popup').serialize(), function (data) {
               $('.resultados').html(data); 
            });
            return false;
        });
}

function buscarCliente(event) 
{
    $("#dlgDatosPopUp" ).dialog( "open" );
    $('#form_id').val('');
    $('.resultados').html('');
    $("#buscar-cliente")
        .click(function() {
            $.post(event.data.url, $('#popup').serialize(), function (data) {
               $('.resultados').html(data); 
            });
            return false;
        });
}

function verificarStock(event)
{
    
    $('.resultados').html('');
    var materialId = $('#sistema_bundle_frontendbundle_pedidotype_material option:selected').val();
    var url = event.data.url + "?id="+ materialId;

    $.post(url, function (data) {
        $('.resultados2').html(data); 
    });
            
    $("#dlgDatos" ).dialog( "open" );
    return false;
}

function elegirCliente(id)
{
    $('#sistema_bundle_frontendbundle_pedidotype_cliente').val(id);
    $('#sistema_bundle_frontendbundle_pedidotype_cantidad').val('');
    $('#sistema_bundle_frontendbundle_pedidotype_importe').val('');
    $("#dlgDatosPopUp").dialog("close");
    $('#errorMsg').addClass('hide');
}



function elegirBoletaRecepcion(id, targetUrl, boletaEstado)
{
    $('#sistema_bundle_frontendbundle_recepcionmaterialtype_boleta_recepcion').val(id);
    $('#sistema_bundle_frontendbundle_recepcionmaterialtype_accion').val('');
    $('#sistema_bundle_frontendbundle_recepcionmaterialtype_cantidad').val('');
    $('#sistema_bundle_frontendbundle_recepcionmaterialtype_fecha_ingreso').val('');
    $('#boleta_impresion_id').val(id);
    $('#form_boleta_recepcion').val(id);
    $('#boletaRecepcion_estado_div').removeClass('hide');
    $('#boletaRecepcion_estado').html('Estado Boleta: '+boletaEstado);
    $("#dlgDatosPopUp").dialog("close");
    $("#lstSiniestro").GridUnload();
    $('#errorMsg').addClass('hide');
    crearGrilla(targetUrl);
    
}

function elegirIncidencia(id, targetUrl, incidenciaEstado, observacion,
    maquinaria, tipoIncidencia, fechaIncidencia)
{
    $('#sistema_bundle_frontendbundle_incidenciatype_nro_incidencia').val(id);
    $('#sistema_bundle_frontendbundle_incidenciatype_accion').val('editar');
    $('#sistema_bundle_frontendbundle_incidenciatype_maquinaria').val(maquinaria);
    $('#sistema_bundle_frontendbundle_incidenciatype_observacion').val(observacion);
    $('#sistema_bundle_frontendbundle_incidenciatype_tipo_incidencia').val(tipoIncidencia);
    $('#sistema_bundle_frontendbundle_incidenciatype_fecha_incidencia').val(fechaIncidencia);
    $('#sistema_bundle_frontendbundle_incidenciatype_estado').val(incidenciaEstado);
    
    
    $("#dlgDatosPopUp").dialog("close");
    
    $('#errorMsg').addClass('hide');
    
    
}

function elegirPedido(id, pedidoEstado, fechaProgramacion, material, cantidad)
{
    $('#form_nro_pedido').val(id);
    $('#pedido_estado').text(pedidoEstado);
    $('#pedido_fecha_programacion').text(fechaProgramacion);
    $('#pedido_material').text(material);
    $('#pedido_cantidad').text(cantidad);
    $("#dlgDatosPopUp").dialog("close");
    
    $('#errorMsg').addClass('hide');
}

function confirmarPedido(url, id)
{
    
    var url = url + "?id="+ id;

    $.post(url, function (data) {
        if(data !== '') {
            alert('Pedido Nro. '+id+' confirmado');
            $('#estado-'+id).html(data); 
        }
        else {
            alert('El pedido no se pudo confirmar');
        }
        
        
    });
    return false;
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

