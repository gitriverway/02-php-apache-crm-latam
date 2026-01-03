/*********************************
 CARGAR LISTA DE CONTRATOS ASIGNADOS EN TABLA
 *********************************/
//  function lista1(){

//     $.ajax({

//         url:"controller/contratos-documentos/controlador_contrato_documento_cliente_asistencia_medica_individual_listar.php",
//         method: "POST",
//         cache: false,
//         contentType: false,
//         processData: false,
//         success: function(respuesta){

//             console.log(respuesta);

//         }
//     });
//  }


if(window.matchMedia("(max-width:767px)").matches){
	$("#tabla-contrato-documento-cliente").removeClass('nowrap');
	$("#tabla-contrato-documento-cliente").addClass('dt-responsive');

}else{
  $("#tabla-contrato-documento-cliente").removeClass('dt-responsive');
  $("#tabla-contrato-documento-cliente").addClass('nowrap');
}

var table;
function listar_contrato_documento_cliente(){
   table = $('#tabla-contrato-documento-cliente').DataTable( {
       "scrollX": true,
       "ordering":false,   
       "bLengthChange":true,
       "searching": { "regex": false },
       "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
       "pageLength": 10,
       "destroy":true,
       "async": false ,
       "processing": true,
       "ajax": "controller/contratos-documentos-empresariales/controlador_contrato_documento_cliente_asistencia_medica_individual_listar.php",
       "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        $($(nRow).find("td")[0]).css('text-align', 'center' );
        $($(nRow).find("td")[1]).css('text-align', 'center' );
        $($(nRow).find("td")[2]).css('text-align', 'center' );
        $($(nRow).find("td")[3]).css('text-align', 'center' );
        $($(nRow).find("td")[4]).css('text-align', 'center' );
        $($(nRow).find("td")[5]).css('text-align', 'center' );
        $($(nRow).find("td")[6]).css('text-align', 'center' );
        $($(nRow).find("td")[7]).css('text-align', 'center' );
       },
       "language":idioma_espanol
   } );
}

$("#tabla-contrato-documento-cliente").on("click", ".btnVerDocumento", function(){
  var documentoRuta = $(this).attr("ruta");
  window.open(documentoRuta,"Cedula","width=1024,height=1024");
})