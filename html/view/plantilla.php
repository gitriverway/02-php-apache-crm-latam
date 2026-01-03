<?php
session_start();
require_once __DIR__ . '/../model/modelo_idioma.php';

// Establecer idioma por defecto si no existe
if (!isset($_SESSION['S_IDIOMA'])) {
  $_SESSION['S_IDIOMA'] = 'en';
}

$currentLang = Modelo_Idioma::getCurrentLanguage();
$translations = Modelo_Idioma::getAllTranslations();

// Mapear códigos de idioma a atributos lang HTML
$langMap = [
  'en' => 'en',
  'es' => 'es',
  'pt-BR' => 'pt-BR'
];
$htmlLang = isset($langMap[$currentLang]) ? $langMap[$currentLang] : 'en';
?>
<!DOCTYPE html>
<html lang="<?php echo $htmlLang; ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MQP Seguros | CRM</title>

    <link rel="icon" type="image/png" href="https://mqpseguros.com/vistas/img/favicon.ico">

    <!--=====================================
  PLUGINS DE CSS
  ======================================-->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="view/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="view/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="view/dist/css/adminlte.min.css">
    <!-- style Manual -->
    <link rel="stylesheet" href="view/css/estilo.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/searchpanes/1.4.0/css/searchPanes.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <!-- Select 2 -->
    <link rel="stylesheet" href="view/plugins/select2/css/select2.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->
    <!-- jQuery -->
    <script src="view/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="view/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="view/plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE App -->
    <script src="view/dist/js/adminlte.min.js"></script>
    <!-- SweetAlert 2 -->
    <script src="view/plugins/sweetalert2/sweetalert2.all.js"></script>
    <!-- DataTables -->
    <!-- DataTables  & Plugins -->

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/searchpanes/1.4.0/js/dataTables.searchPanes.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

    <!-- Select 2 -->
    <script src="view/plugins/select2/js/select2.min.js"></script>

    <!-- jQuery Number -->
    <script src="view/plugins/jqueryNumber/jquerynumber.min.js"></script>

    <!---CryptoJS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

    <!-- Traducciones Multiidioma -->
    <script>
    // Variables globales para traducciones
    var currentLanguage = '<?php echo $currentLang; ?>';
    var translations = <?php echo json_encode($translations); ?>;

    // Mantener compatibilidad con DataTables
    var idioma_espanol = translations.datatable || {};

    // Función helper para obtener traducciones en JavaScript
    function t(key, defaultValue) {
        var keys = key.split('.');
        var value = translations;

        for (var i = 0; i < keys.length; i++) {
            if (value && typeof value === 'object' && keys[i] in value) {
                value = value[keys[i]];
            } else {
                return defaultValue !== undefined ? defaultValue : key;
            }
        }

        return value;
    }
    </script>

</head>

