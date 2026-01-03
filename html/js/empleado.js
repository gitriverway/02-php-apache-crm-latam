/*********************************
 CARGAR LISTA DE EMPLEADO EN TABLA
 *********************************/
//  function lista1(){
//     $.ajax({

//         url:"controller/empleados/controlador_empleado_listar.php",
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
function listar_empleado(){
   table = $('#tabla_empleado').DataTable( {
       "ordering":false,   
       "bLengthChange":true,
       "searching": { "regex": false },
       "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
       "pageLength": 10,
       "destroy":true,
       "async": false ,
       "processing": true,
       "ajax": "controller/empleados/controlador_empleado_listar.php",
       "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
           $($(nRow).find("td")[1]).css('text-align', 'center' );
           $($(nRow).find("td")[2]).css('text-align', 'center' );
           $($(nRow).find("td")[3]).css('text-align', 'center' );
           $($(nRow).find("td")[4]).css('text-align', 'center' );
           $($(nRow).find("td")[5]).css('text-align', 'center' );
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
          cadena += "<option value=''>Seleccione..</option>";
          for (var i = 0; i < data.length; i++) {
            cadena += "<option value='" + data[i]["provincia_id"] + "'>" + data[i]["provincia_descripcion"] + "</option>";
          }
        } else {
          cadena += "<option value=''>NO SE ENCONTRARON REGISTROS</option>";
        }
        $(".cbm_provincia").html(cadena);
      }
    });
  }


/*********************************
ABRI MODAL REGISTRO DE USUARIO
*********************************/
function AbrirModalRegistro(){
    $("#modal_registro").modal({backdrop:'static',keyboard:false})
    $("#modal_registro").modal('show');
    LimpiarRegistro();
 }

  
  /*=============================================
ACTIVAR USUARIO
=============================================*/
$("#tabla_empleado").on("click", ".btnActivar", function(){
   
    var idEmpleado = $(this).attr("idEmpleado");
    var estatus = $(this).attr("estadoEmpleado");
 
    Modificar_Estatus(idEmpleado,estatus);
 })
 
 function Modificar_Estatus(idEmpleado,estatus){
 
    var datos = new FormData();
     datos.append("activarId", idEmpleado);
      datos.append("activarEstatus", estatus);
 
    $.ajax({
 
        url:"controller/empleados/controlador_modificar_estatus_empleado.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
 
            if(respuesta>0){
                var statusText = t('messages.employee_status_changed', 'Employee {status} successfully').replace('{status}', estatus.toLowerCase());
                Swal.fire(t('messages.confirmation', 'Confirmation Message'), statusText, "success")            
                .then ( ( value ) =>  {
                    table.ajax.reload();
                }); 
            }
 
        }
    });
 
 }

 /*********************************
REGISTRAR UN NUEVO EMPLEADO
*********************************/
function Registrar_Empleado(){
    var nombre = $("#txt_nombre_empleado").val().toUpperCase();
    var apellido = $("#txt_apellido_empleado").val().toUpperCase();
    var provincia = $("#cbm_provincia").val();
    var direccion = $("#txt_direccion_empleado").val();
    
    if(nombre.length==0 || apellido.length == 0 || provincia.length==0 || direccion.length==0){
        return Swal.fire(t('messages.warning', 'Warning Message'), t('messages.fill_empty_fields', 'Fill in the empty fields'), "warning");
    }
 
    var datos = new FormData();
    datos.append("nombre", nombre);
    datos.append("apellido", apellido);
    datos.append("provincia", provincia);
    datos.append("direccion", direccion);

    $.ajax({
 
        url:"controller/empleados/controlador_empleado_registro.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
            var data = JSON.parse(respuesta);
            if(data["valor"] > 0){
                if(data["valor"]==1){
                    $("#modal_registro").modal('hide');
                    Swal.fire(t('messages.confirmation', 'Confirmation Message'), t('messages.new_employee_registered', 'Data correctly, New Employee Registered'), "success")            
                    .then ( ( value ) =>  {
                        LimpiarRegistro();
                        table.ajax.reload();
                    }); 
                }else{
                    return Swal.fire(t('messages.warning', 'Warning Message'), t('messages.employee_already_exists', 'Sorry, employee already exists in our database'), "warning");
                }
            }else{
                Swal.fire(t('messages.error', 'Error'), t('messages.could_not_complete_registration', 'Sorry, could not complete registration'), "error");
            }
            
        }
    });
}

/*********************************
LIMPIAR LOS REGISTROS
*********************************/
function LimpiarRegistro(){
    $("#txt_nombre_empleado").val("");
    $("#cbm_provincia").val("").change();
    $("#txt_direccion_empleado").val("");
 }

/*********************************
CARGAR DATOS EDITAR USUARIO
*********************************/
$("#tabla_empleado").on("click", ".btnEditar", function(){

    var idEmpleado = $(this).attr("idempleado");
 
    $("#modal_editar").modal({backdrop:'static',keyboard:false})
    $("#modal_editar").modal('show');
 
    var datos = new FormData();
     datos.append("idEmpleado", idEmpleado);
    $.ajax({
 
        url:"controller/empleados/controlador_traerdatos_empleado.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

            var data = JSON.parse(respuesta);
 
            $("#txtidempleado").val(data[0]["empleado_id"]);
            $("#txt_nombre_editar").val(data[0]["empleado_nombre"]);
            $("#txt_apellido_editar").val(data[0]["empleado_apellido"]);
            $("#cbm_provincia_editar").val(data[0]["provincia_id"]).change();
            $("#txt_direccion_empleado_editar").val(data[0]["empleado_direccion"]);
        }
    });
 
 })

 /*********************************
MODIFICAR DATOS EMPLEADO
*********************************/
function Modificar_Empleado(){
   
    var idEmpleado = $("#txtidempleado").val();
    var nombre = $("#txt_nombre_editar").val().toUpperCase();
    var apellido = $("#txt_apellido_editar").val();
    var provincia = $("#cbm_provincia_editar").val();
    var direccion = $("#txt_direccion_empleado_editar").val();
    
 
    if(idEmpleado.length == 0 || nombre.length==0 || apellido.length==0 || provincia.length==0 || direccion.length==0){
        return Swal.fire(t('messages.warning', 'Warning Message'), t('messages.fill_empty_fields', 'Fill in the empty fields'), "warning");
    }
 
    var datos = new FormData();
    datos.append("idEmpleado", idEmpleado);
    datos.append("nombre", nombre);
    datos.append("apellido", apellido);
    datos.append("provincia", provincia);
    datos.append("direccion", direccion);

    $.ajax({
 
        url:"controller/empleados/controlador_empleado_modificar.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
 
            var data = JSON.parse(respuesta);

            if(data["valor"] > 0){
                if(data["valor"]==1){
                    $("#modal_editar").modal('hide');
                    Swal.fire(t('messages.confirmation', 'Confirmation Message'), t('messages.data_updated_successfully', 'Data Updated Successfully'), "success")            
                    .then ( ( value ) =>  {
                        table.ajax.reload();
                    }); 
                }else{
                    return Swal.fire(t('messages.warning', 'Warning Message'), t('messages.employee_already_exists', 'Sorry, employee already exists in our database'), "warning");
                }
            }else{
                Swal.fire(t('messages.error', 'Error'), t('messages.could_not_complete_registration', 'Sorry, could not complete registration'), "error");
            }            
        }
    });
 }