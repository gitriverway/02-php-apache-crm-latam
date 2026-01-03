function Actualizar_password() {
    let pass = $("#txt_con1").val().trim();
    let pass_confirmation = $("#txt_con2").val().trim();


    if (pass.length == 0) {
        return Swal.fire(t('messages.warning', 'Warning Message'), t('messages.fill_password_field', 'Fill in the password field'), "warning");
    }
    if (pass_confirmation.length == 0) {
        return Swal.fire(t('messages.warning', 'Warning Message'), t('messages.fill_repeat_password_field', 'Fill in the repeat password field'), "warning");
    }
    if (pass != pass_confirmation) {
        return Swal.fire(t('messages.warning', 'Warning Message'), t('messages.passwords_not_match', 'Passwords do not match'), "warning");
    }

    var datos = new FormData();
    datos.append("pass", pass);

    $.ajax({

        url: "controller/usuarios/controlador_usuario_actualizar_password.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            console.log(respuesta);

            if (respuesta > 0) {
                Swal.fire(t('messages.confirmation', 'Confirmation Message'), t('messages.data_updated_successfully', 'Data Updated Successfully'), "success").then ( ( value ) =>  {
                    $("#txt_con1").val("");
                    $("#txt_con2").val("");
                }); 
            } else {
                Swal.fire(t('messages.warning', 'Warning Message'), t('messages.password_not_valid', 'Sorry, the password is not valid'), "warning");
            }

        }
    });

}

function mostrarPassword() {
    var cambio = document.getElementById("txt_con1");
    var cambio_confirmation = document.getElementById("txt_con2");
    if (cambio.type == "password") {
        cambio.type = "text";
        cambio_confirmation.type = "text";
        $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    } else {
        cambio.type = "password";
        cambio_confirmation.type = "password";
        $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
}