<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed login-page">
    <!-- sidebar-collapse -->
    <?php
  if (isset($_SESSION["S_SESION"]) && $_SESSION["S_SESION"] == "ok") {

    echo '<script>$("body").removeClass("login-page");</script>';

    if ($_SESSION['S_ROL'] != "CLIENTE") {
      echo '<script>$("body").addClass("sidebar-collapse");</script>';
    }

    /*=============================================
    Site wrapper
    =============================================*/
    echo '<div class="wrapper">';
    /*=============================================
    CABEZOTE
    =============================================*/

    include "module/cabezote.php";

    /*=============================================
    MENU
    =============================================*/

    include "module/menu.php";

    /*=============================================
    CONTENIDO
    =============================================*/
    if (isset($_GET["ruta"])) {

      if (
        $_GET["ruta"] == "perfil" ||
        $_GET["ruta"] == "usuarios" ||
        $_GET["ruta"] == "empleados" ||
        $_GET["ruta"] == "proveedores" ||
        $_GET["ruta"] == "bloqueo-ip" ||
        $_GET["ruta"] == "inicio" ||
        $_GET["ruta"] == "asignacion-prospecto" ||
        $_GET["ruta"] == "crear-prospecto" ||
        $_GET["ruta"] == "editar-prospecto" ||
        $_GET["ruta"] == "prospecto-asignado" ||
        $_GET["ruta"] == "clientes" ||
        $_GET["ruta"] == "clientes-asistencia-medica-individual" ||
        $_GET["ruta"] == "editar-cliente-asistencia-medica-individual" ||
        $_GET["ruta"] == "facturas" ||
        $_GET["ruta"] == "facturas-cliente" ||
        $_GET["ruta"] == "contrato-asistencia-medica-individual" ||
        $_GET["ruta"] == "documento-asistencia-medica-individual" ||
        $_GET["ruta"] == "reembolsos-vida-individual-cliente" ||
        $_GET["ruta"] == "reembolsos-asistencia-medica-individual-cliente" ||
        $_GET["ruta"] == "reembolsos-asistencia-medica-individual" ||
        $_GET["ruta"] == "operatorios-asistencia-medica-individual-cliente" ||
        $_GET["ruta"] == "operatorios-asistencia-medica-individual" ||
        $_GET["ruta"] == "crear-prospecto-empresarial" ||
        $_GET["ruta"] == "editar-prospecto-empresarial" ||
        $_GET["ruta"] == "prospecto-asignado-empresarial" ||
        $_GET["ruta"] == "clientes-asistencia-medica-individual-empresarial" ||
        $_GET["ruta"] == "editar-cliente-asistencia-medica-individual-empresarial" ||
        $_GET["ruta"] == "contrato-asistencia-medica-individual-empresarial" ||
        $_GET["ruta"] == "documento-asistencia-medica-individual-empresarial" ||
        $_GET["ruta"] == "reembolsos-asistencia-medica-individual-cliente-empresarial" ||
        $_GET["ruta"] == "reembolsos-asistencia-medica-individual-empresarial" ||
        $_GET["ruta"] == "operatorios-asistencia-medica-individual-cliente-empresarial" ||
        $_GET["ruta"] == "operatorios-asistencia-medica-individual-empresarial" ||
        $_GET["ruta"] == "credito-ambulatorio-asistencia-medica-individual-cliente" ||
        $_GET["ruta"] == "credito-ambulatorio-asistencia-medica-individual" ||
        $_GET["ruta"] == "credito-ambulatorio-asistencia-medica-individual-cliente-empresarial" ||
        $_GET["ruta"] == "creditos-ambulatorios-asistencia-medica-individual-empresarial" ||

        $_GET["ruta"] == "salir"
      ) {

        include "module/" . $_GET["ruta"] . ".php";
      } else {

        include "module/inicio.php";
      }
    } else {

      include "module/inicio.php";
    }

    /*=============================================
      FOOTER
      =============================================*/

    include "module/footer.php";

    /*=============================================
      ./wrapper
      =============================================*/

    echo '</div>';
  } else {
    if (isset($_GET["ruta"])) {
      if ($_GET["ruta"] == "login" || $_GET["ruta"] == "forgot-password" || $_GET["ruta"] == "change-password") {
        include "module/" . $_GET["ruta"] . ".php";
      } else {
        include "module/login.php";
        // header("Location: /");

        exit();
      }
    } else {
      include "module/login.php";
    }

    // include "forgot-password.php";
    // include "module/login.php";

  }
  ?>

    <script src="js/idioma.js?rev=<?php echo time(); ?>"></script>
    <script src="js/plantilla.js?rev=<?php echo time(); ?>"></script>
    <script src="js/notificaciones/utils.js?rev=<?php echo time(); ?>"></script>
    <script src="js/notificaciones/prospectos.js?rev=<?php echo time(); ?>"></script>
    <script src="js/notificaciones/clientes.js?rev=<?php echo time(); ?>"></script>
    <script src="js/notificaciones/renovaciones.js?rev=<?php echo time(); ?>"></script>
    <script src="js/notificaciones/reembolsos.js?rev=<?php echo time(); ?>"></script>
    <script src="js/notificaciones/creditos.js?rev=<?php echo time(); ?>"></script>
    <script src="js/notificaciones/siniestros.js?rev=<?php echo time(); ?>"></script>
    <script src="js/notificaciones/main.js?rev=<?php echo time(); ?>"></script>
    <script>
    $(document).ready(function() {
        listar_notificaciones();
    });
    </script>

</body>

</html>