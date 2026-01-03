/*********************************
 CARGAR LISTA DE CONTRATOS ASIGNADOS EN TABLA
 *********************************/
//  function lista1(){

//     $.ajax({

//         url:"controller/contratos-clientes-empresariales/controlador_contrato_cliente_asistencia_medica_individual_listar.php",
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
	$("#tabla-contrato-cliente").removeClass('nowrap');
	$("#tabla-contrato-cliente").addClass('dt-responsive');

}else{
  $("#tabla-contrato-cliente").removeClass('dt-responsive');
  $("#tabla-contrato-cliente").addClass('nowrap');
}


var table;
function listar_contrato_cliente(){
   table = $('#tabla-contrato-cliente').DataTable( {
       "scrollX": true,
       "ordering":false,   
       "bLengthChange":true,
       "searching": { "regex": false },
       "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
       "pageLength": 10,
       "destroy":true,
       "async": false ,
       "processing": true,
       "ajax": "controller/contratos-clientes-empresariales/controlador_contrato_cliente_asistencia_medica_individual_listar.php",
       "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
        $($(nRow).find("td")[0]).css('text-align', 'center' );
        $($(nRow).find("td")[1]).css('text-align', 'center' );
        $($(nRow).find("td")[2]).css('text-align', 'center' );
        $($(nRow).find("td")[3]).css('text-align', 'center' );
        $($(nRow).find("td")[4]).css('text-align', 'center' );
        $($(nRow).find("td")[5]).css('text-align', 'center' );
        $($(nRow).find("td")[6]).css('text-align', 'center' );
        $($(nRow).find("td")[7]).css('text-align', 'center' );
        $($(nRow).find("td")[8]).css('text-align', 'center' );
        $($(nRow).find("td")[9]).css('text-align', 'center' );
        $($(nRow).find("td")[10]).css('text-align', 'center' );
        $($(nRow).find("td")[11]).css('text-align', 'center' );
        $($(nRow).find("td")[12]).css('text-align', 'center' );
        $($(nRow).find("td")[13]).css('text-align', 'center' );
       },
       "language":idioma_espanol
   } );
}

$("#tabla-contrato-cliente").on("click", ".btnVerDocumento", function(){
  var documentoRuta = $(this).attr("ruta");
  window.open(documentoRuta,"Cedula","width=1024,height=1024");
})
