// function lista1(){

//     $.ajax({
//         url: "controller/clientes/controlador_cliente_listar.php",
//         method: "POST",
//         cache: false,
//         contentType: false,
//         processData: false,
//         async : false,
//         success: function (respuesta) {
//           console.log(respuesta);
//         }
//       })
// }


var tabla_cliente;
function listar_cliente(){
   tabla_cliente = $('#tabla_cliente').DataTable( {
       "ordering":false,   
       "bLengthChange":true,
       "searching": { "regex": false },
       "lengthMenu": [ [5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "All"] ],
       "pageLength": 5,
       "destroy":true,
       "async": false ,
       "processing": true,
       "searchPanes": {
         layout: "columns-2",
         cascadePanes: true,
         dtOpts: {
             dom: "tp",
             paging: true,
             pagingType: 'numbers',
             searching: false
         }
     },
     "dom": "Plfrtip",
     "columnDefs": [
         {
             searchPanes: {
                 show: true
             },
             targets: [1,5]
         },
         {
            searchPanes: {
                show: false
            },
            targets: [0,1,2,3,4,5,6,7,8]
        }
     ],
       "ajax": "controller/clientes/controlador_cliente_listar.php",
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


  /*********************************
  LISTAR COMBO PROVINCIAS
  *********************************/
  function listar_combo_provincia() {
  
    $.ajax({
  
      url: "controller/provincias/controlador_combo_provincia_listar.php",
      method: "POST",
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        var data = JSON.parse(respuesta);
        var cadena = "";
        if (data.length > 0) {
          cadena += "<option value='0'>" + t('messages.select_option', 'Select..') + "</option>";
          for (var i = 0; i < data.length; i++) {
            cadena += "<option value='" + data[i]["provincia_id"] + "'>" + data[i]["provincia_descripcion"] + "</option>";
          }
        } else {
          cadena += "<option value=''>" + t('messages.no_records_found', 'NO RECORDS FOUND') + "</option>";
        }
        $(".cbm_provincia").html(cadena);
      }
    });
  }

  function validarEmail(valor) {
    if(valor.indexOf('@', 0) == -1 || valor.indexOf('.', 0) == -1) {
        return 0;
    }else{
        return 1;
    }
  }

  $("#txt_email").change(function(){
    var email = $(this).val();
    if (email.length > 0) {
        if (validarEmail(email) == 0) {
          return Swal.fire(t('messages.warning', 'Warning Message'), t('messages.check_email_format', 'Please check, email incorrectly entered'), "warning");
        }
      }
  })
/*********************************
 ABRIE MODAL EDITAR CLIENTE
 *********************************/
 $("#tabla_cliente").on("click", ".btnEditarCliente", function(){

    var idCliente = $(this).attr("idCliente");
    $("#txt_idCliente").val(idCliente);
  
    $("#modal_editar_cliente").modal({backdrop:'static',keyboard:false})
    $("#modal_editar_cliente").modal('show');
    Limpiar_Campos();
    Cargar_Datos_Cliente();
  })

  function Limpiar_Campos(){
    $("#txt_documento").val("");
    $("#txt_nombre").val("");
    $("#genero").val("").change();
    $("#txt_fecha_nacimiento").val("");
    $("#txt_telefono").val("");
    $("#txt_email").val("");
    $("#cbm_provincia").val("0").change();
    $("#txt_ciudad").val("");
    $("#txt_direccion").val("");
    $("#txt_ocupacion").val("");
    $("#cbm_ingreso_mensual").val("").change();

 }

  function Cargar_Datos_Cliente(){
    
    var idCliente = $("#txt_idCliente").val();

    var datos = new FormData();
  
    datos.append("idCliente",idCliente);
  
    $.ajax({
  
      url:"controller/clientes/controlador_traer_datos_cliente.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){
  
        var data = JSON.parse(respuesta);
  
        if(data.length > 0){

          $("#txt_documento").val(data[0]["cliente_ci"]);
          $("#txt_nombre").val(data[0]["cliente_nombre"]);
          $("#genero").val(data[0]["cliente_genero"]).change();
          $("#txt_fecha_nacimiento").val(data[0]["cliente_fecha_nacimiento"]);
          $("#txt_telefono").val(data[0]["cliente_telefono"]);
          $("#txt_email").val(data[0]["cliente_email"]);
          $("#cbm_provincia").val(data[0]["provincia_id"]).change();
          $("#txt_ciudad").val(data[0]["ciudad_id"]);
          $("#txt_direccion").val(data[0]["cliente_direccion"]);
          $("#txt_ocupacion").val(data[0]["cliente_ocupacion"]);
          $("#cbm_ingreso_mensual").val(data[0]["cliente_ingreso"]).change();
        }
              
      }
  });

  }

  
  /*********************************
   MODIFICAR DATOS PROSPECTO
   *********************************/
  function Modificar_Cliente(){
    
    var idCliente = $("#txt_idCliente").val().trim();
    var cedula = $("#txt_documento").val().trim();
    var nombre = $("#txt_nombre").val().toUpperCase().trim();
    var genero = $("#genero").val().trim();
    var fecha_nacimiento = $("#txt_fecha_nacimiento").val().trim();
    var telefono = $("#txt_telefono").val().trim();
    var email = $("#txt_email").val().trim();
    var provincia = $("#cbm_provincia").val().trim();
    var ciudad = $("#txt_ciudad").val().toUpperCase().trim();
    var direccion = $("#txt_direccion").val().toUpperCase().trim();
    var ocupacion = $("#txt_ocupacion").val().toUpperCase().trim();
    var valor_ingreso = $("#cbm_ingreso_mensual").val().trim();

    if(idCliente.length==0 || cedula.length==0 || nombre.length==0 || genero.length==0 || fecha_nacimiento.length==0 || telefono.length==0 || email.length==0 || provincia.length==0 || ciudad.length==0 || direccion.length==0 || ocupacion.length==0 || valor_ingreso.length==0){
        return Swal.fire(t('messages.warning', 'Warning Message'), t('messages.fill_empty_fields', 'Fill in the empty fields'), "warning");
      }
    
      if (email.length > 0) {
        if (validarEmail(email) == 0) {
          return Swal.fire(t('messages.warning', 'Warning Message'), t('messages.check_email_format', 'Please check, email incorrectly entered'), "warning");
        }
      }
  
    var datos = new FormData();
    datos.append("idCliente",idCliente);
    datos.append("cedula",cedula);
    datos.append("nombre",nombre);
    datos.append("genero",genero);
    datos.append("fecha_nacimiento",fecha_nacimiento);
    datos.append("telefono",telefono);
    datos.append("email",email);
    datos.append("provincia",provincia);
    datos.append("ciudad",ciudad);
    datos.append("direccion",direccion);
    datos.append("ocupacion",ocupacion);
    datos.append("valor_ingreso",valor_ingreso);
  
    $.ajax({
  
        url:"controller/clientes/controlador_cliente_modificar.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
            if(respuesta > 0){
                    Swal.fire(t('messages.confirmation', 'Confirmation Message'), t('messages.data_updated_client', 'Data correctly, Client Updated'), "success")            
                    .then ( ( value ) =>  {
                        $("#modal_editar_cliente").modal('hide');
                        tabla_cliente.ajax.reload();  
                    }); 
            }else{
                Swal.fire(t('messages.error', 'Error'), t('messages.could_not_complete_registration', 'Sorry, could not complete registration'), "error");
            }
        }
    });
  }

  $("#tabla_cliente").on("click", ".btnResetClave", function(){
    
    var idCliente = $(this).attr("idCliente");
    var cedula = $(this).attr("cedula");

    var datos = new FormData();
    datos.append("idCliente",idCliente);
    datos.append("cedula",cedula);
  
    $.ajax({
  
        url:"controller/clientes/controlador_cliente_restablecer_password_modificar.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

            if(respuesta > 0){
                    Swal.fire(t('messages.confirmation', 'Confirmation Message'), t('messages.password_reset_default', 'Data correctly, Default password has been reset'), "success")            
                    .then ( ( value ) =>  {
                        tabla_cliente.ajax.reload();  
                    }); 
            }else{
                Swal.fire(t('messages.error', 'Error'), t('messages.could_not_complete_registration', 'Sorry, could not complete registration'), "error");
            }
        }
    });

  })

  
  $("#tabla_cliente").on("click", ".btnEnviarAcceso", function(){
    
    var idCliente = $(this).attr("idCliente");

    var datos = new FormData();
    datos.append("idCliente",idCliente);
  
    $.ajax({
  
        url:"controller/clientes/controlador_cliente_enviar_correo_acceso_plataforma.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

            if(respuesta == "ok"){
                    Swal.fire(t('messages.confirmation', 'Confirmation Message'), t('messages.email_sent_successfully', 'Data correctly, Access email has been sent'), "success")            
                    .then ( ( value ) =>  {
                        // tabla_cliente.ajax.reload();
                    }); 
            }else{
                Swal.fire(t('messages.error', 'Error'), t('messages.could_not_send_email', 'Sorry, could not send email'), "error");
            }
        }
    });

  })