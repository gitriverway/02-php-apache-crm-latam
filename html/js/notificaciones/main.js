// Orchestration functions using async/await and Promise.all
async function listar_notificaciones_asistencia_medica_individual() {
  try {
    await Promise.all([
      listaNotificacionesSeguimentoRenovacionesAsistenciaMedica(),
      listaNotificacionesReembolsosAsistenciaMedica(),
      listaNotificacionesCreditosHospitalariosAsistenciaMedica(),
      listaNotificacionesCreditosAmbulatoriosAsistenciaMedica(),
    ]);
  } catch (error) {
    // Handle errors if needed
  }
}

async function listar_notificaciones_asistencia_medica_pymes() {
  try {
    await Promise.all([
      listaNotificacionesSeguimentoRenovacionesAsistenciaMedicaPymes(),
      listaNotificacionesReembolsosAsistenciaMedicaPymes(),
      listaNotificacionesCreditosHospitalariosAsistenciaMedicaPymes(),
      listaNotificacionesCreditosAmbulatoriosAsistenciaMedicaPymes(),
    ]);
  } catch (error) {
    // Handle errors if needed
  }
}

async function listar_notificaciones_individual() {
  try {
    await Promise.all([listar_notificaciones_asistencia_medica_individual()]);
  } catch (error) {
    // Handle errors if needed
  }
}

async function listar_notificaciones_pymes() {
  try {
    await Promise.all([listar_notificaciones_asistencia_medica_pymes()]);
  } catch (error) {
    // Handle errors if needed
  }
}

async function listar_notificaciones() {
  try {
    await Promise.all([
      listaNotificacionesSeguimientosProspectosIndividual(),
      listaNotificacionesSeguimientosProspectosAltoIndividual(),
      listaNotificacionesSeguimientosProspectosMedioIndividual(),
      listaNotificacionesSeguimientosProspectosBajoIndividual(),
      listaNotificacionesSeguimientosProspectosPymes(),
      listaNotificacionesSeguimientosProspectosAltoPymes(),
      listaNotificacionesSeguimientosProspectosMedioPymes(),
      listaNotificacionesSeguimientosProspectosBajoPymes(),
      listaNotificacionesSeguimentoClientesIndividual(),
      listaNotificacionesSeguimentoClientesPymes(),
      listar_notificaciones_individual(),
      listar_notificaciones_pymes(),
    ]);
  } catch (error) {
    // Handle errors if needed
  }
}
