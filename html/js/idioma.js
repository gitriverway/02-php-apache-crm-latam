/**
 * Sistema de traducciones multiidioma
 * Maneja el cambio de idioma y las traducciones del lado del cliente
 */

/**
 * Cambia el idioma del sistema
 */
function cambiarIdioma(idioma) {
    var datos = new FormData();
    datos.append("idioma", idioma);

    $.ajax({
        url: "controller/idioma/controlador_cambiar_idioma.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            var data = JSON.parse(respuesta);
            if (data.success) {
                // Recargar la página para aplicar los cambios
                location.reload();
            } else {
                Swal.fire(
                    t('messages.warning', 'Warning Message'),
                    data.message || 'Error al cambiar el idioma',
                    "warning"
                );
            }
        },
        error: function () {
            Swal.fire(
                t('messages.error', 'Error'),
                'Error al cambiar el idioma',
                "error"
            );
        }
    });
}

/**
 * Obtiene el idioma actual desde la sesión
 */
function obtenerIdiomaActual() {
    return currentLanguage || 'en';
}

/**
 * Inicializa el selector de idioma
 */
$(document).ready(function() {
    // Establecer el idioma seleccionado en el dropdown si existe
    var idiomaActual = obtenerIdiomaActual();
    $('#selector_idioma').val(idiomaActual);
    
    // Manejar cambio de idioma
    $('#selector_idioma').on('change', function() {
        var nuevoIdioma = $(this).val();
        cambiarIdioma(nuevoIdioma);
    });
});

