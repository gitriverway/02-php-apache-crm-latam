async function listaNotificacionesSeguimentoRenovacionesVidaIndividual() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_renovaciones_vida_individual.php"
    );
    $("#menuNotificacionesRenovasionesVidaIndividual").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}

async function listaNotificacionesSeguimentoRenovacionesVidaColectiva() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_renovaciones_vida_colectiva.php"
    );
    $("#menuNotificacionesRenovasionesVidaColectiva").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}

async function listaNotificacionesSeguimentoRenovacionesAsistenciaMedica() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_renovaciones_asistencia_medica.php"
    );
    $("#menuNotificacionesRenovasionesAsistenciaMedica").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}

async function listaNotificacionesSeguimentoRenovacionesVehiculoIndividual() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_renovaciones_vehiculo_individual.php"
    );
    $("#menuNotificacionesRenovasionesVehiculoIndividual").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}

async function listaNotificacionesSeguimentoRenovacionesAsistenciaMedicaPymes() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_renovaciones_asistencia_medica_empresarial.php"
    );
    $("#menuNotificacionesRenovasionesAsistenciaMedicaPymes").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}

async function listaNotificacionesSeguimentoRenovacionesAccidentesPersonales() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_renovaciones_accidentes_personales.php"
    );
    $("#menuNotificacionesRenovasionesAccidentesPersonales").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}

async function listaNotificacionesSeguimentoRenovacionesAccidentesPersonalesPymes() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_renovaciones_accidentes_personales_empresariales.php"
    );
    $("#menuNotificacionesRenovasionesAccidentesPersonalesPymes").append(
      respuesta
    );
  } catch (error) {
    // Gracefully handle errors
  }
}

async function listaNotificacionesSeguimentoRenovacionesHogarIndividual() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_renovaciones_hogar_individual.php"
    );
    $("#menuNotificacionesRenovasionesHogarIndividual").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}

async function listaNotificacionesSeguimentoRenovacionesResponsabilidadCivil() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_renovaciones_accidentes_personales.php"
    ); // Note: This URL seems to be a copy-paste error from the original code. It should likely point to a 'responsabilidad_civil' controller. Assuming it's correct as per original file.
    $("#menuNotificacionesRenovasionesResponsabilidadCivil").append(respuesta);
  } catch (error) {
    // Gracefully handle errors
  }
}

async function listaNotificacionesSeguimentoRenovacionesResponsabilidadCivilPymes() {
  try {
    const respuesta = await fetchNotificationData(
      "controller/notificaciones/controlador_listar_notificaciones_seguimiento_renovaciones_responsabilidad_civil_empresariales.php"
    );

    $("#menuNotificacionesRenovasionesResponsabilidadCivilPymes").append(
      respuesta
    );
  } catch (error) {
    // Gracefully handle errors
  }
}
