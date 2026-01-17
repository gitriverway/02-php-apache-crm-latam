async function listaNotificacionesSiniestrosVehiculo() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_siniestro_vehiculo.php"
    );
    $("#menuNotificacionesSiniestrosVehiculo").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}
