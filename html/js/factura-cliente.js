/*********************************
 CARGAR LISTA DE EMPLEADO EN TABLA
 *********************************/
//  function lista1(){
//     $.ajax({

//         url:"controller/facturas-clientes/controlador_factura_cliente_listar.php",
//         method: "POST",
//         cache: false,
//         contentType: false,
//         processData: false,
//         success: function(respuesta){

//             console.log("respuesta",respuesta);

//         }
//     });
//  }

var table;
function listar_factura_cliente(){
   table = $('#tabla-factura-cliente').DataTable( {
       "ordering":false,   
       "bLengthChange":true,
       "searching": { "regex": false },
       "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
       "pageLength": 10,
       "destroy":true,
       "async": false ,
       "processing": true,
       "ajax": "controller/facturas-clientes/controlador_factura_cliente_listar.php",
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
       },
       "language":idioma_espanol
   } );
}


$("#tabla-factura-cliente").on("click", ".btnImprimirFacturaCliente", function(){
    
    var facturaRuta = $(this).attr("facturaRuta");
    window.open(facturaRuta,"Cotizacion Planes Salud","width=1024,height=1024");

  })